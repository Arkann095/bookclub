<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url("/reset-password/{$this->token}?email={$notifiable->email}");

        return (new MailMessage)
            ->subject('Сброс пароля | ' . config('app.name'))
            ->greeting('Здравствуйте, ' . $notifiable->name . '!')
            ->line('Вы запросили сброс пароля.')
            ->line('Для восстановления доступа нажмите на кнопку:')
            ->action('Сбросить пароль', $url)
            ->line('Ссылка действует 60 минут.')
            ->line('Если вы не запрашивали сброс — просто проигнорируйте это письмо.')
            ->salutation('С уважением, BookClub');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
