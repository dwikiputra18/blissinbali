<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewCarBookingNotification extends Notification
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
            ->title('New Car Rental Booking!')
            ->icon('/favicon.ico')
            ->body("New booking from {$this->booking->name} for {$this->booking->carRental->name}")
            ->action('View Booking', 'view_car_booking')
            ->data([
                'id' => $this->booking->id,
                'action' => 'view_car_booking'
            ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Car Rental Booking!',
            'body' => "New booking from {$this->booking->name} for {$this->booking->carRental->name}",
            'icon' => 'heroicon-o-truck',
            'color' => 'info',
            'actions' => [
                [
                    'name' => 'view',
                    'label' => 'View Booking',
                    'url' => '/blissinbaliadmin/car-bookings/' . $this->booking->id . '/edit',
                ],
            ],
            'format' => 'filament',
        ];
    }
}
