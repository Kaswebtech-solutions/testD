<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
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
