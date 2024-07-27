<?php

namespace App\Repos\Concretes;

use App\Repos\BaseRepo;
use App\Models\Category;
use App\Repos\Contracts\CategoryRepoInterface;

class CategoryRepo extends BaseRepo implements CategoryRepoInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
