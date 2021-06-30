@extends('master')
@section('content')
    <div class="container">
        <form method="post" action="{{action('ProductController@update', $id)}}">
            {{csrf_field()}}
            {{ method_field('PATCH')}}
        <div class="form-group row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="_method" type="hidden" value="PATCH">
                <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg"
                           id="lgFormGroupInput" placeholder="name" name="name" value="{{$products[0]->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput"
                           value="{{$products[0]->price}}" placeholder="number" name="price">
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Currency</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput"
                           value="{{$products[0]->currency}}" placeholder="PLN" name="currency">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2"></div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
