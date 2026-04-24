<?php

namespace App\Filament\Pages;

use App\Models\UserNotification;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AdminNotifications extends Page
{
    protected static ?string $navigationLabel = 'All Notifications';

    protected static ?string $title = 'All Notifications';

    protected static string|\UnitEnum|null $navigationGroup = 'Notifications';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.admin-notifications';

    public $notifications;

    public function mount(): void
    {
        $this->loadNotifications();
    }

    public function loadNotifications(): void
    {
        $this->notifications = UserNotification::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function markAsRead(int $notificationId): void
    {
        $notification = UserNotification::where('user_id', auth()->id())
            ->where('id', $notificationId)
            ->first();

        if (! $notification) {
            return;
        }

        $notification->update([
            'is_read' => true,
        ]);

        $this->loadNotifications();

        Notification::make()
            ->title('Notification marked as read')
            ->success()
            ->send();
    }

    public function openNotification(int $notificationId)
    {
        $notification = UserNotification::where('user_id', auth()->id())
            ->where('id', $notificationId)
            ->first();

        if (! $notification) {
            return;
        }

        if (! $notification->is_read) {
            $notification->update([
                'is_read' => true,
            ]);
        }

        $this->loadNotifications();
    }
}
