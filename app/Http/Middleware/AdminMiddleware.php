<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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

        //request变量 记录所有的请求参数
<<<<<<< HEAD
        if(!session('adminName')) {
=======
        if(session('adminName')) {
>>>>>>> bear/yangkun

        	return $next($request);
        } else {
	        return redirect('/admins/login')->withErrors('请登录账号');
	    }
  	}

}
