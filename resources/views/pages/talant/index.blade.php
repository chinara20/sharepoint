@extends('layouts.panel')
@section('content')
<table class="table">
    <a class="btn button btn-succes" href="{{route('talant.create')}}">Əlavə Et</a>

    <thead>
    <tr>
        <th>#</th>
        <th>Göndərən şəxs</th>
        <th>Başlıq</th>
        <th>Məlumat</th>
        <th>Fayl</th>
        <th>Tarix</th>
    </tr>
    </thead>
    <tbody>
    	@foreach($talants as $structure)
    <tr>
        <td>{{ $structure->id }}</td>
        <td>{{ $structure->user->name }}</td>
        
        <td>{{ $structure->title }}</td>
        <td>{{ $structure->description }}</td>
        <td><a href="/storage/{{ $structure->file }}">Fayl</a></td>
        <td>{{ $structure->created_at }}</td>
    </tr>
   @endforeach
    </tbody>
</table>
@endsection