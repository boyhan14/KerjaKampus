<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_listing_id',
        'user_id',
        'cover_letter',
        'proposed_price',
        'estimated_duration',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'proposed_price' => 'decimal:2',
            'status' => ApplicationStatus::class,
        ];
    }

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function talent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }
}
