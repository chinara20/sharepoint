@extends('layouts.panel')
@section('content')
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Ad</th>
        <th>Əsasnəma</th>
        <th>Prosedur</th>
        <th>Növ</th>
        <th>Işə giriş tarixi</th>
        <th>Tarix</th>
    </tr>
    </thead>
    <tbody>
    	@foreach($structures as $structure)
    <tr>
        <td>{{ $structure->id }}</td>
        <td>{{ $structure->regulation }}</td>
        <td>{{ $structure->procedure }}</td>
        <td>@if($structure->type == 1 ) departament @else Şöbə @endif </td>
        <td>{{ $user->accept_date ? $user->accept_date->format('d-m-Y') : '' }}</td>

        <td>{{ $structure->created_at }}</td>
    </tr>
   @endforeach
    </tbody>
</table>
@endsection