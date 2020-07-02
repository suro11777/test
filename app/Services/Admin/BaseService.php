<?php


namespace App\Services\Admin;


class BaseService
{
    /**
     * @var
     */
    protected $baseModel;

    /**
     * @param $model
     */
    protected function set_model($model)
    {
        $this->baseModel = $model->newquery();
    }

}
