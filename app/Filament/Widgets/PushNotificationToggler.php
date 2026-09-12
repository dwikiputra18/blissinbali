<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PushNotificationToggler extends Widget
{
    protected string $view = 'filament.widgets.push-notification-toggler';

    protected int | string | array $columnSpan = 'full';
    
    public static function canView(): bool
    {
        return auth()->user()->email === env('ADMIN_EMAIL');
    }
}
