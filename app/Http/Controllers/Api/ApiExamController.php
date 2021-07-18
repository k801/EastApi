<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Validator;

class ApiExamController extends Controller
{

    public function index()
    {

                     $items=Item::get();

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
