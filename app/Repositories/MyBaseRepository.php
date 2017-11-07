<?php

namespace App\Repositories;

use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MyBaseRepository
 * @package App\Repositories
 * @version November 1, 2017, 8:26 am UTC
 */
abstract class MyBaseRepository extends BaseRepository {

    public function allForHtmlSelect()
    {
        return $this->all()->mapWithKeys(function ($item) {
                    return [$item['id'] => $item['name']];
                });
    }

}
