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

use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

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

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // Получаем оригинальное имя файла
        $originalName = $request->file('product_avatar')->getClientOriginalName();

        // Сохраняем файл в директорию 'product_avatars' с его оригинальным именем
        // $path = $request->file('product_avatar')->storeAs('product_avatars', $originalName, 'public');
        $file = $request->file('product_avatar');
        $originalExtension = $file->getClientOriginalExtension();
        $newName = uniqid() . '.' . $originalExtension;
        $path = $file->storeAs('product_avatars', $newName, 'public');

        // Создаем или получаем категорию
        $category = Category::firstOrCreate(['title' => $request->category]);
        $file_name = md5(time() . mt_rand()) . '.txt';
        Storage::disk('public')->put('product_description/' . $file_name, $request['body']);
        $description_path = 'product_description/' . $file_name;
        Auth::user()->product()->create([
            'name' => $request['name'],
            'category_id' => $category->id,
            'file_name' => $description_path,
            'product_avatar' => $path
        ]);

        return redirect()->route('home');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $file_path = storage_path('app/public/' . $product->file_name);
        $file_content = file_get_contents($file_path);
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
        $category = Category::firstOrCreate(['title' => $request->category]);
        $file_path = $product->file_name;
        Storage::disk('local')->put($file_path, $request['body']);
        if ($request['name'] != $product->name) {
            $product->update([
                'name' => $request['name'],
                'category_id' => $category->id
            ]);
        } else {
            $product->update([
                'category_id' => $category->id
            ]);
        }


        return redirect()->route('index', ['products' => Product::latest()->get()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {

        $product->delete();

        return redirect()->route('archive');
    }

    public function delete(Product $product)
    {
        Storage::delete($product->file_name);
        $product->forceDelete();
        return redirect()->route('archive');
    }

    public function restore(Product $product)
    {
        $product->restore();
        return redirect()->route('home');
    }
}
