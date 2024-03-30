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
    {{ Html::form('POST', route('product.store'))->open() }}
        <div class="mb-3">
            {{ Html::label('Название', 'txtName')->for('txtName') }}
            {{ Html::text('name')->id('txtName')->class('form-control') }}
        </div>
        <div class="mb-3">
            {{ Html::label('описание товара', 'txtBody')->for('txtBody') }}
            {{ Html::textarea('body')->id('txtBody')->class('form-control')->rows(3) }}
        </div>
        <div class="mb-3">
            {{ Html::label('категория', 'txtCategory')->for('txtCategory') }}
            {{ Html::text('category')->id('txtCategory')->class('form-control') }}
        </div>
        {{ Html::submit('Добавить')->class('btn btn-primary') }}
    {{ Html::form()->close() }}
@endsection('content')
