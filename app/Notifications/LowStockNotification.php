<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Product $product)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'broadcast'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Low stock alert')
            ->line("Product {$this->product->name} is running low.")
            ->line("Current stock: {$this->product->stock}");
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'product_id' => $this->product->id,
            'stock' => $this->product->stock,
        ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'stock' => $this->product->stock,
        ];
    }
}

