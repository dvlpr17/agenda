<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class involucradosNotification extends Notification
{
    use Queueable;


    public $myInvolucrado;
    public $myActividad;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($involucrado, $actividad)
    {
        $this->myInvolucrado = $involucrado;
        $this->myActividad = $actividad;
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
        //OPCIÓN DE ENVIO 1 : se requiere descargar las plantillas para personalizar
        //php artisan vendor:publish --tag=laravel-notifications
        
        // return (new MailMessage)
        //             ->subject('Fuiste agregado a una actividad')
        //             ->greeting($this->myInvolucrado .' se te ha agregado a la actividad')
        //             ->line($this->myActividad)
        //             ->line('Para conocer mas sobre la actividad haz click en el botón.')
        //             ->action('Ver más', url('/'))
        //             ->line('Recuerda verificar con atención la fecha de entrega');

        //OPCIÓN 2: solo se crea una vista y funciona
        return (new MailMessage)->view(
            'emails.involucrados'
            ,['nombre' => $this->myInvolucrado, 'Actividad' => $this->myActividad]
        )->subject('Fuiste agregado a una actividad');        

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
