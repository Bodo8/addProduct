@extends('master')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product['id_product']}}</td>
                    <td>{{$product['name']}}</td>
                    <td>{{$product['price']}}</td>
                    <td>{{$product['currency']}}</td>
                    <td><a href="{{action('ProductController@edit', $product['id_product'])}}"
                           class="btn btn-warning">Edit</a></td>
                    <td><a href="{{action('ProductController@destroy', $product['id_product'])}}"
                           class="btn btn-danger">Delete</a></td>
                    {{csrf_field()}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection