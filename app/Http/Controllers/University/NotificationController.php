<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function read($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notif->update([
            'is_read' => 1,
            'read_at' => now(),
        ]);

        return redirect($notif->action_url ?? url('/'));
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now(),
            ]);

        return back();
    }
}
