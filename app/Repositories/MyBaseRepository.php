<?php

namespace App\Repositories;

use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MyBaseRepository
 * @package App\Repositories
 * @version November 1, 2017, 8:26 am UTC
 */
abstract class MyBaseRepository extends BaseRepository {

    public function allForHtmlSelect($displayColumn = 'name')
    {
        return $this->all()->mapWithKeys(function ($item) use ($displayColumn) {
                    return [$item['id'] => $item[$displayColumn]];
                });
    }

    public function getModelForDatatable()
    {
        $this->applyCriteria();
        $this->applyScope();
        
        $results = $this->model;
        
        $this->resetModel();
        $this->resetScope();
        
        return $results;
    }

}
