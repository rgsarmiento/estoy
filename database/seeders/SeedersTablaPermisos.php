<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class SeedersTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //tabla roles
            // 'roles.index',
            // 'roles.crear',
            // 'roles.editar',
            // 'roles.eliminar',
            // //tabla workers
            // 'workers.index',
            // 'workers.crear',
            // 'workers.editar',
            // 'workers.eliminar',
            //tabla companies
            'companies.index',
            'companies.crear',
            'companies.editar',
            'companies.eliminar',
             //tabla company_has_users
            'company_has_users.index',
            'company_has_users.crear',
            'company_has_users.editar',
            'company_has_users.eliminar',
            //usuarios
            'usuarios.index',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar'


        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
