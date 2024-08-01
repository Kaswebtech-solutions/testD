<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{
    /**
     *  view Assign roles list
     *
     * @param send id
     * @return  view with data of the Assign roles list
     */
    public function assignRolesView(){
        $roles = User::paginate();
        return view('admin.assignRole.create',compact('roles'));
    }
    /**
     *  fetch edit Assign role data
     *
     * @param send id
     * @return  view with data of the assign role
     */
    public function assignRolesEditView(Request $request){
        $roles = Role::where('id', $request->role_id)->first();
        $userId = $request->id;
        $allRoles = Role::all();
        return view('admin.assignRole.includes.update', compact('roles','allRoles','userId'))->render();
    }
    /**
     *  Update assign role data 
     *
     * @param send id
     * @return  message Update assign role data according to role id
     */
    public function assignRolesUpdate(Request $request){
        DB::table('model_has_roles')->where('model_id', $request->id)->update([
            "role_id" => $request->role_id,
        ]);
        return response()->json(redirect()->back()->with('success', 'Role updated successfully'));
    }
    /**
     *  filter data on search
     *
     * @param send searchdata
     * @return  view filter data according to search key
     */
    public function filterAssignPermission(Request $request){
        $search = $request->search;
        $qry = User::select('*');
        if (!empty($search)) {
            $qry->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
                $q->where('email', 'like', "%$search%");
            });
        }
        $roles = $qry->orderBy('id', 'DESC')->paginate();
        return view('admin.assignRole.includes.view', compact('roles', 'search'));
    }
}
