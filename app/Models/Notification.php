<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'read_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function markAsRead(): void
    {
        if (is_null($this->read_at)) {
            $this->read_at = $this->freshTimestamp();
            $this->save();
        }
    }

    public function toggleRead(): void
    {
        $this->read_at = is_null($this->read_at) ? $this->freshTimestamp() : null;
        $this->save();
    }

    public function getTargetUrl(): ?string
    {
        $data = $this->data ?? [];

        if (!empty($data['url'])) {
            return $data['url'];
        }

        $jobId = $data['job_id'] ?? (($data['target_type'] ?? '') === 'job' ? ($data['target_id'] ?? null) : null);
        if ($jobId) {
            $job = JobListing::find($jobId);
            return $job ? route('jobs.show', $job->slug ?? $job->id) : null;
        }

        if (!empty($data['project_id'])) {
            return route('projects.show', $data['project_id']);
        }

        if (!empty($data['application_id'])) {
            return route('applications.my');
        }

        if (($data['target_type'] ?? '') === 'user' && !empty($data['target_id'])) {
            return route('talents.profile', $data['target_id']);
        }

        return null;
    }
}
