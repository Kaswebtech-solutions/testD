<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $table = "login_history";
    use HasFactory;
    public function listJsonData()
    {
        $json = [];
        $json['device_name'] = $this->device_name;
        $json['device_token'] = $this->device_token;
        $json['device_type'] = $this->device_type;
        $json['login_at'] = $this->created_at->format('d-m-Y h:i:s');
        return $json;
    }
}
