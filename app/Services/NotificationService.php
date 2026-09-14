<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class NotificationService
{
    public function send(User $user, string $type, string $title, string $message, ?array $data = null): Notification
    {
        return Notification::create([
            'id' => Str::uuid()->toString(),
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'read_at' => null,
        ]);
    }

    public function markAsRead(string $notificationId): void
    {
        $notification = Notification::find($notificationId);
        if ($notification && is_null($notification->read_at)) {
            $notification->update([
                'read_at' => now(),
            ]);
        }
    }

    public function markAllAsRead(User $user): void
    {
        Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);
    }

    public function getUnreadCount(User $user): int
    {
        return Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();
    }

    public function getForUser(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return Notification::where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);
    }
}
