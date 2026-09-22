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

    public function toggleRead(string $notificationId, User $user): void
    {
        $notification = Notification::where('user_id', $user->id)->where('id', $notificationId)->first();
        if ($notification) {
            $notification->toggleRead();
        }
    }

    public function delete(string $notificationId, User $user): void
    {
        Notification::where('user_id', $user->id)->where('id', $notificationId)->delete();
    }

    public function getForUser(User $user, int $perPage = 15, ?string $filter = null): LengthAwarePaginator
    {
        $query = Notification::where('user_id', $user->id);

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($filter === 'read') {
            $query->whereNotNull('read_at');
        }

        return $query->latest()->paginate($perPage);
    }
}
