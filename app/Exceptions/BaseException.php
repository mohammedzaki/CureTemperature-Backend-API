<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Exceptions;

use Illuminate\Http\Response as ResponseClass;

/**
 * Description of ServerErrorException
 *
 * @author mohammedzaki
 */
class BaseException extends \Exception {

    public $http_code = ResponseClass::HTTP_INTERNAL_SERVER_ERROR;
    public $errors = [];

    /**
     * (PHP 5 &gt;= 5.1.0, PHP 7)<br/>
     * Construct the exception
     * @link http://php.net/manual/en/exception.construct.php
     * @param string $message [optional] <p>
     * The Exception message to throw.
     * </p>
     * @param int $code [optional] <p>
     * The Exception code.
     * </p>
     * @param Throwable $previous [optional] <p>
     * The previous exception used for the exception chaining.
     * </p>
     */
    public function __construct($errors = [], string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function responseJson() {
        return response()->jsonException($this);
    }

}
