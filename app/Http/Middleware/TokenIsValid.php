<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = '1|WnM7JDwUoOuM3BoCqrDfErQZrw58haoDUvuePhgK';
        $b = 'Bearer';
        $auth = $b." ".$token;
        if ($request->header('Authorization') != $auth) {
        //
        dd($auth,$request->header('Authorization'));
            //return response()->json(["status" => false,'error' => 'Unauthorised', 'message' => "Api Key is Missing"], 401);
        }
        return $next($request);
    }
}
