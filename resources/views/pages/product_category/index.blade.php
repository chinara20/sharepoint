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
    <a style="margin: 10px;" class="btn btn-primary" href="{{route('product_category.create')}}">Əlavə ET</a>
    <tbody>
    	@foreach($product_categories as $product_category)
    <tr>
        <td>{{ $product_category->id }}</td>
        <td><img style="height: 50px;width: 50px;" src="/storage/{{$product_category->img}}"></td>
        <td>{{ $product_category->name }}</td>
        <td>{{ $product_category->created_at }}</td>
        <td>
        
                            <form action="{{ route('product_category.destroy',$product_category->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('product_category.edit',$product_category->id) }}">Dəyiş</a>
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