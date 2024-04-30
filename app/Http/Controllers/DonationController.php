<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order; 
class DonationController extends Controller
{
    public function edit(){
        if(session()->has('user_id')){
            $user=User::findOrFail(session()->get('user_id'));
     
       return  view('payment.donation',compact('user'));
        }
        else{
                  return  view('payment.donation');
 
        }
    }

    public function show(){
        $orders=Order::all();
        return view('payment.donation_list',['orders'=>$orders]);
    }

}
