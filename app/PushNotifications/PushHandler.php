<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\PushNotifications;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

/**
 * Description of PushHandler
 *
 * @author Mohammed Zaki mohammedzaki.dev@gmail.com
 */
class PushHandler {

    public function pushNotification($title, $message, $token, $extraData = [], $sound = "default") {

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder
                ->setBody($message)
                ->setSound($sound);

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($extraData);

        $option       = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data         = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        //$downstreamResponse->numberFailure();
        //$downstreamResponse->numberModification();

        //return Array - you must remove all this tokens in your database
        //$downstreamResponse->tokensToDelete();

        //return Array (key : oldToken, value : new token - you must change the token in your database )
        //$downstreamResponse->tokensToModify();

        //return Array - you should try to resend the message to the tokens in the array
        //$downstreamResponse->tokensToRetry();

        // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array 
        //$downstreamResponse->tokensWithError();
        
        return $downstreamResponse->numberSuccess();
    }

}
