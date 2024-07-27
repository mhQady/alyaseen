<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->line('------------------------------------------------------------------------------↙️');

        $permissions = collect();

        $superAdminRole = Role::findByName(Role::DEFAULT_ROLE_SUPERADMIN, 'admin');

        foreach (Permission::defaultPermissions() as $perm) {
            $permission = Permission::updateOrCreate(['name' => $perm['name']], ['model' => $perm['model'], 'guard_name' => 'admin']);

            $permissions->push($permission);

            if (!$superAdminRole->hasPermissionTo($permission, 'admin'))
                $superAdminRole->givePermissionTo($permission->name);
        }

        $this->command->info('Default permissions has been added successfully.');
        $this->command->line('------------------------------------------------------------------------------');

        Permission::whereNotIn('id', $permissions->pluck('id')->toArray())->delete();

        $this->command->info('Unwanted permissions has been removed successfully.');

        $this->command->line('------------------------------------------------------------------------------↖️');
    }


    public function scopeSimpleSearch($query, $search)
    {
        $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
    }
}
