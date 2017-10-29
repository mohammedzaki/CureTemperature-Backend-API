<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property-read \App\Models\Hospital $hospital
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordReset whereToken($value)
 * @mixin \Eloquent
 */
class PasswordReset extends BaseModel {

    /**
     * Generated
     */

    protected $table = 'password_resets';
    protected $fillable = ['email', 'token'];



}
