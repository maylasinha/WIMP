<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
					'visualizar perfis de acesso',
					'criar perfil de acesso',
					'editar perfil de acesso',
					'apagar perfil de acesso',

                    'editar informacoes basicas',

                    'visualizar pagina',
                    'criar pagina',
                    'editar pagina',
                    'apagar pagina',

                    'visualizar categoria de pets',
                    'criar categoria de pets',
                    'editar categoria de pets',
                    'apagar categoria de pets',

                    'visualizar pet',
                    'criar pet',
                    'editar pet',
                    'apagar pet',

                    'visualizar depoimento',
                    'criar depoimento',
                    'editar depoimento',
                    'apagar depoimento',
        ];

        foreach ($permissions as $permission) {
					Permission::create(['name' => $permission]);
        }
    }
}
