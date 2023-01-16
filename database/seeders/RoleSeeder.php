<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create ( ['name' => 'admin']);
            $role->givePermissionTo('permission_create');
            $role->givePermissionTo('permission_edit');
            $role->givePermissionTo('permission_show');
            $role->givePermissionTo('permission_delete');
            $role->givePermissionTo('permission_access');
            $role->givePermissionTo('role_create');
            $role->givePermissionTo('role_edit');
            $role->givePermissionTo('role_show');
            $role->givePermissionTo('role_delete');
            $role->givePermissionTo('user_create');
            $role->givePermissionTo('user_edit');
            $role->givePermissionTo('user_show');
            $role->givePermissionTo('user_delete');
            $role->givePermissionTo('user_access');
        $role = Role::create ( ['name' => 'moderator']);
            $role->givePermissionTo('ingredient_create');
            $role->givePermissionTo('ingredient_edit');
            $role->givePermissionTo('ingredient_show');
            $role->givePermissionTo('ingredient_delete');
            $role->givePermissionTo('ingredient_access');
            $role->givePermissionTo('recipes_create');
            $role->givePermissionTo('recipes_edit');
            $role->givePermissionTo('recipes_show');
            $role->givePermissionTo('recipes_delete');
            $role->givePermissionTo('recipes_access');

        $role = Role::create ( ['name' => 'reader']);
            $role->givePermissionTo('recipes_access');
            $role->givePermissionTo('ingredient_access');
            

    }
}