<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;
    const ROLE_ADMIN = 1;
    const ROLE_AGENT = 2;
    const ROLE_CUSTOMER = 3;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 2;


    const MALE = 1;
    const FEMALE = 2;
    const UPLOAD_PICTURE_PATH = "/public/images";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_image',
        'first_name',
        'last_name',
        'phone',
        'dob',
        'email',
        'password',
        'name',
        'role_id',
        'address',
        'city',
        'state',
        'pincode',
        'country',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['name']= $this->name;
        $json['email'] = $this->email;
        $json['phone'] = $this->phone;
        return $json;
    }
}
