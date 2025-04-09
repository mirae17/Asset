<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssetNotification extends Notification
{
    use Queueable;


    public $asset;
    public $action;

    public function __construct($asset, $action)
    {
        $this->asset = $asset;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Asset Notification')
                    ->view('emails.asset_notification', [
                        'asset' => $this->asset,
                        'action' => $this->action,
                    ]);
    }

}
