@extends('layouts.panel')

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Sifariş Yarat</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('orders.store') }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="company_name">Vergi Ödəyicisinin Adı</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="voen">VÖEN</label>
                    <input type="text" name="voen" id="voen" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="full_name">Ad Soyad</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="object_name">Obyekt Adı</label>
                    <input type="text" name="object_name" id="object_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="product_id">Məhsul</label>
                    <select name="product_id" id="product_id" class="form-control">
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Qiymət</label>
                    <input type="text" value="50.00" name="price" id="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="qty">Ədəd</label>
                    <input type="text" name="qty" id="qty" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="comment">Şərh</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Yarat</button>
            </form>
        </div>
    </div>
@endsection
