<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
class ImportReady extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }
    public function via($notifiable)
    {
        return ['slack'];
    }
    public function toSlack($notifiable)
    {
        return (new SlackMessage)->content('Done');
    }
}
