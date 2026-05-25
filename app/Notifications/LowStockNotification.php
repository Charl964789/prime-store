<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [

            'title' => 'Low Stock Alert',

            'message' =>
                $this->product->name .
                ' stock is running low.',

        ];
    }
}