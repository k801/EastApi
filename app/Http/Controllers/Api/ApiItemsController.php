<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Zone;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Webuser;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ApiItemsController extends Controller
{


    // public function get_products($id)
    // {

            // $orders=Order::where('client_id',$id)->get();
            // dd($orders);
            //   foreach ($orders as $order)
            //       {

            //         $products=array();

            //                 $items=OrderItem::where('order_id',$order->order_id)->get();

            //                        foreach ($items as $item)
            //                             {

            //                                 $products[]=$item;
            //                               }

                            // $data[]=([

                            //     'order_id'=>$order->order_id,
                            //     'client_mobile'=>$order->client_mobile,
                            //     'client_id'=>$order->client_id,
                            //     'items_c'=>$order->items_c,
                            //     'total'=>$order->total,
                            //     'is_voucher'=>$order->is_voucher,
                            //     'voucher_id'=>$order->voucher_id,
                            //     'voucher_value'=>$order->voucher_value,
                            //     'shipping_value'=>$order->shipping_value,
                            //     'payment_method'=>$order->payment_method,
                            //     'payment_type'=>$order->payment_type,
                            //     'ins_months'=>$order->ins_months,
                            //     'type'=>$order->type,
                            //     'status'=>$order->status,
                            //     'order_integration'=>$order->order_integration,
                            //     'mobile_wallet'=>$order->mobile_wallet,
                            //     'items'=>$products,

                            //                ]);

            // }




            // return Response::json($data);


    // }
    // function strip_tags($string) {
    //     // ----- remove HTML TAGs -----
    //     $string = preg_replace ('/<[^>]*>/', ' ', $string);
    //     // ----- remove control characters -----
    //     $string = str_replace("\r", '', $string);
    //     $string = str_replace("\n", ' ', $string);
    //     $string = str_replace("\t", ' ', $string);
    //     // ----- remove multiple spaces -----
    //     $string = trim(preg_replace('/ {2,}/', ' ', $string));
    //     return $string;

    // }

    public function index()
    {

// sliders imags
        $sliderss=DB::table('slider_img')->get();

        foreach($sliderss as $slider)
                     {




                        $sliders[]=([

                              'id'=> $slider->id,
                              'img'=>'https://eastasiaeg.com/front/images/banner_boxes/'.$slider->img,
                              'link'=>$slider->link,



                        ]);


                     }

                     $data['sliders']=$sliders;


// return Response::json($data);

// all items
$itemss=DB::table('items')->get();
// return $itemss;
$items=array();
foreach($itemss as $item)
{


$items[]=([
                         "id"=>$item->id,

                        "name_en"=>$item->name,
                        "name_ar"=>$item->name_ar,
                        'old_price'=>$item->old_price,
                        'price'=>$item->price


]);






}


// $data['items']=$items;







// new arrival
$itemss=DB::table('items')->orderby('id','desc')->take(50)->get();

                     foreach($itemss as $item)
                     {


                     $new[]=([
                        "id"=>$item->id,

                        "name_en"=>$item->name,
                        "name_ar"=>$item->name_ar,



                        "old_price"=>$item->old_price,
                        "price"=>$item->price,


                  ]);




                }

$data['new_arrival']=$new ;

                    //  $data['offers']=Item::orderby('id','desc')->take(50)->get();
                    // $items=DB::table('items')->select('id','name','name_ar','c_price','img_key','category','scategory')->get();
                    //  foreach($items as $item)
                    //                        {
                    //                         $images=array();

                    //                         $imgs=DB::table('img_key')->where('img_key',$item->img_key )->get();

                    //                                        foreach ($imgs as $img) {

                    //                                                            $images[]=$img->img;

                    //                                                         }

                    //                                 $data[]=([

                    //                                   'img'=>$images,
                    //                                  "category"=>$item->category,
                    //                                   "scategory"=>$item->scategory,
                    //                                 //   "brand"=>$item->brand,
                    //                                   "name"=>$item->name,
                    //                                   "name_ar"=>$item->name_ar,
                    //                                   "price"=>$item->price,



                    //                             ]);









                    //                             }


                                                $categoriess=DB::table('category')->get();
                                                $scats=array();
                                             foreach ($categoriess as $category) {

                                                                       $cats[]=([

                                                                          'id'=>$category->id,
                                                                          'parent_id'=>null,
                                                                          'name_en'=>$category->name,
                                                                          'name_ar'=>$category->name_ar,
                                                                          'img'=>'https://eastasiaeg.com/front/images/category/icons/'.$category->image,




                                                                    ]);

                                                       }

                                                        $subcategoriess=DB::table('subcategory')->get();
                                                                       foreach ($subcategoriess as $subcategory) {

                                                                                                 $subcats[]=([

                                                                                                    'id'=>$subcategory->id,
                                                                                                    'parent_id'=>$subcategory->c_id,
                                                                                                    'name_en'=>$subcategory->name,
                                                                                                    'name_ar'=>$subcategory->name_ar,
                                                                                                    'img'=>$subcategory->image,
                                                                                                    // 'icon'=>$subcategory->icon,




                                                                                              ]);

                                                                                 }
                                                                                //  $data['subcatsgories']=$subcats;


                                                                                                //                $data[]=([

                                                                                                //    'id'=>$categorie->id,

                                                                                                //     'name_en'=>$categorie->name,
                                                                                                //     'name_ar'=>$categorie->name_ar,
                                                                                                //     'icon'=>$categorie->name,
                                                                                                //     'image'=>$categorie->name,
                                                                                                //     'url'=>$categorie->name,
                                                                                                //     'subcategoies'=>$subcateories,



                                                                                                //                ]);

                                                    //  }
                                                    $my_array1 = $subcats;
                                                    $my_array2 = $cats;
                                                    $data['categories'] = array_merge($my_array2, $my_array1);
                                                    return  Response::json($data);






}



//   public function category()
//   {

//     $categories=DB::table('subcategory')->get();
//     //   $categories=Category::get();

//       foreach($categories as $categorie)
//                            {
//                                $subcateories=array();

//                            $subcategories=DB::table('subcategory')->where('c_id',$categorie->id)->get();


//                            foreach ($subcategories as $subcategory) {


//                                                     //  $subcateories[]=$subcategory->name;

//                                                      $subcateories[]=([

//                                                         'id'=>$subcategory->id,
//                                                         'parent_id'=>$subcategory->c_id,
//                                                         'name_en'=>$subcategory->link,
//                                                         'name_ar'=>$subcategory->type,
//                                                         'img'=>$subcategory->img,
//                                                         'url'=>$subcategory->url,




//                                                   ]);

//                                                                    }



//                                                                    $data[]=([

//                                                        'id'=>$categorie->id,

//                                                         'name_en'=>$categorie->name,
//                                                         'name_ar'=>$categorie->name_ar,
//                                                         'icon'=>$categorie->name,
//                                                         'image'=>$categorie->name,
//                                                         'url'=>$categorie->name,
//                                                         'subcategoies'=>$subcateories,



//                                                                    ]);

//          }

//       return response::json($data);



//   }



public function register_form()
{

           $cities=City::all();
            $zones=Zone::all();


            foreach ($cities as $city) {

                      $gov[]=[
                            'id'=>$city->id,
                            'name_en'=>$city->name,
                            'name_ar'=>$city->name_ar,



                      ];

            }
            foreach ($zones as $zone) {

                $regions[]=[
                     'id'=>$zone->id,
                     'city id'=>$zone->c_id,
                      'name_en'=>$zone->name,
                      'name_ar'=>$zone->name_ar,
                      'price'=>$zone->price



                ];

      }
      $data['cities_names']=$gov;
      $data['zones_names']=$regions;
      return response::json($data);



}


public function register(Request $request)

{
 if ($request->emai='')
     {

        return Response::json('Please enter  email',405);

}elseif ($request->name=='')
{

   return Response::json('Please enter name',405);

}elseif ($request->l_name=='')
 {

    return Response::json('Please enter name',405);
}elseif ($request->user=='')
 {

    return Response::json('Please enter user',405);
}elseif ($request->mobile=='') {

    return Response::json('Please enter a mobile',405);
}elseif ($request->address=='') {

    return Response::json('Please enter address',405);
}elseif ($request->zone=='') {

    return Response::json('Please enter zone',405);
}else{
    $user=Webuser::create([

        'name'=>$request->name,
        'l_name'=>$request->l_name,
        'user'=>$request->user,
        'email'=>$request->email,
        'pass'=>Hash::make($request->pass),
        'mobile'=>$request->mobile,
        'city'=>$request->city,
        'zone'=>$request->zone,
        'address'=>$request->address,
        'token'=>Str::random(64),

    ]);


$data=[

    'msg'=>'user resister successfully',
    'token'=>$user->token,
    'user'=>$user
];

return response::json($data);


}




// $validator=Validator::make($request->all(),[

//     // 'name'=>'required|string',
//     'l_name'=>'required|string',
//     'user'=>'required|string',
//     'email'=>'unique:web_users',
//     'pass'=>'required|string',
//     'mobile'=>'required|string',
//     'city'=>'required|string',
//     'zone'=>'required|string',
//     'address'=>'required|string',
// ]);




// dd($validator->errors()->all());


//  if($validator->fails())
//  {

//     return Response::json($validator->errors(),405);


// }



// $data=[

//     'msg'=>'user resister successfully',
//     'token'=>$user->token,
//     'user'=>$user
// ];

// return response::json($data);



}



// public function logout($id)
// {


//   $user=Webuser::findOrFail($id)->update([
//       'token'=>null

//   ]);

// $data=[
//  'msg'=>'user logout successfully'

// ];
// return Response::json($data);

// }


public function login( Request $request)
{






// if(Webuser::where('user', '=',$request->user)->count()<0)
//     {

//         return Response::json('Please enter valid user',406);

//     }
//     elseif(Webuser::where('pass', '=',$request->pa)->count()>0)
//     {

//         return Response::json('Please enter unique mobile',407);

//     }

// elseif(Webuser::where('email', '=',$request->email)->count()>0)
// {

//     return Response::json('Please enter unique email',408);

// }elseif ($request->emai='')
//      {

//         return Response::json('Please enter  email',405);

// }elseif ($request->name=='')
// {

//    return Response::json('Please enter name',405);

// }elseif ($request->l_name=='')









                    // $validator= Validator::make($request->all(),[

                    //  'email'=>'required|string',
                    //  'pass'=>'required|string'

                    // ] );


// dd($request->all());




if($request->email='')
     {

        return Response::json('Please enter  email',405);

}elseif($request->pass='')
{

   return Response::json('Please enter password',406);

}else{



    $user=Webuser::where('email',$request->email)->first();

    if($user!=null)
    {

            $islogin=Hash::check($request->pass,$user->pass);
              if($islogin)
             {

                 $user=Webuser::select("id","name","l_name","user","email","mobile","city","zone","address")->where('email',$request->email)->first();

              $user->update([
                      'token'=>Str::random(64)

                          ]);
           $data=[
             'msg'=>'you login  successfully',
             'user'=>$user,
                ];


              }else{

                 $data['msg']="wrong password";
                //  return Response::json('Please enter valid password',105);

     }

    }else{
     return Response::json('Please enter valid Email',106);
 }


                return Response::json($data);

}







}
































    //  public function show($id)
    //  {
    //             $exam=Exam::findOrFail($id);

    //             return new ExamResource($exam);

    //  }





//      public function store(Request $request)
//      {



//       $validator=Validator::make($request->all(),[

//                       'name'=>'required|max:255|string',
//                       'desc'=>'required|string',
//                     //   'img'=>'required|image|mimies:jpg,png'


//         ]);

// if($validator->fails())
// {

//  return Response::json($validator->errors());

// }


//               $path=Storage::putFile("exams",$request->file('img'));


//               Exam::create([

//                               'name'=>$request->name,
//                               'desc'=>$request->desc,
//                               'img'=>$path,
//                               'cat_id'=>$request->cat_id,
//                               'questions_no'=>$request->questions_no,
//                                 "difficulty"=>$request->difficulty,
//                                 'duration_mins'=>$request->duration_mins,

//                                'skill_id'=>1
//               ]);

//              $data=[
//                  'msg'=>'data creatd successfully'
//              ];

//                      return response::json($data);
//             }





    //         public function update(Request $request,$id)
    //         {



    //          $validator=Validator::make($request->all(),[

    //                          'name'=>'required|max:255|string',
    //                          'desc'=>'required|string',
    //                        //   'img'=>'required|image|mimies:jpg,png'


    //            ]);

    //    if($validator->fails())
    //    {

    //     return Response::json($validator->errors());

    //    }


    //                  $path=Storage::putFile("exams",$request->file('img'));


    //                  Exam::create([

    //                                  'name'=>$request->name,
    //                                  'desc'=>$request->desc,
    //                                  'img'=>$path,
    //                                  'cat_id'=>$request->cat_id,
    //                                  'questions_no'=>$request->questions_no,
    //                                    "difficulty"=>$request->difficulty,
    //                                    'duration_mins'=>$request->duration_mins,

    //                                   'skill_id'=>1
    //                  ]);

    //                 $data=[
    //                     'msg'=>'data creatd successfully'
    //                 ];

    //                         return response::json($data);
    //                }




                //    public function delete($id)
                //    {



                //                   $exam=Exam::findOrFail($id);

                //                   $exam->delete();


                //                   $data=[
                //                       'msg'=>'book delete successfully'
                //                   ];



                //                   return response::json($data);
                //    }





    }
