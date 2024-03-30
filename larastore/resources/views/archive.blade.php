@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div>
                        @if(!$product->isEmpty())
                        @foreach ($product as $product_item)
                            <tr>
                                <td>
                                    <h4>{{ $product_item->name }}</h4>
                                </td>
                                <td>
                                    {{Html::form('DELETE', route('product.delete', ['product' => $product_item]))->open()}}
                                    @csrf
                                    {{ html()->submit('удалить окончательно', ['class' => 'btn btn-danger']) }}
                                    {{ html()->form()->close() }}
                                </td>
                                <td>
                                    {{Html::form('PATCH', route('restore', ['product' => $product_item]))->open()}}
                                    @csrf
                                    {{ html()->submit('восстановить', ['class' => 'btn btn-danger']) }}
                                    {{ html()->form()->close() }}
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <div>
                            {{ html()->a(route('product.create'), 'добавить товар') }}
                        </div>
                        @endif
                        {{ $product->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
