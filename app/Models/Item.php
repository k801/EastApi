<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Item extends Model
{
    use HasFactory;


    protected $table="items";
    protected $fillable=["category","scategory","brand","name","name_ar","model","model_ar","short","short_ar","des","des_ar","stock","old_price","price","c_price","p_price","weight","img","point","os_system","processor","processor_g","color","img_key","att_key","views","option_key","meta_key","published","type","seller","agent","date","time","API_code","url"];




       public function img_keys()
       {


        return $this->hasMany(Imgkey::class);
       }



       public function name($lang="en")
       {


        $lang=$lang??App::getLocale();
        return json_decode($this->name)->$lang;
       }

}
