@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <a href="{{ route('product.create') }}">добавить товар</a>
                        </p>
                        {{ __('You are logged in!') }}
                    </div>
                    <div>
                        @foreach ($product as $product_item)
                            <tr>
                                <td>
                                    <h4>{{ $product_item->name }}</h4>
                                </td>
                                <td>
                                    <form action="{{ route('product.delete', ['product' => $product_item]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Удалить">
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('restore', ['product' => $product_item]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="submit" class="btn btn-success" value="восстановить">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{ $product->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
