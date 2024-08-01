<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller{
    use ImageUpload;
    /**
     * Admin Login.
     *
     * @param  $r request contains data to login data
     * @return Login user
     */
    public function login(Request $request){
        if($request->isMethod('post')) {
            $request->validate([
                "email" => "required|email",
                "password" => "required",
            ]);
            $credentials = $request->only('email', 'password');
            $remember = $request->remember;
            $check = User::where('email', $request->email)->role(User::ROLE_ADMIN)->first();
            if($check) {
                if (Auth::attempt($credentials, $remember)) {
                    Auth::logoutOtherDevices($request->password);
                    return redirect()->route('dashboard');
                }else{
                    return back()->withSuccess("Incorrect email/password.");
                }
            }else {
                return back()->withSuccess('Sorry! You have entered invalid credentials');
            }
        }else{
            return view('admin.login');
        }
    }
    /**
     * Admin Logout.
     *
     * @param  $r request contains data to logout
     * @return Logout user
     */
    public function Logout(){
        $role = Auth::user()->role_id;
        Auth::logout();
        if ($role == User::ROLE_ADMIN) {
            return redirect('/')->with('success', 'Logged out successfully.');
        }
    }
    /**
     * Admin home dashboard.
     *
     * @param  $r request contains show user data
     * @return Logout user
     */
    public function dashboard(){
        $users = User::where('status','!=',User::STATUS_DELETE)->count();
        return view('admin.home', compact('users'));
    }
    public function adminProfile()
    {
        $admin = User::where('id', Auth::user()->id)->first();
        return view('admin.profile', compact('admin'));
    }
    /**
     * Change Password.
     *
     * @param  $r request contains data to change Password 
     * @return response success or fail
     */
    //
    public function changePassword(Request $request){
        $thisUser = User::whereId(Auth::user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:20|different:password',
            'confirm_password' => 'required|required_with:new_password|same:new_password|max:20'
        ]);
        if (Hash::check($request->old_password, $thisUser->first()->password)) {
            $password = Hash::make($request->new_password);
            $thisUser->update(['password' => $password]);
            return response()->json(redirect()->back()->with('success', 'Password updated successfully.'));
        } else {
            return response()->json(redirect()->back()->with(['errors' => 'Password did not matched.']));
        }
    }
    /**
     * Change Profile Image.
     *
     * @param  $r request contains data to change profile 
     * @return response success or fail
     */
    //
    public function changeProfileImage(Request $request){
        if ($request->hasFile('new_profile_image')) {
            $image_name = $this->UploadImage($request->file('new_profile_image'), 'images');
            $thisUser = Auth::user()->id;
            $isUpdated = User::whereId($thisUser)->update(['profile_image' => $image_name]);
            if ($isUpdated) {
                return response()->json(redirect()->back()->with('success', 'Profile image updated successfully.'));
            } else {
                return response()->json(redirect()->back()->with('fail', 'Something went wrong.'));
            }
        }    
    }
    /**
     * update admin details.
     *
     * @param  $r request contains data to change admin data 
     * @return response success message
     */
    //
    public function updateInfo(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15',
        ]);
        User::where('id', $request->user_id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);
        return response()->json(redirect()->back()->with('success', 'Admin detail updated successfully.'));
    }
}
