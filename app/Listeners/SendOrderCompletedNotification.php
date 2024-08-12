<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Notifications\OrderCompletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderCompletedNotification implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(OrderCompleted $event): void
    {
        $event->order->user->notify(new OrderCompletedNotification($event->order));
    }
}
