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
                            {{ html()->a(route('product.create'), 'добавить статью') }}
                        </p>
                        <p>
                            {{ html()->a(route('archive'), 'корзина') }}
                        </p>
                        {{ __('You are logged in!') }}
                        @if (Auth::user()->is_admin or Auth::user()->is_creator)
                        {{html()->p('is admin - ' . Auth::user()->is_admin)}}
                        {{html()->p('is creator - ' . Auth::user()->is_creator)}}
                        @endif

{{--
                        <p> is admin {{ Auth::user()->is_admin }} </p>
                        <p> is creator {{ Auth::user()->is_creator }} </p> --}}
                    </div>
                    <div>
                        @foreach ($product as $product_item)
                            <tr>
                                <td>
                                    <h4>{{ $product_item->name }}</h4>
                                </td>

                                <td>
                                    {{ html()->form('GET', route('product.edit', ['product' => $product_item->slug]))->open() }}
                                    @csrf
                                    {{ html()->submit('редактировать', ['class' => 'btn btn-danger']) }}
                                    {{ html()->form()->close() }}
                                </td>
                                <td>
                                    {{ html()->form('DELETE', route('product.destroy', ['product' => $product_item->slug]))->open() }}
                                    @csrf
                                    {{ html()->submit('Удалить', ['class' => 'btn btn-danger']) }}
                                    {{ html()->form()->close() }}
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
