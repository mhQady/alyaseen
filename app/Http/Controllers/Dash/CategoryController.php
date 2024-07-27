<?php

namespace App\Http\Controllers\Dash;

use App\Repos\Concretes\CategoryRepo;
use App\Http\Requests\CategoryRequest;

class CategoryController extends BaseCrudController
{
    public function __construct(CategoryRepo $categoryRepo)
    {
        parent::__construct($categoryRepo);
    }


    public function store(CategoryRequest $request)
    {
        $category = $this->repo->create($request->validated())->getResult();

        toast(__("main.created.category"), "success");

        return to_route('dash.categories.index', $category->id);
    }


    public function update(CategoryRequest $request, $id)
    {
        $category = $this->repo->update($id, $request->validated())->getResult();

        toast(__("main.updated.category"), "success");

        return to_route('dash.categories.index', $category->id);
    }
}
