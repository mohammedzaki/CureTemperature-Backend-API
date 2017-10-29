<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Requests;

/**
 * Description of UserRequest
 *
 * @author mohammedzaki
 */
class UserRequest extends BaseRequest {

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     */
    public function rules() {
        return [
            'userId' => "required"
        ];
    }

}
