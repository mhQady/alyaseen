<?php

namespace App\Http\Controllers\Dash;

use App\Repos\BaseRepo;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dash\Traits\BaseCrudTrait;

class BaseCrudController extends Controller
{
    use BaseCrudTrait;

    #index attributes#
    protected int $page;
    protected int $perPage;
    protected string $orderBy;
    protected string $orderDir;
    ##
    protected string $modelName;
    public function __construct(protected BaseRepo $repo)
    {
        $this->modelName = strtolower(class_basename($repo->getModel()));
        $this->initiateViewPath();
    }

    public function index()
    {
        $this->initiateForIndex();

        $data = $this->repo->orderBy($this->orderBy, $this->orderDir)->list($this->page, $this->perPage)->getResult();

        return view("{$this->viewPath}.index", [Str::plural($this->modelName) => $data]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create");
    }

    public function show($id)
    {
        $data = $this->repo->getByKey($id)->getResult();

        return view("{$this->viewPath}.show", [$this->modelName => $data]);
    }

    public function edit($id)
    {
        $data = $this->repo->getByKey($id)->getResult();

        return view("{$this->viewPath}.edit", [$this->modelName => $data]);
    }

    public function destroy($id)
    {
        $this->repo->delete($id);

        toast(__("main.deleted.{$this->modelName}"), "success");

        return to_route('dash.' . Str::plural($this->modelName) . '.index');
    }
}
