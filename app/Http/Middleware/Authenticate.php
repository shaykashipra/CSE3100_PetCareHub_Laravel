<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if ($request->session()->has('user_id')) {
        //    if(User::find($request->session()->get('user_id'))->is_admin == '0'){
                        $request->attributes->add(['user' => User::find($request->session()->get('user_id'))]);
                        return $next($request);

            // }
                // return Redirect::route('login')->with('message', 'Access Denied. Please log in as an admin.');

        }
    
        return Redirect::route('main')->with('message', 'Access Denied. Please log in.');
    }
    }

