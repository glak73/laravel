<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index() {
        //Storage::get();
        return response()->view("index", ['products'=> Product::latest()->paginate(15)]);
    }
}
