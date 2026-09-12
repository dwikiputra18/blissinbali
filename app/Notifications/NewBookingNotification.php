<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewBookingNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class, 'database'];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('New Tour Booking!')
            ->icon('/favicon.ico')
            ->body("New booking from {$this->booking->name} for {$this->booking->tourPackage->title}")
            ->action('View Booking', 'view_booking')
            ->data([
                'id' => $this->booking->id,
                'action' => 'view_booking'
            ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Tour Booking!',
            'body' => "New booking from {$this->booking->name} for {$this->booking->tourPackage->title}",
            'icon' => 'heroicon-o-shopping-bag',
            'color' => 'success',
            'actions' => [
                [
                    'name' => 'view',
                    'label' => 'View Booking',
                    'url' => '/blissinbaliadmin/bookings/' . $this->booking->id . '/edit',
                ],
            ],
            'format' => 'filament',
        ];
    }
}
