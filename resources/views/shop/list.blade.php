@extends('master')

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/shop/shop.js')}}"></script>
@section('content')
    <div class="container">
        <input type="hidden" class="js-idCart" value="2">
        <input type="hidden" class="js-idCustomer" value="1">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Ilość</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="js-idProduct">{{$product['id_product']}}</td>
                    <td class="js-name">{{$product['name']}}</td>
                    <td class="js-price">{{$product['price']}}</td>
                    <td class="js-currency">{{$product['currency']}}</td>
                    <td><input class="js-quantity" type="text" name="quantity"></td>
                    <td><button class="btn btn-warning js-addCart" >Dodaj do koszyka</button></td>

                    {{csrf_field()}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
