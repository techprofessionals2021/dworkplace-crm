<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;

class FCMNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $body;
    /**
     * Create a new notification instance.
     */
    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    /**
     * Get the FCM representation of the notification.
     */
    public function toFcm($notifiable)
    {
        return (new FcmMessage())
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->title($this->title)
                ->body($this->body));

            try {
                // Send the message
                $messaging = Firebase::messaging();
                $response = $messaging->send($message);

                // The response from Firebase will contain the result of the push notification
                return response()->json(['status' => 'Notification sent successfully', 'response' => $response]);
            } catch (MessagingException $e) {
                // If there is an error, return the message
                return response()->json([
                    'status' => 'Error sending notification',
                    'error' => $e->getMessage(),
                    'firebase_response' => $e->getResponseBody() // This will give you Firebase's response
                ]);
            }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         'title' => $this->title,
    //         'body' => $this->body,
    //     ];
    // }
}
