<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
         if ($request->session()->has('user_id')) {
            $user = User::find($request->session()->has('user_id'));
            // if(!$user) {
             if ( $user && $user->is_admin == 1) {  
                $request->attributes->add(['user' => $user]);
                return $next($request);

            }
            else{
                return Redirect::route('login')->with('message', 'Access Denied. Please log in as an admin.');

        }
    }
    else{
    
        return Redirect::route('login')->with('message', 'Access Denied. Please log in.');
    }
}

}
