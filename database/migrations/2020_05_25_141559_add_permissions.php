<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddPermissions extends Migration
{
    private $roles = ['admin'];
    private $permissions = ['show finances', 'show details', 'make admin', 'manage drinks'];


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Roles
        foreach ($this->roles as $role)
		{
			Role::create(['name'=>$role]);
		}


        //Create Permissions
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);

            //Assign Permission to Roles
            foreach ($this->roles as $role) {
                $role_obj = Role::findByName($role);
                $role_obj->givePermissionTo($permission);

            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        //Remove Permissions
         foreach ($this->permissions as $permission){

            //Remove Permission from Roles
            foreach ($this->roles as $role)
            {
                $role_obj = Role::findByName($role);
                $role_obj->revokePermissionTo($permission);

            }
            // Delete Permission
            $permission_obj = Permission::findByName($permission);
            $permission_obj->delete();

         }

        // Remove Roles
        foreach ($this->roles as $role)
		{
			Role::findByName($role)->delete();
		}


    }
}
