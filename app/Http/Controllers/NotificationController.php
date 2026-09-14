<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notificationService)
    {
    }

    public function index()
    {
        $notifications = $this->notificationService->getForUser(Auth::user());
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(string $id)
    {
        $this->notificationService->markAsRead($id);
        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(Auth::user());
        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    public function unreadCount()
    {
        $count = $this->notificationService->getUnreadCount(Auth::user());
        return response()->json(['count' => $count]);
    }

    public function recent()
    {
        $user = Auth::user();
        $unreadCount = $this->notificationService->getUnreadCount($user);
        $notifications = $user->notifications()->latest()->take(5)->get();

        return response()->json([
            'unread_count' => $unreadCount,
            'notifications' => $notifications->map(fn($n) => [
                'id' => $n->id,
                'title' => $n->title,
                'message' => $n->message,
                'is_read' => !is_null($n->read_at),
                'time' => $n->created_at->diffForHumans(),
            ]),
        ]);
    }
}
