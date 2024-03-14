<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;


class ProductTest extends TestCase
{
    //use RefreshDatabase;

    public function test_product_can_be_created()
    {
        $product = Product::factory()->create();

        $this->assertDatabaseHas(
            'products',
            ['name' => $product->name]
        );
    }


    public function test_product_cannot_be_created_with_duplicate_name()
    {

        $this->expectException(QueryException::class);

        $product = Product::factory()->create();

        $product_new = Product::factory()->make([
            'name' => $product->name, // Попытка создать продукт с уже существующим именем
        ]);
        $product_new->save();
    }
    public function test_product_cannot_be_created_with_invalid_data()
    {
        $this->expectException(QueryException::class);
        $product = Product::factory()->make([
            'name' => '', // Неверные данные
        ]);
        $product->save();

    }
}
