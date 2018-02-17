<?php

namespace App\Repositories;

use App\Models\Account;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories
 * @version February 15, 2018, 6:33 am UTC
 *
 * @method Account findWithoutFail($id, $columns = ['*'])
 * @method Account find($id, $columns = ['*'])
 * @method Account first($columns = ['*'])
*/
class AccountRepository extends MyBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'place',
        'email',
        'phone'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Account::class;
    }
}
