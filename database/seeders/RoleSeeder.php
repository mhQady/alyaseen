<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # reset the cache
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


        $roles = Role::defaultRoles();

        if (empty($roles)) {
            $this->command->warn('No Default roles Found.');
        } else {
            foreach ($roles as $role) {
                Role::firstOrCreate(['name' => $role], ['guard_name' => 'admin']);
            }

            $this->command->info('Default roles added successfully.');
        }


        if ($this->command->confirm('Create Additional Roles?', false)) {

            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

            foreach (explode(',', $input_roles) as $role) {
                Role::firstOrCreate(['name' => trim($role)], ['guard_name' => 'admin']);
            }

            $this->command->info("Roles ({$input_roles})  added successfully.");
        }
        $this->command->line('------------------------------------------------------------------------------');
    }
}
