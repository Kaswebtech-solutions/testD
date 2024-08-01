<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    const FOR_SIGNUP = "signup";
    const FOR_LOGIN = "login";
    const FOR_FORGET = "forget";
}
