<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Constants;

use BadMethodCallException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Traits\Macroable;
use ReflectionClass;

/**
 * Description of Gender
 *
 * @author mohammedzaki
 */
class SessionKey {

    use Macroable {
        Macroable::__call as macroCall;
    }

    const ACCOUNT_ID = 'ACCOUNT_ID';
    const CLINIC_ID = 'CLINIC_ID';
    const USER_ID = 'USER_ID';
    const PATIENT_ID = 'PATIENT_ID';
    const PATIENT_CODE = 'PATIENT_CODE';
    const PATIENT_NAME = 'PATIENT_NAME';
    const NEW_PATIENT = 'NEW_PATIENT';

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @return View|mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($constantName, $parameters) {
        try {
            $refl = new ReflectionClass(self::class);
            if (in_array($constantName, $refl->getConstants())) {
                return $constantName;
            } else {
                throw new BadMethodCallException("Constant {$constantName} does not exist.");
            }
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException("Constant {$constantName} does not exist.");
        }

        throw new BadMethodCallException("Constant {$constantName} does not exist.");
    }

}
