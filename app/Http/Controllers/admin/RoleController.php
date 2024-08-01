<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     *  view roles list
     *
     * @param send id
     * @return  view with data of the roles list
     */
    public function rolesView(){
        $roles = Role::paginate();
        return view('admin.role.create',compact('roles'));
    }
    /**
     *  add permission data
     *
     * @param send id
     * @return  view with data of the add permission
     */
    public function addroles(Request $request){
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        Role::create(['name' => $request->name]);
        return response()->json(redirect()->back()->with('success', 'Role added successfully'));
    }
    /**
     *  fetch edit permission data
     *
     * @param send id
     * @return  view with data of the permission
     */
    public function rolesEditView(Request $request){
        $roles = Role::where('id', $request->id)->first();
        return view('admin.role.includes.update', compact('roles'))->render();
    }
    /**
     *  Update permission data 
     *
     * @param send id
     * @return  message Update permission data according to permission id
     */
    public function rolesUpdate(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        Role::where('id', $request->id)->update([
            "name" => $request->name,
        ]);
        return response()->json(redirect()->back()->with('success', 'Role updated successfully'));
    }
     /**
     * Delete Role data according to id
     *
     * @param send id
     * @return  json response
     */
    public function roleRemove(Request $r){
        Role::where('id', $r->id)->delete();
        return response()->json(['success' => true]);
    }
}
