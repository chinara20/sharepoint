@extends('layouts.panel')
@section('content')
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Başlıq</th>
        <th>Slug</th>
        <th>Tarix</th>
        <th>Funksiya</th>

    </tr>
    </thead>
    <!-- <a href="{{route('page.create')}}">Əlavə ET</a> -->
    <a style="margin: 10px;" class="btn btn-primary" href="{{route('page.create')}}">Əlavə ET</a>
    <tbody>
    	@foreach($pages as $page)
    <tr>
        <td>{{ $page->id }}</td>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>{{ $page->created_at }}</td>
        <td>
                            <form action="{{ route('page.destroy',$page->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('page.edit',$page->id) }}">Edit</a>
                                {!! csrf_field() !!}
                                {!! method_field('delete') !!}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
    </tr>
   @endforeach
    </tbody>
</table>
@endsection