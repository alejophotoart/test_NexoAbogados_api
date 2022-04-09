<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionAttorney extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscription $subs)
    {
        $this->subscription = $subs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $title = "Suscripción a NexoAbogados";
        $name = $this->subscription->user->name;
        $price = $this->subscription->price_subs->price;
        $state = $this->subscription->confirmed;
        $estado = "";
        $date_subs = $this->subscription->date_subscription;

        if( $state == 0 ){
            $estado = "Rechazada, Lo sentimos te invitamos a realizarla nuevamente";
        }else if( $state == 1 ){
            $estado = "Aprovada, Esperamos que disfrutes mucho nuestro contenido";
        }

        return (new MailMessage)
                    ->subject($title)
                    ->greeting('Hola, ' . $name)
                    ->line('tu suscripcion a NexoAbogados por un valor de $'. number_format($price, 2, ",", ".") . ' fue '.$estado.'.')
                    ->line('Tu fecha de suscripcion fue el '. $date_subs)
                    ->line('Gracias por preferirnos!')
                    ->salutation("¡Saludos!.");
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
            //
        ];
    }
}
