<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create(['name' => 'LOGIN']);
        Permission::create(['name' => 'CRIAR OCORRENCIA']);
        Permission::create(['name' => 'GERIR OCORRENCIA']);
        Permission::create(['name' => 'GERIR AGENTE']);
        Permission::create(['name' => 'VER AGENTE']);
        Permission::create(['name' => 'VER CONFIGURACAO']);
        Permission::create(['name' => 'CONFIG CARGO']);
        Permission::create(['name' => 'CONFIG OCORRENCIA']);

        $role = Role::create(['name' => 'TI']);
        $role->givePermissionTo('LOGIN');
        $role->givePermissionTo('VER CONFIGURACAO');
        $role->givePermissionTo('GERIR AGENTE');
        $role->givePermissionTo('GERIR OCORRENCIA');
        $role->givePermissionTo('CONFIG OCORRENCIA');
        $role->givePermissionTo('CONFIG CARGO');
        
    }
}
