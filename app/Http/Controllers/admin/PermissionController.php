<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     *  view permission list
     *
     * @param send id
     * @return  view with data of the permission list
     */
    public function permissionView(){
        $permission = Permission::paginate();
        return view('admin.permission.create',compact('permission'));
    }
    /**
     *  add permission data
     *
     * @param send id
     * @return  view with data of the add permission
     */
    public function addPermission(Request $request){
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        Permission::create(['name' => $request->name]);
        return response()->json(redirect()->back()->with('success', 'Permission added successfully'));
    }
    /**
     *  fetch edit permission data
     *
     * @param send id
     * @return  view with data of the permission
     */
    public function permissionEditView(Request $request){
        $data = Permission::where('id', $request->id)->first();
        return view('admin.permission.includes.update', compact('data'))->render();
    }
    /**
     *  Update permission data 
     *
     * @param send id
     * @return  message Update permission data according to permission id
     */
    public function permissionUpdate(Request $request){
        Permission::where('id', $request->id)->update([
            "name" => $request->name,
        ]);
        return response()->json(redirect()->back()->with('success', 'Permission updated successfully'));
    }
    /**
     *  filter data on search
     *
     * @param send searchdata
     * @return  view filter data according to search key
     */
    public function filterPermission(Request $request){
        $search = $request->search;
        $qry = Permission::select('*');
        if (!empty($search)) {
            $qry->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        $permission = $qry->orderBy('id', 'DESC')->paginate();
        return view('admin.permission.includes.view', compact('permission', 'search'));
    }
    /**
     * Delete Permission data according to id
     *
     * @param send id
     * @return  json response
     */
    public function permissionRemove(Request $r){
        Permission::where('id', $r->id)->delete();
        return response()->json(['success' => true]);
    }
}
