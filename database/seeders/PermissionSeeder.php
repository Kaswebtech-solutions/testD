<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clear chached permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //All Permission to create
        $allPermission = [
            'admin_dashboard','user_register_dashboard','customer_register_dashboard','admin_profile','agent_view','customer_view','transaction_view','logout','permission_management','agent_profile'
        ];
        $adminPermission = [
                'admin_dashboard','user_register_dashboard','customer_register_dashboard','admin_profile','agent_view','customer_view','transaction_view','logout','permission_management'
        ];
        $agentPermission = [
                'admin_dashboard','customer_register_dashboard','customer_view','transaction_view','logout','agent_profile'
        ];
        $roles = [
                'admin','agent','customer'
        ];
        $permissions = collect($allPermission)->map(function($permission){
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        $roles = collect($roles)->map(function($permission){
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        Permission::insert($permissions->toArray());
        Role::insert($roles->toArray());
        $adminUser = User::find(1);
        $adminRole = Role::find(1);
        $adminUser->assignRole($adminRole);
        $adminRole->givePermissionTo(Permission::whereIn('name',$adminPermission)->get());
        $agentRole = Role::find(2);
        $agentRole->givePermissionTo(Permission::whereIn('name',$agentPermission)->get());
    }
}
