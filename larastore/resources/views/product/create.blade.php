@extends('layouts.app')
@section('title', 'добавление товара ::админка')
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
    {{ Html::form('POST', route('product.store'))->acceptsFiles()->open() }}
    <div class="mb-3">
        {{ Html::label('Название', 'txtName')->for('txtName') }}
        {{ Html::text('name')->id('txtName')->class('form-control') }}
    </div>
    <div class="mb-3">
        {{ Html::label('текст статьи', 'txtBody')->for('txtBody') }}
        {{ Html::textarea('body')->id('txtBody')->class('form-control')->rows(3) }}
    </div>
    <div class="mb-3">
        {{ Html::label('категория', 'txtCategory')->for('txtCategory') }}
        {{ Html::text('category')->id('txtCategory')->class('form-control') }}
    </div>
    <div class="mb-3">
        {!! Captcha::img()  !!}
        <div>
            {{ Html::label('captcha', 'captcha')->for('captcha') }}
            <div><input name="captcha" class="form-control"></div>
        </div>
    </div>
    </div>
    <div class="mb-3">
        {{ Html::label('изображение товара', 'txtBody')->for('product_avatar') }}
    {{ html()->file('product_avatar')->class('form-control')}}
    </div>
    {{ Html::submit('Добавить')->class('btn btn-primary') }}
    {{ Html::form()->close() }}
@endsection('content')
