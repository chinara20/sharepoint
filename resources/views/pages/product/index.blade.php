@extends('layouts.panel')
@section('content')
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Foto</th>
        <th>ad</th>
        <th>Tarix</th>
        <th>Funksiya</th>

    </tr>
    </thead>
    <!-- <a href="{{route('permission.create')}}">Əlavə ET</a> -->
    <a style="margin: 10px;" class="btn btn-primary" href="{{route('product.create')}}">Əlavə ET</a>
    <tbody>
        @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td><img style="height: 50px;width: 50px;" src="/storage/{{$product->img}}"></td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->created_at }}</td>
        <td>
        
                            <form action="{{ route('product.destroy',$product->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Dəyiş</a>
                                {!! csrf_field() !!}
                                {!! method_field('delete') !!}
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form>
                        </td>
    </tr>
   @endforeach
    </tbody>
</table>
@endsection