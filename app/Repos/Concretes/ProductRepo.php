<?php

namespace App\Repos\Concretes;

use App\Models\Product;
use App\Repos\BaseRepo;
use App\Repos\Concretes\ActivityRepo;
use App\Repos\Contracts\ProductRepoInterface;

class ProductRepo extends BaseRepo implements ProductRepoInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

}
