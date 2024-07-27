<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\User\AccountTypeEnum;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        $r = Role::findByName(Role::DEFAULT_ROLE_SUPERADMIN, 'admin');

        if ($r) {
            $user = User::updateOrCreate(['email' => 'admin@alyaseen.com'], [
                'name' => 'SuperAdmin',
                'password' => 'password',
                'email_verified_at' => date('Y-m-d'),
                'account_type' => AccountTypeEnum::Admin->value
            ]);

            $user->assignRole($r);

            $this->command->info('Here is your super admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn("Password is password");
            $this->command->line('------------------------------------------------------------------------------');
        }
    }
}
