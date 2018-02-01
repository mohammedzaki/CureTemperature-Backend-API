<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\PushNotifications;

/**
 *
 * @author Mohammed Zaki mohammedzaki.dev@gmail.com
 */
interface IMobileNotification {

    /**
     * Get the notification title.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get the notification message.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Get the notification additional data.
     *
     * @return array()
     */
    public function getExtraData(): array;
}
