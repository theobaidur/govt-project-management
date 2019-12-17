<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FillMissingPermissions extends Migration
{
    public function up()
    {
        $admin_role = Role::where('name', 'Administrator')->first();
       $guardName = config('admin-auth.defaults.guard');
        if(!empty($admin_role)){
            collect([
                'admin.investor.create',
                'admin.investor.edit',
                'admin.investor.delete',
            ])->map(function($permission) use ($admin_role, $guardName){
                $p = Permission::create(['name' => $permission, 'guard_name'=>$guardName]);
                $admin_role->givePermissionTo($p);
            });
        }

        $investor_role = Role::where('name', 'Investor')->first();
        if(!empty($investor_role)){
            collect([
                'admin.project.create',
                'admin.project.edit',
                'admin.project.delete',
            ])->map(function($permission) use ($investor_role){
                $investor_role->revokePermissionTo($permission);
            });
        }
        app()['cache']->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
