<?php

namespace App\Notifications;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class PersonCreatedSlackMessage extends Notification
{
    use Queueable;

    public function __construct(
        public Person $person
    ){}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [$notifiable->slack_webhook ? ['slack'] : []];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                    ->from("Sergio's Laravel Developer Test app")
                    ->image('https://laravel.com/img/favicon/favicon.ico')
                    ->content("A new Person ({$this->person->name}) was created!!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "A new Person ({$this->person->name}) was created!"
        ];
    }
}
