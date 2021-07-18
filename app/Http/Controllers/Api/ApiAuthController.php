<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request)
    {

              $Validator=Validator::make($request->all(),[

                          'name'=>'required|string',
                          'email'=>'required|email|max:191',
                          'password'=>'required|string|confirmed|min:5|max:25'


                   ]);
                            if($Validator->fails())
                            {

                                          return Response::json($Validator->errors());

                            }


                     $user=User::create([
                               'name'=>$request->name,
                               'email'=>$request->email,
                               'password'=>Hash::make($request->password),
                               'access_token'=>Str::random(64),
                               'role_id'=>9
                      ]);
            $data=[

                'msg'=>'user register sucessfully',
                'access_token'=>$user->access_token,
                'user_id'=>$user->id
            ];

            return Response::json($data);
    }




 public function logout($id)
 {

    $user=User::findOrFail($id)->update([
        'access_token'=>null
    ]);



$data=[

    'msg'=>'logout successfully',

];


return Response::json($data);




 }




public function login(Request $request)

{


    $Validator=Validator::make($request->all(),[

        'email'=>'required|email|max:191',
        'password'=>'required'


 ]);


 if($Validator->fails())
 {

               return Response::json($Validator->errors());

 }

         $user=User::where('email','$request->email')->first();


         if($user !=null)
         {

                  $islogin=Hash::check($request->password, $user->password);


                  if($islogin)
                  {
                          $user->update([

                         'access_token'=>Str::random(64)
                                 ]);

                     $data=[

                        'msg'=>'user register sucessfully',
                        'access_token'=>$user->access_token,
                        'user_id'=>$user->id
                    ];

                  }else{



                    $data=[

                        'msg'=>'wrong password',

                    ];

                  }



         }else{
            $data=[

                'msg'=>'wrong password',

            ];
         }
         return Response::json($data);


}




}
