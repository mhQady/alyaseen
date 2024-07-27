<?php

namespace App\Http\Controllers\Dash;

use App\Repos\Concretes\ProductRepo;
use App\Http\Requests\ProductRequest;
use App\Repos\Concretes\ActivityRepo;
use App\Repos\Concretes\CategoryRepo;
use App\Http\Controllers\Dash\BaseCrudController;

class ProductController extends BaseCrudController
{

    public function __construct(ProductRepo $productRepo)
    {
        parent::__construct($productRepo);
    }


    public function create()
    {
        $categories = app(CategoryRepo::class)->list()->getResult();

        return view("dash.product.create", compact('categories'));
    }


    public function store(ProductRequest $request)
    {
        $this->repo->create($request->validated())->getResult();

        toast(__("main.created.product"), "success");

        return to_route('dash.products.index');
    }


    public function edit($id)
    {
        $product = $this->repo->getByKey($id)->getResult();

        $categories = app(CategoryRepo::class)->list()->getResult();

        return view("dash.product.edit", compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->repo->update($id, $request->validated())->getResult();

        toast(__("main.updated.product"), "success");

        return to_route('dash.products.index');
    }

    public function getActivities($id)
    {
        $this->initiateForIndex();

        $product = $this->repo->getByKey($id)->getResult();

        $activities = app(ActivityRepo::class)->orderBy($this->orderBy, $this->orderDir)->with('causer:id,name,email')
            ->where('subject_id', $id)->where('subject_type', $this->repo->getModel()::class)
            ->list($this->page, $this->perPage)->getResult();

        return view("dash.product.activities", compact('product', 'activities'));
    }
}
