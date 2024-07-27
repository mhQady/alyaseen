<?php

namespace App\Http\Controllers\Dash;

use App\Models\Role;
use App\Repos\Concretes\RoleRepo;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use App\Repos\Concretes\PermissionRepo;

class RoleController extends BaseCrudController
{
    public function __construct(RoleRepo $roleRepo)
    {
        parent::__construct($roleRepo);

        $this->repo->where('name', Role::DEFAULT_ROLE_SUPERADMIN, '!=');
    }

    public function create()
    {
        $permissions = app(PermissionRepo::class)->list()->getResult()->groupBy('model');

        return view("dash.role.create", compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        try {

            DB::beginTransaction();
            $role = $this->repo->create(['name' => $request->name])->getResult();

            $role->syncPermissions($request->permissions);

            DB::commit();

            toast(__("main.created.role"), "success");
        } catch (\Exception $e) {
            DB::rollBack();
            toast($e->getMessage(), "error");
        }

        return to_route('dash.roles.index');
    }

    public function edit($id)
    {
        $role = $this->repo->with('permissions:id,name,model')->getByKey($id)->getResult();

        $permissions = app(PermissionRepo::class)->list()->getResult()->groupBy('model');

        return view("dash.role.edit", compact('permissions', 'role'));
    }

    public function update($id, RoleRequest $request)
    {
        try {

            DB::beginTransaction();

            $role = $this->repo->getByKey($id)->getResult();

            $role->update(['name' => $request->name]);

            $role->syncPermissions($request->permissions);

            DB::commit();

            toast(__("main.updated.role"), "success");

        } catch (\Exception $e) {
            DB::rollBack();
            toast($e->getMessage(), "error");
        }

        return to_route('dash.roles.index');
    }
}
