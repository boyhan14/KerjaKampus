<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notificationService)
    {
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->query('filter');
        $notifications = $this->notificationService->getForUser($user, 15, $filter);
        $notifications->withQueryString();

        $stats = [
            'total' => Notification::where('user_id', $user->id)->count(),
            'unread' => Notification::where('user_id', $user->id)->whereNull('read_at')->count(),
            'read' => Notification::where('user_id', $user->id)->whereNotNull('read_at')->count(),
        ];

        return view('notifications.index', compact('notifications', 'stats'));
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $notification = Notification::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        $notification->markAsRead();

        $targetUrl = $notification->getTargetUrl();
        if ($targetUrl) {
            return redirect($targetUrl);
        }

        return redirect()->route('notifications.index')->with('opened_id', $id);
    }

    public function markAsRead(string $id)
    {
        $this->notificationService->markAsRead($id);
        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    public function toggleRead(string $id)
    {
        $this->notificationService->toggleRead($id, Auth::user());
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $this->notificationService->delete($id, Auth::user());
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
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
                'target_url' => $n->getTargetUrl(),
                'time' => $n->created_at->diffForHumans(),
            ]),
        ]);
    }
}

