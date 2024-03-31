@extends('layouts.app')

@section('title', 'Добавление книги ::моя библиотека')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ html()->modelForm($product, 'PATCH', route('product.update', ['product' => $product->slug]))->class('form-horizontal')->open() }}

    <div class="mb-3">
        {{ html()->label('Название')->for('name') }}
        {{ html()->text('name')->class('form-control')->value($product->name) }}
    </div>

    <div class="mb-3">
        {{ html()->label('Описание товара')->for('body') }}
        {{ html()->textarea('body')->class('form-control')->rows(3)->value(Storage::get($product->file_name)) }}
    </div>

    <div class="mb-3">
        {{ html()->label('Категория')->for('category') }}
        {{ html()->text('category')->class('form-control')->value($product->category->title) }}
    </div>
    <div class="mb-3">
        {!! Captcha::img()  !!}
        <div>
            {{ Html::label('captcha', 'captcha')->for('captcha') }}
            <div><input name="captcha" class="form-control"></div>
        </div>
    </div>
    {{ html()->submit('Редактировать')->class('btn btn-primary') }}

    {{ html()->closeModelForm() }}
@endsection('content')
