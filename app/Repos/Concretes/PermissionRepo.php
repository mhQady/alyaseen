<?php

namespace App\Repos\Concretes;

use App\Models\Permission;
use App\Repos\BaseRepo;
use App\Repos\Contracts\PermissionRepoInterface;

class PermissionRepo extends BaseRepo implements PermissionRepoInterface
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
