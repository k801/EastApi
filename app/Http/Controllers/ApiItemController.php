<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ApiItemController extends Controller
{



                   public function   index ()
                   {

                    $items=Item::get();
                      return $items;

                   }
}
