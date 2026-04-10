<?php

use App\Models\Notification;

if (!function_exists('sendNotification')) {

    function sendNotification($data)
    {
        return Notification::create([
            'user_id'      => $data['user_id'] ?? null,
            'title'        => $data['title'],
            'message'      => $data['message'] ?? null,
            'type'         => $data['type'] ?? 'info',
            'related_type' => $data['related_type'] ?? null,
            'related_id'   => $data['related_id'] ?? null,
            'action_url'   => $data['action_url'] ?? null,
            'is_read'      => 0,
            'read_at'      => null,
        ]);
    }
}
