<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CustomDbChannel 
{

  public function send($notifiable, Notification $notification)
  {
    $data = $notification->toDatabase($notifiable);

    $expiryDate = $data['expiry_date'] ?? NOW();
    $notificationType = $data['notification_type'] ?? get_class($notification);

    unset($data['expiry_date'], $data['notification_type']);
    
    return $notifiable->routeNotificationFor('database')->create([
        'id' => $notification->id,

        //customize here
        'expiry_date' => $expiryDate ,
        'type' => $notificationType,
        'data' => $data,
        'read_at' => null,
    ]);
  }

}
?>