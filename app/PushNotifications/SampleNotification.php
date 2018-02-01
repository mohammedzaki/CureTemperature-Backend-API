<?php

namespace App\PushNotifications;

class SampleNotification extends MobileNotification {

    public function getMessage(): string {
        return "test";
    }

    public function getTitle(): string {
        return "test";
    }

    public function getExtraData(): array {
        return [];
    }

    public function getSound(): string
    {
        
    }

}
