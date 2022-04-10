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

    protected $subscription; //se setea la variable que recibe los datos
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscription $subs)
    {
        $this->subscription = $subs; //se recibe el parametro para el envio
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

        logger($this->subscription->toArray()); // se coloca un loguen para saber que datos estan llegando (opcional)

        $title = "Suscripción a NexoAbogados"; // se crean variables que contienen informacion para el envio del correo
        $name = $this->subscription->user->name;
        $price = $this->subscription->price_subs->price;
        $state = $this->subscription->confirmed;
        $subscribed = $this->subscription->user->subscribed;
        $estado = "";
        $aproved = "";
        $date_subs = $this->subscription->date_subscription;
        
        if( $state == 0 && $subscribed == 0){
            $estado = "Rechazada.\nLo sentimos el dia de mañana estaremos reintentando nuevamente la suscripcion";
            $aproved = "Cancelada";
        }else if( $state == 1 ){
            $estado = "Aprobada.\nEsperamos que disfrutes mucho nuestro contenido";
            $aproved = "Exitoso";
        }

        return (new MailMessage)
                    ->subject($title) //titulo del correo
                    ->greeting('Hola, ' . $name) //mensaje de saludo
                    ->line('tu suscripcion a NexoAbogados por un valor de $'. number_format($price, 2, ",", ".") . ' fue '.$estado.'.') //descripcion de la compra y su valor
                    ->line('Tu fecha de suscripcion es: '. $date_subs) //fecha en la que se realizo la suscripcion
                    ->line('El estado de suscripcion es: '. $aproved) //el debido estado
                    ->line('Gracias por preferirnos!') //mensaje de despedida
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
