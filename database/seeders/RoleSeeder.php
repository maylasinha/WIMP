<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
			'admin',
            'cliente',
            'gerente'
        ];

        foreach ($roles as $role) {
			Role::create(['name' => $role]);
        }

        $permissions = Permission::get();

        $role = Role::find(1);

        $role->syncPermissions($permissions);
    }
}
