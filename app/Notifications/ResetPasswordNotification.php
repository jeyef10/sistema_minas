<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('Hola')
            ->line('Has solicitado restablecer tu contraseña para tu cuenta.')
            ->line('Ingresa el siguiente código en la página de restablecimiento de contraseña:')
            ->line('**' . $this->token . '**')
            ->line('Este código tiene una validez de ' . config('auth.passwords.users.expire') . ' minutos.')
            ->line('Si no has solicitado restablecer tu contraseña, ignora este correo electrónico.')
            ->action('Restablecer contraseña', url(route('password.reset', $this->token)))
            ->from('your_email@domain.com', 'Tu nombre o nombre de la aplicación');
    }
}
