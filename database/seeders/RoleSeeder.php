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

        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();



        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'Activities.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Activities.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Activities.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Activities.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'Users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'Users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'Users.destroy'])->syncRoles([$role1]);


    }
}
