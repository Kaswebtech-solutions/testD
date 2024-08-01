<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    use ApiResponser;
    /**
     *Get user notification list
     *
     * @param  $r request contains data to notification list
     * @return Category
     */
    //
    public function getNotification(request $r){
        $loginUser = Auth::user();
        $query = Notification::where('to_user',$loginUser->id)->paginate();
        return $this->customPaginator($query);
    }
    /**
     *Get driver category list
     *
     * @param  $r request contains data to user list
     * @return Category
     */
    //
    public function getpaymentHistory(request $r){
        $loginUser = Auth::user();
        $query = Payment::where('user_id',$loginUser->id)->paginate();
        return $this->customPaginator($query);
    }
}
