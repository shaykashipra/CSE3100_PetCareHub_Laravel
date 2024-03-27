<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceptTermsController extends Controller
{
    public function see_conditions()
    {

        return view('pets.conditions');

    }}
