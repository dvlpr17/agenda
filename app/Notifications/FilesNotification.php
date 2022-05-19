<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FilesNotification extends Notification
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

        return (new MailMessage)->view(
            'emails.files',
            ['nombre' => $this->myInvolucrado, 'Actividad' => $this->myActividad]
        )->subject('Se agrego un archivo');        

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
