<?php

namespace App\Http\Controllers\Dash;

use App\Repos\Concretes\RoleRepo;
use App\Repos\Concretes\UserRepo;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Enums\User\AccountTypeEnum;

class AdminController extends BaseCrudController
{
    public function __construct(UserRepo $userRepo)
    {
        parent::__construct($userRepo);

        $this->repo->where('name', 'SuperAdmin', '!=');
    }

    public function create()
    {
        $roles = app(RoleRepo::class)->list()->getResult();

        return view("dash.user.create", compact('roles'));
    }


    public function store(UserRequest $request)
    {
        try {

            DB::beginTransaction();

            $admin = $this->repo->create(array_merge($request->validated(), ['account_type' => AccountTypeEnum::Admin->value]))->getResult();

            $admin->syncRoles($request->roles);

            DB::commit();

            toast(__("main.created.admin"), "success");

        } catch (\Exception $e) {
            DB::rollBack();
            toast($e->getMessage(), "error");
        }

        return to_route('dash.admins.index');
    }

    public function edit($id)
    {
        $admin = $this->repo->with('roles:id,name')->getByKey($id)->getResult();

        $roles = app(RoleRepo::class)->list()->getResult();

        return view("dash.user.edit", compact('roles', 'admin'));
    }

    public function update($id, UserRequest $request)
    {
        try {

            DB::beginTransaction();

            $admin = $this->repo->getByKey($id)->getResult();

            $admin->update($request->validated());

            $admin->syncRoles($request->roles);

            DB::commit();

            toast(__("main.updated.admin"), "success");

        } catch (\Exception $e) {
            DB::rollBack();
            toast($e->getMessage(), "error");
        }

        return to_route('dash.admins.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);

        toast(__("main.deleted.admin"), "success");

        return to_route('dash.admins.index');
    }
}
