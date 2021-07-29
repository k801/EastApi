<?php

namespace App\Http\Middleware;

use App\Models\Webuser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

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

        $bearer_token = $request->bearerToken();

        if($bearer_token!=null or $bearer_token!="")
        {
            $user= DB::table("web_users")->where('token',$bearer_token)->first();
            if($user!==null)
          {
            return $next($request);

          }else{
              $data['msg']="wrong token";
          }


        }else{

            $data['msg']="no token send";
        }

                  return Response::json($data);
    }

}
