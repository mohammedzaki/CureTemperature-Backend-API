<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use App\PushNotifications\MobileNotification;
use App\Models\Device;

/**
 * Description of TempNotification
 *
 * @author Mohammed Zaki mohammedzaki.dev@gmail.com
 */
class TempNotification extends MobileNotification
{

    /** @var Device */
    private $device;
    private $isHigh;
    private $temp;

    public function __construct(Device $device, $temp, $isHigh)
    {
        $this->device = $device;
        $this->isHigh = $isHigh;
        $this->temp   = $temp;
    }

    //put your code here
    public function getExtraData(): array
    {
        $data                      = $this->device->toArray();
        $data['temp']              = $this->temp;
        $data['tempServerMessage'] = $this->getMessage();
        return $data;
    }

    public function getMessage(): string
    {
        $message = "Device ({$this->device->name} - {$this->device->serial_number}) temperature ({$this->temp}) is ";
        if ($this->isHigh == true) {
            $message .= "high";
        } else {
            $message .= "low";
        }
        return $message;
    }

    public function getTitle(): string
    {
        return "Device temp alarm";
    }

    public function getSound(): string
    {
        return "curealarm.wav";
    }

}
