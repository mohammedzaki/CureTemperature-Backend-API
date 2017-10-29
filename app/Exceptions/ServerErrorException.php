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
class ServerErrorException extends BaseException {
    
    public $http_code = ResponseClass::HTTP_INTERNAL_SERVER_ERROR;
    
}
