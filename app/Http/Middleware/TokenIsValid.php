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
        if ($request->header('token') != env('API_TOKEN')) {
            //dd($request->header('token'),env('API_TOKEN'));
            return response()->json(["status" => false,'error' => 'Unauthorised', 'message' => "Api Key is Missing"], 401);
        }else
        if ($request->header('web_key') != env('WEB_KEY')) {
            return response()->json(["status" => false,'error' => 'Unauthorised', 'message' => "Web Key is Missing"], 401);
        }
        return $next($request);
    }
}
