<?php

use Nwidart\Modules\Facades\Module;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('getModels')) {
    function getModels()
    {
        $models = [];

        foreach (glob(app_path('Models/*.php')) as $file) {
            $modelName = basename($file, '.php');
            $models[$modelName] = "App\\Models\\{$modelName}";
        }

        return $models;
    }
}

if (!function_exists('getModelsNames')) {
    function getModelsNames()
    {
        return collect(getModels())->keys()->toArray();
    }

}
