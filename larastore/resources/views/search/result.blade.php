<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>товары</title>

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
        </td>
        <td>
            {{Element::withTag('p')->text('Название категории - ' . $product->category->title)}}
        </td>
        <td>
            {!!Element::withTag('p')->text(BBCode::convertTohtml('ID продавца- ' . $product->user_id))!!}
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

</body>

</html>
