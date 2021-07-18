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


class ApiExamController extends Controller
{


    public function get_products($id)
    {

            $orders=Order::where('client_id',$id)->get();
            // dd($orders);
              foreach ($orders as $order)
                  {

                    $products=array();

                            $items=OrderItem::where('order_id',$order->order_id)->get();

                                   foreach ($items as $item)
                                        {

                                            $products[]=$item;
                                          }

                            $data[]=([

                                'order_id'=>$order->order_id,
                                'client_mobile'=>$order->client_mobile,
                                'client_id'=>$order->client_id,
                                'items_c'=>$order->items_c,
                                'total'=>$order->total,
                                'is_voucher'=>$order->is_voucher,
                                'voucher_id'=>$order->voucher_id,
                                'voucher_value'=>$order->voucher_value,
                                'shipping_value'=>$order->shipping_value,
                                'payment_method'=>$order->payment_method,
                                'payment_type'=>$order->payment_type,
                                'ins_months'=>$order->ins_months,
                                'type'=>$order->type,
                                'status'=>$order->status,
                                'order_integration'=>$order->order_integration,
                                'mobile_wallet'=>$order->mobile_wallet,
                                'items'=>$products,

                                           ]);

            }




            return Response::json($data);


    }

    public function index()
    {

                     $items=Item::get();


                     $data['newArrival']=Item::orderby('id','desc')->take(50)->get();
                     $data['offers']=Item::orderby('id','desc')->take(50)->get();

                     foreach($items as $item)
                                           {
                                            $images=array();

                                            $imgs=DB::table('img_key')->where('img_key',$item->img_key )->get();

                                                           foreach ($imgs as $img) {

                                                                               $images[]=$img->img;

                                                                            }

                                                    $data[]=([

                                                      'img'=>$images,
                                                     "category"=>$item->category,
                                                      "scategory"=>$item->scategory,
                                                      "brand"=>$item->brand,
                                                      "name_ar"=>$item->name,
                                                      "name_ar"=>$item->name_ar,
                                                      "model"=>$item->model,
                                                      "model_ar"=>$item->model_ar,
                                                      "short"=>strip_tags($item->short),
                                                      "short_ar"=>strip_tags($item->short_ar),
                                                      "des"=>strip_tags($item->des),
                                                      "des_ar"=>strip_tags($item->des_ar),
                                                      "stock"=>$item->stock,
                                                      "old_price"=>$item->old_price,
                                                      "price"=>$item->price,
                                                      "c_price"=>$item->c_price,
                                                      "p_price"=>$item->p_price,
                                                      "weight"=>$item->weight,
                                                      "point"=>$item->point,
                                                      "os_system"=>$item->os_system,
                                                      "processor"=>$item->processor,
                                                      "processor_g"=>$item->processor,
                                                      "color"=>$item->color,
                                                      "img_key"=>$item->img_key,
                                                      "att_key"=>$item->att_key,
                                                      "views"=>$item->views,
                                                      "option_key"=>$item->option_key,
                                                      "meta_key"=>$item->meta_key,
                                                      "published"=>$item->published,
                                                      "type"=>$item->type,
                                                      "seller"=>$item->seller,
                                                      "agent"=>$item->agent,
                                                      "date"=>$item->date,
                                                      "time"=>$item->time,
                                                      "API_code"=>$item->API_code,
                                                      "url"=>$item->url,

                                                ]);









                                                }

                                         return Response::json($data);

                                        //  return json_encode(array_map(null, $data, $images));



}



  public function category()
  {

      $categories=Category::get();

      foreach($categories as $categorie)
                           {
                               $subcateories=array();
                           $subcategories=SubCategory::where('c_id',$categorie->id)->get();


                           foreach ($subcategories as $subcategory) {


                                                     $subcateories[]=$subcategory->name;



                                                                   }



                                                                   $data[]=([

                                                        'name'=>$categorie->name,
                                                        'name_ar'=>$categorie->name,
                                                        'icon'=>$categorie->name,
                                                        'image'=>$categorie->name,
                                                        'url'=>$categorie->name,
                                                        'subcategoies'=>$subcateories,



                                                                   ]);

         }

      return response::json($data);



  }



public function register_form()
{

            $data['cities']=City::all();
            $data['zones']=Zone::all();

            return response::json($data);



}


public function register(Request $request)
{

$validator=Validator::make($request->all(),[

    'name'=>'required|string',
    'l_name'=>'required|string',
    'user'=>'required|string',
    'email'=>'required|string',
    'pass'=>'required|string',
    'mobile'=>'required|string',
    'city'=>'required|string',
    'zone'=>'required|string',
    'address'=>'required|string',
    'token'=>Str::random(64),

]);


 if($validator->fails())
 {

  return response::json($validator->errors());

}


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
    'use_id'=>$user->id
];

return response::json($data);



}



public function logout($id)
{


  $user=Webuser::findOrFail($id)->update([
      'token'=>null

  ]);

$data=[
 'msg'=>'user logout successfully'

];
return Response::json($data);

}


public function login( Request $request)
{


                    $validator= Validator::make($request->all(),[

                     'email'=>'required|string',
                     'pass'=>'required|string'

                    ] );


// dd($request->all());
               $user=Webuser::where('email',$request->email)->first();


               if($user !=null)
               {

                       $islogin=Hash::check($request->pass,$user->pass);
                         if($islogin)
                        {
                         $user->update([
                                 'token'=>Str::random(64)

                                          ]);
                      $data=[
                        'msg'=>'you login  successfully',
                        'token'=>$user->token,
                        'id'=>$user->id

                           ];


                         }else{

                            $data['msg']="wrong password";
                         }

               }else{
                   $data['msg']="wrong Email";
               }


                           return Response::json($data);

}


     public function show($id)
     {
                $exam=Exam::findOrFail($id);

                return new ExamResource($exam);

     }





     public function store(Request $request)
     {



      $validator=Validator::make($request->all(),[

                      'name'=>'required|max:255|string',
                      'desc'=>'required|string',
                    //   'img'=>'required|image|mimies:jpg,png'


        ]);

if($validator->fails())
{

 return Response::json($validator->errors());

}


              $path=Storage::putFile("exams",$request->file('img'));


              Exam::create([

                              'name'=>$request->name,
                              'desc'=>$request->desc,
                              'img'=>$path,
                              'cat_id'=>$request->cat_id,
                              'questions_no'=>$request->questions_no,
                                "difficulty"=>$request->difficulty,
                                'duration_mins'=>$request->duration_mins,

                               'skill_id'=>1
              ]);

             $data=[
                 'msg'=>'data creatd successfully'
             ];

                     return response::json($data);
            }





            public function update(Request $request,$id)
            {



             $validator=Validator::make($request->all(),[

                             'name'=>'required|max:255|string',
                             'desc'=>'required|string',
                           //   'img'=>'required|image|mimies:jpg,png'


               ]);

       if($validator->fails())
       {

        return Response::json($validator->errors());

       }


                     $path=Storage::putFile("exams",$request->file('img'));


                     Exam::create([

                                     'name'=>$request->name,
                                     'desc'=>$request->desc,
                                     'img'=>$path,
                                     'cat_id'=>$request->cat_id,
                                     'questions_no'=>$request->questions_no,
                                       "difficulty"=>$request->difficulty,
                                       'duration_mins'=>$request->duration_mins,

                                      'skill_id'=>1
                     ]);

                    $data=[
                        'msg'=>'data creatd successfully'
                    ];

                            return response::json($data);
                   }




                   public function delete($id)
                   {



                                  $exam=Exam::findOrFail($id);

                                  $exam->delete();


                                  $data=[
                                      'msg'=>'book delete successfully'
                                  ];



                                  return response::json($data);
                   }



        }
