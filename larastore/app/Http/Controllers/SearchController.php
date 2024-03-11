<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name','LIKE','%'.$query. '%')->get();

        return view('search.result', ['context' => $products]);
    }
}
