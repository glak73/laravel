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
        <h1 class="my-3 text-center">Было найдено:</h1>

</div>
@forelse ($context as $product)
    <tr>
        <td>
            {{Element::withTag('h4')->text('Название товара - ' . $product->name)}}
            {{--                    <h4>название товара - {{ $product->name }}</h4>--}}
        </td>
        <td>
            {{Element::withTag('p')->text('Название категории - ' . $product->category->title)}}
        </td>
        <td>
            {!!Element::withTag('p')->text(BBCode::convertTohtml('[b]ID продавца- [/b]' . $product->user_id))!!}
        </td>

        <td>
        {{Element::withTag('p')->text('Текст описания - ' . Storage::get($product->file_name))}}
        <td>
            {{html()->a()->href(route('product.show', ['product' => $product->slug]))->text('Подробнее...')}}
        </td>

    </tr>
@empty
    {{Element::withTag('p')->text('поиск ничего не дал(')}}
    {{html()->a()->href(route('index'))->text('Вернуться на главную')}}
@endforelse
@endsection('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
</body>

</html>
