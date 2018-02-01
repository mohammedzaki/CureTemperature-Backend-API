<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\PushNotifications;

use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Exceptions\ServerErrorException;

/**
 * Description of PushNotificationsChannel
 *
 * @author Mohammed Zaki mohammedzaki.dev@gmail.com
 */
class PushNotificationsChannel {

    private $pushHandler;

    public function __construct(PushHandler $pushHandler) {
        $this->pushHandler = $pushHandler;
    }

    /**
     * Send the given notification.
     *
     * @param  Notification  $notification
     * @return void
     */
    public function send($notifiable, IMobileNotification $notification) {
        if (!$notifiable instanceof User) {
            throw new ServerErrorException("given notifiable object is not istance of [\App\Models\User]");
        }
        if (empty($notifiable->device_token)) {
            throw new ServerErrorException("given user dose not have mobile device_token");
        }
        $this->pushHandler->pushNotification($notification->getTitle(), $notification->getMessage(), $notifiable->device_token, $notification->getExtraData(), $notification->getSound());
    }

}
