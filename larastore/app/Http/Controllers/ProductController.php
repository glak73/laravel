<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;
class ProductController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-product');
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $category = Category::firstOrCreate(['title' => $request->category]);
        $file_name = md5(time() . mt_rand()) . '.txt';
        Storage::disk('local')->put($file_name, $request['body']);
        Auth::user()->product()->create([
            'name' => $request['name'],
            'category_id' => $category->id,
            'file_name' => $file_name
        ]);

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $file_content = Storage::get($product->file_name);
        return view('product.detail', ['product' => $product, 'content' => $file_content]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $category = Category::firstOrCreate(['title'=> $request->category]);
        $file_path = $product->file_name;
        Storage::disk('local')->put($file_path, $request['body']);
        if ($request['name'] != $product->name) {
            $product->update([
                'name' => $request['name'],
                'category_id'=> $category->id
            ]);
        } else {
            $product->update([
                'category_id'=> $category->id
            ]);
        }



        return redirect()->route('index', ['products' => Product::latest()->get()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //$obj = Product::find($request['product']);
        $obj = Product::withTrashed()->where('slug', $request['product'])->first();
        if (!$obj) {
            return redirect()->route('index');
        }
        if (!$obj->trashed()) {
            $obj->delete();
        } else {
            Storage::delete($obj->file_name);
            $obj->forceDelete();
        }

        return redirect()->route('archive');

    }

    public function restore(Product $product)
    {
        $product->restore();
        return redirect()->route('home');
    }
}
