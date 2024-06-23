<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NombreNotificacion extends Notification
{
    use Queueable;

    protected $datos;
    protected $planificacion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($datos, $planificacion)
    {
        $this->datos = $datos;
        $this->planificacion = $planificacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
                'message' => $this->datos['mensaje'],
                // Agrega más datos según sea necesario
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            // 'message' => 'Se ha creado una nueva planificación de inspección',
            /* 'link' => route('create', ['id' => $this->planificacion->id]), */
            'id_planificacion' => $this->planificacion->id,

            // Agrega más datos según sea necesario
        ];
    }
}
