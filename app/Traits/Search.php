<?php


namespace App\Traits;


trait Search
{

    public function getResults($model, $column, $keyword)
    {
        $model = '\\App\\' . $model;

        return $model::where($column, 'like', '%' . $keyword . '%')->pluck($column);
    }

}
