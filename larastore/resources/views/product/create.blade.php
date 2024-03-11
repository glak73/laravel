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
<form action="{{ route('product.store') }}" method="POST">
 @csrf
 <div class="mb-3">
 <label for="txtTitle" class="form-label">Название</label>
 <input name="name" id="txtName" class="form-control">
 </div>
 <div class="mb-3">
 <label for="txtBody" class="form-label">описание товара</label>
 <textarea name="body" id="txtBody" class="form-control"
 row="3"></textarea>
 </div>
 <div class="mb-3">
 <label for="txtGenre" class="form-label">категория</label>
 <input name="category" id="txtCategory" class="form-control">
 </div>
 <input type="submit" class="btn btn-primary" value="Добавить">
</form>
@endsection('content')
