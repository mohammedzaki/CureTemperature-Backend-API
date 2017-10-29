<?php

namespace App\Models;

use App\Events\ModelCreating;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {

    protected $events = [
        
    ];
    
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'userId', 'id');
    }
}
