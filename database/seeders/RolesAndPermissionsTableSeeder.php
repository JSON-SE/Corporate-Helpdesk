<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleStandard = Role::create(['name' => 'standard']);
        $ticket_view_permission = Permission::create(['name' => 'view ticket']);
        $ticket_create_permission = Permission::create(['name' => 'create ticket']);
        $ticket_edit_permission = Permission::create(['name' => 'edit ticket']);
        $ticket_update_permission = Permission::create(['name' => 'update ticket']);
        $ticket_delete_permission = Permission::create(['name' => 'delete ticket']);

        $permissionAdmin = [
            $ticket_view_permission,
            $ticket_create_permission,
            $ticket_edit_permission,
            $ticket_update_permission,
            $ticket_delete_permission
        ];

        $permissionStandard = [
            $ticket_view_permission,
            $ticket_create_permission,
            $ticket_edit_permission,
            $ticket_update_permission,
        ];

        $roleAdmin->syncPermissions($permissionAdmin);
        $roleStandard->syncPermissions($permissionStandard);
    }
}
