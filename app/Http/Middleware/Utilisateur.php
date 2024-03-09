<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Utilisateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Session::get('user_id');
        $role_id = Session::get('role_id');

        if (empty($user_id)) {
            return redirect('/');
        }
        else
        if($role_id == 3){
            
            return $next($request);
        }
        else{
            return redirect('/');
        }
    }
}
