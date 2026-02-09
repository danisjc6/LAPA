<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
class ResetPassword extends Notification
{
    use Queueable;
    private $user;
    private $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$token)
    {
        $this->user=$user;

        $this->token=$token;
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
        return (new MailMessage)
                   ->from($this->user->email, 'LAPA - UFAPE')
                    ->subject('Alterar Senha')
                    ->line('Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.')
                    ->action('Resetar Senha',  url('/password/reset/'.$this->token. '?email=' . urlencode($this->user->email)));
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
