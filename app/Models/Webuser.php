<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webuser extends Model
{
    use HasFactory;
    protected $table="web_users";
protected $fillable=["name","l_name","user","email","pass","mobile","city","zone","address","type","status","token","last_login","last_login_case","date","time","agent"];

public $timestamps = false;


}
