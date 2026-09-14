<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role',
        'roles',
        'status',
        'avatar',
        'bio',
        'location',
        'phone',
        'website',
        'company_name',
        'company_description',
        'education',
        'experience_years',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'instagram_url',
        'is_available',
        'profile_completed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'status' => UserStatus::class,
            'roles' => 'array',
            'is_available' => 'boolean',
            'profile_completed_at' => 'datetime',
        ];
    }

    // scopes
    public function scopeActive($query)
    {
        return $query->where('status', UserStatus::ACTIVE);
    }

    public function scopeTalents($query)
    {
        return $query->where('role', UserRole::TALENT);
    }

    public function scopeClients($query)
    {
        return $query->where('role', UserRole::CLIENT);
    }

    // Methods
    public function hasRole(UserRole $role): bool
    {
        if ($this->role === $role) {
            return true;
        }

        $roles = $this->roles ?? [];
        return in_array($role->value, $roles);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(UserRole::ADMIN);
    }

    public function isTalent(): bool
    {
        return $this->hasRole(UserRole::TALENT);
    }

    public function isClient(): bool
    {
        return $this->hasRole(UserRole::CLIENT);
    }

    public function addRole(UserRole $role): void
    {
        $roles = $this->roles ?? [];
        if (!in_array($role->value, $roles)) {
            $roles[] = $role->value;
            $this->roles = $roles;
            $this->save();
        }
    }

    public function profileCompletionPercentage(): int
    {
        $percentage = 0;
        if ($this->avatar) $percentage += 10;
        if ($this->bio) $percentage += 10;
        if ($this->location) $percentage += 10;
        if ($this->education) $percentage += 10;
        if ($this->skills()->exists()) $percentage += 20;
        if ($this->portfolioItems()->exists()) $percentage += 20;
        if ($this->experience_years !== null) $percentage += 10;
        if ($this->github_url || $this->linkedin_url || $this->twitter_url || $this->instagram_url || $this->website) {
            $percentage += 10;
        }
        return $percentage;
    }

    public function averageRating(): float
    {
        return (float) $this->reviewsReceived()->avg('rating') ?: 0.0;
    }

    // Relationships
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills')
            ->withPivot('level')
            ->withTimestamps();
    }

    public function userSkills(): HasMany
    {
        return $this->hasMany(UserSkill::class);
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class);
    }

    public function jobListings(): HasMany
    {
        return $this->hasMany(JobListing::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function clientProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function talentProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'talent_id');
    }

    public function reviewsGiven(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }
}
