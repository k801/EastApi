<?php

namespace App\Http\Middleware;

use App\Models\Webuser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class islogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        $header=$request->header('token');
        if($header!=="" or $header!=="")
        {

           $user= Webuser::where('token',$header)->first();
           if($user!==null)
          {
            return $next($request);

          }else{
              $data['msg']="wrong token";
          }


        }else{

            $data['msg']="no token";
        }


                  return Response::json($data);
    }





}
