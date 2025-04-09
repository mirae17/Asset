<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssetNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $asset;
    public $action;

    public function __construct($asset, $action)
    {
        $this->asset = $asset;
        $this->action = $action;
    }

    public function build()
    {
        return $this->subject('Asset Notification')
                    ->view('emails.asset_notification');
    }
}
