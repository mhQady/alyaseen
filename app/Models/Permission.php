<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected static $abilities = ['create', 'read', 'update', 'delete'];
    protected static $additionalModels = [];
    protected static $exceptModels = ['activity'];
    protected static $additionalPermissions = ['audit_product'];
    protected static $exceptPermissions = [];

    public static function defaultPermissions()
    {
        $permissions = collect(self::getAdditionalPermissions());

        foreach (self::getModelsNames() as $modelName) {
            foreach (self::$abilities as $ability) {
                $name = "{$ability}_{$modelName}";

                if (in_array($name, self::$exceptPermissions))
                    continue;

                $permissions->push(['name' => $name, 'model' => $modelName]);
            }
        }

        return $permissions;
    }

    private static function getModelsNames()
    {
        $models = collect();

        collect(array_merge(getModelsNames(), self::$additionalModels))->each(function ($model) use (&$models) {

            $model = strtolower($model);

            # Remove unwanted models
            if (in_array($model, self::$exceptModels) || strpos($model, 'translation'))
                return;

            $models->push($model);
        });

        return $models->sort();
    }

    public static function getAdditionalPermissions()
    {

        return collect(self::$additionalPermissions)->map(function ($permission) {

            $model = explode('_', $permission);

            return ['name' => $permission, 'model' => end($model)];
        });
    }

    public function scopeSimpleSearch($query, $search)
    {
        $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
    }
}
