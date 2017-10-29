<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Migration
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @property-read \App\Models\Hospital $hospital
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration whereMigration($value)
 * @mixin \Eloquent
 */
class Migration extends BaseModel {

    /**
     * Generated
     */

    protected $table = 'migrations';
    protected $fillable = ['id', 'migration', 'batch'];



}
