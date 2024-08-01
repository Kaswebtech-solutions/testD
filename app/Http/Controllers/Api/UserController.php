<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;
class UserController extends Controller{
    use ApiResponser;
    use ImageUpload;
    use Email; 
    /**
     *  Login check user
     *
     * @param  send id
     * @return  data from data to user login check user exist or not
    */
    public function loginCheck(request $r){
        return $this->success('Please login to access this page', 403);
    }
    /**
     *  Logout user
     *
     * @param  send id
     * @return  data from data to user logout current device
    */
    public function logout(request $r){
        $r->user()->currentAccessToken()->delete();
        return $this->success('Logout Successfully.');
    }
    /**
     *  User Register
     *
     * @param  send id
     * @return  data from data to user register
     */
    public function register(Request $r){
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                    'password' => 'required|min:6',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            User::create([
                    'name' => $r->name,
                    'email' => $r->email,
                    'phone' => $r->phone,
                    'password' => Hash::make($r->password)
                ]);
            return $this->success('Registration successfully');
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
     /**
     *  Login User
     *
     * @param  send id
     * @return  data from data to user login
     */
    public function login(request $r){
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    'device_name' => 'required',
                    'device_token' => 'required',
                    'device_type' => 'required',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $user = User::where('email', '=', $r->email)->first();
            if (!$user) {
                throw new Exception("Invalid email or password");
            }
            if ($user->status != User::STATUS_ACTIVE) {
                throw new Exception("Your account is inactive.Please contact with admin.");
            }
            if (!Hash::check($r->password, $user->password)) {
                throw new Exception("Invalid email or password");
            }
            //Genrate API Auth token
            $token = $user->createToken('API Token')->plainTextToken;
            if(!empty($user->id)){
                LoginHistory::where('created_by',$user->id)->delete();
            }
            $loginHistory = new LoginHistory();
            $loginHistory->device_name = $r->device_name;
            $loginHistory->device_token = $r->device_token;
            $loginHistory->device_type = $r->device_type;
            $loginHistory->personal_access_token = $token;
            $loginHistory->created_by = $user->id;
            $loginHistory->save();
            $data = [];
            $data['token'] =  $token;
            return $this->successWithData($data, "Login successfully");
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     *  Get User Profile
     *
     * @param  send id
     * @return  data from data to user data
     */
    public function getProfile(request $r){
        return $this->successWithData(auth()->user()->jsonData());
    }
}
