<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected Order $order,
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Order Placed - Order #'.$this->order->id)
            ->line('Thank you for your order! Here are the details:')
            ->line("Order ID: {$this->order->id}")
            ->line("Payment Method: {$this->order->payment_method->value}")
            ->line("Total: ৳{$this->order->total}");

        $mailMessage->line('Order Items:');
        foreach ($this->order->orderItems as $orderItem) {
            $mailMessage
                ->line("- {$orderItem->product->name} (Qty: {$orderItem->quantity}, Price: ৳{$orderItem->price}");
        }

        $mailMessage
            ->action('View Order', route('account.orders.show', $this->order))
            ->line('If you have any questions, please don\'t hesitate to contact us.');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
