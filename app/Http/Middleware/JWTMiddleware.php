<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = [];
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                $data["IsError"] = TRUE;
                $data["Message"] = 'Token Is Invalid';
                return response()->json($data,401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                $data["IsError"] = TRUE;
                $data["Message"] = 'Token is Expired';
                return response()->json($data,401);
            }else{
                $data["IsError"] = TRUE;
                $data["Message"] = 'Authorization Token not found';
                return response()->json($data,401);
            }
        }
        return $next($request);
    }
}