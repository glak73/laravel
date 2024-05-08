<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>товары</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @extends('layouts.app')
        @section('title', 'Главная')
        @section('content')
            <h1 class="my-3 text-center">все книги</h1>

            @foreach ($products as $product)
                <tr>
                    <td>
                        {{ Element::withTag('h4')->text('название статьи - ' . $product->name) }}
                        {{ html()->p()->text('название категории - ' . $product->category->title) }}
                        {{ html()->p()->text('айди категории - ' . $product->category->id) }}
                        {{ html()->p()->text('айди пользователя - ' . $product->user_id) }}
                        {{-- {{ html()->p()->text('текст описания - ' . Storage::get($product->file_name)) }} --}}
                        {{ html()->a()->href(route('product.show', ['product' => $product->slug]))->text('подробнее...') }}
                    </td>
                </tr>
            @endforeach
            {{ $products->links() }}
        @endsection('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
