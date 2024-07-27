<?php

namespace App\Repos\Concretes;

use App\Models\Role;
use App\Repos\BaseRepo;
use App\Repos\Contracts\RoleRepoInterface;

class RoleRepo extends BaseRepo implements RoleRepoInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
