<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRegisterController extends Controller
{
    use ImageUpload;
    /**
     *  view all user list
     *
     * @param  get data from user list
     * @return
     */
    public function viewUser()
    {
        $data = User::role(User::ROLE_ADMIN)->where('status', '!=', User::STATUS_DELETE)->orderBy('id', 'DESC')->paginate();
        $admin = User::first();
        return view('admin.user.create', compact('data', 'admin'));
    }
    /**
     *  add user
     *
     * @param  get data form add the user detail
     * @return
     */
    public function addUser(UserRegisterRequest $request)
    {
        $insert = new User;
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->phone = $request->phone;
        $insert->password = Hash::make($request->password);
        $insert->save();
        return response()->json(redirect()->back()->with('success', 'New User is added Successfully'));
    }
    /**
     *  Enable disable user
     *
     * @param change status of the user active and inactive
     * @return
     */
    public function ToggleUserStatus(Request $r)
    {
        $getUserStatus = User::find($r->id);
        $status = ($getUserStatus->status == User::STATUS_ACTIVE) ? User::STATUS_INACTIVE : User::STATUS_ACTIVE;
        $data = User::where('id', $r->id)->update(['status' => $status]);
        return response()->json($data);
    }
    /**
     *  View all user detail
     *
     * @param  send id
     * @return  data from data to show all detail of the user
     */
    public function viewData($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.user.includes.detailview', compact('data'));
    }
    /**
     *  fetch edit user data
     *
     * @param send id
     * @return  view with data of the user list
     */
    public function Updateuser(Request $request)
    {
        $updateData = User::where('id', $request->id)->first();
        return view('admin.user.includes.update', compact('updateData'))->render();
    }
    /**
     *  Update user data 
     *
     * @param send id
     * @return  message Update user data according to user id
     */
    public function UpdateUserData(UpdateUserRequest $request)
    {
        User::where('id', $request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);
        return response()->json(redirect()->back()->with('success', 'User updated successfully'));
    }
    /**
     *  filter data on search
     *
     * @param send searchdata
     * @return  view filter data according to search key
     */
    public function filter(Request $request)
    {
        $search = $request->search;
        $qry = User::select('*');
        if (!empty($search)) {
            $qry->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
                $q->orWhere('email', 'like', "%$search%");
                $q->orWhere('phone', 'like', "%$search%");
            });
        }
        $data = $qry->where('role_id', User::ROLE_USER)->where('status', '!=', User::STATUS_DELETE)->orderBy('id', 'DESC')->paginate();
        return view('admin.user.includes.view', compact('data', 'search'));
    }
    /**
     *  Update user status and add timestamp data according to user id
     *
     * @param send id
     * @return  json response
     */
    public function UserRemove(Request $r)
    {
        User::where('id', $r->id)->update([
            'status' => User::STATUS_DELETE,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json(['success' => true]);
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = DB::table('password_reset')->where(['email' => $request->email])->first();
        if (!empty($user)) {
            DB::table('password_reset')->where(['email' => $request->email])->delete();
        }
        $token = Str::random(64);
        DB::table('password_reset')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        try {
            $admin = User::role(User::ROLE_ADMIN)->first();
            Mail::send('mail.forgetPassword', ['token' => $token, 'email' => $request->email], function ($message) use ($admin) {
                $message->to($admin->email);
                $message->subject('Reset Password');
            });
        } catch (\Throwable $e) {
            Log::alert($e->getMessage());
        }
        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token, $email)
    {
        return view('admin.user.includes.forgetPasswordLink', ['token' => $token, 'email' => $email]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_reset')->where(['email' => $request->email, 'token' => $request->token])->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset')->where(['email' => $request->email])->delete();
        return view('mail.thanks');
    }
}
