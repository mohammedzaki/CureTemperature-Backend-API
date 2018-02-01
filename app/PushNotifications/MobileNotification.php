<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\PushNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Description of Notification
 *
 * @author Mohammed Zaki mohammedzaki.dev@gmail.com
 */
abstract class MobileNotification extends Notification implements ShouldQueue, IMobileNotification {

    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return [PushNotificationsChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }
    
    /**
     * Get the notification sound.
     *
     * @return string
     */
    public function getSound(): string {
        return "default";
    }

}
