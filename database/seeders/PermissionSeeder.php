<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app () [PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'ingredient_create',
            'ingredient_edit',
            'ingredient_show',
            'ingredient_delete',
            'ingredient_access',
            'recipes_create',
            'recipes_edit',
            'recipes_show',
            'recipes_delete',
            'recipes_access'
        ];
        
        foreach ($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        Role::create(['name'=> 'Super Admin']);

        // $role = Role::create(['name' => 'User']);

        // $userPermissions = [
        //     'ingredient_create',
        //     'recipes_create',
        //     'recipes_edit',
        //     'recipes_show',
        //     'recipes_delete',
        //     'recipes_access'
        // ];

        // foreach ($userPermissions as $permission){
        //     $role->givePermissionTo($permission);
        // }
    }
}
