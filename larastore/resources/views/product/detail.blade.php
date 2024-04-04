<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>


<body>
<div class="container">
    @extends('layouts.app')

    @section('content')
        <div class="product-card">
            <div class="product-details">
                {{html()->p()->text($product->name)}}
                {{html()->p()->text($content)}}
                {{ html()->a()->href(route('index'))->text('На главную')->class('back-link') }}
            </div>
            {{html()->img(asset($product->product_avatar))->class("product-image img-thumbnail")}}
        </div>
    @endsection('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</body>
</html>
