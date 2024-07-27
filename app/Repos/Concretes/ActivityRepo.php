<?php

namespace App\Repos\Concretes;

use App\Models\Activity;
use App\Repos\BaseRepo;
use App\Repos\Contracts\ActivityRepoInterface;

class ActivityRepo extends BaseRepo implements ActivityRepoInterface
{
    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }
}
