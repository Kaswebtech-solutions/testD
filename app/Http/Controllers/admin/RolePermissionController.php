<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
   /**
     *  view roles list
     *
     * @param send id
     * @return  view with data of the roles list
     */
    public function rolesPermissionView(){
        $roles = Role::with('permissions')->get();
        // dd($roles);
        return view('admin.rolePermission.create',compact('roles'));
    }
     /**
     *  fetch edit permission data
     *
     * @param send id
     * @return  view with data of the permission
     */
    public function rolesPEditView(Request $request){
        $roles = Role::where('id', $request->id)->first();
        $permissions = $roles->permissions->pluck('id')->toArray();
        $allPermissions = Permission::get();
        return view('admin.rolePermission.includes.update', compact('roles','permissions','allPermissions'))->render();
    }
    /**
     *  Update permission data 
     *
     * @param send id
     * @return  message Update permission data according to permission id
     */
    public function rolesPUpdate(Request $request){
        $roles = Role::findOrFail($request->id);
        DB::table('role_has_permissions')->where('role_id',$request->id)->whereNotIn('permission_id',$request->permission)->delete();
        foreach($request->permission as $value){
            $roles->givePermissionTo([$value]);
            // $roles->syncPermissions([$value]);
        }
        return response()->json(redirect()->back()->with('success', 'Role updated successfully'));
    }
  

}
