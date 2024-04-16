<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CatApiService;

class CatApiController extends Controller
{
 protected $apiService;

    public function __construct(CatApiService $apiService) {
        $this->apiService = $apiService;
    }

    public function showBreeds() {
        $breeds = $this->apiService->fetchBreeds();
        //  dd($breeds);
        return view('breeds.show', compact('breeds'));
    }
}
