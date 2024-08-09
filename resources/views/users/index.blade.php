@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Istifadəçilər</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Yeni istifadəçi əlavə et</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Daxili nömrə</th>
                <th>İşə qəbul tarixi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->internal_number }}</td>
                    <td>{{ $user->ise_qebul ? $user->ise_qebul->format('d-m-Y') : '' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Redaktə et</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">İstifadəçi tapılmadı.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
