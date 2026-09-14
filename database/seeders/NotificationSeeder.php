<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        $notifications = [
            ['type' => 'application_received', 'title' => 'Lamaran Baru Diterima', 'message' => 'Ada lamaran baru untuk project Anda.'],
            ['type' => 'application_accepted', 'title' => 'Lamaran Diterima!', 'message' => 'Selamat! Lamaran Anda telah diterima oleh client.'],
            ['type' => 'project_created', 'title' => 'Project Baru', 'message' => 'Project baru telah dibuat untuk Anda.'],
            ['type' => 'review_received', 'title' => 'Review Baru', 'message' => 'Anda mendapatkan review baru.'],
        ];

        foreach ($users as $user) {
            $count = rand(1, 3);
            for ($i = 0; $i < $count; $i++) {
                $notif = $notifications[array_rand($notifications)];
                Notification::create([
                    'id' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'type' => $notif['type'],
                    'title' => $notif['title'],
                    'message' => $notif['message'],
                    'read_at' => rand(0, 1) ? now()->subHours(rand(1, 48)) : null,
                ]);
            }
        }
    }
}
