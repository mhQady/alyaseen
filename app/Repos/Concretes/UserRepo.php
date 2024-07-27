<?php

namespace App\Repos\Concretes;

use App\Models\User;
use App\Repos\BaseRepo;
use App\Repos\Contracts\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
