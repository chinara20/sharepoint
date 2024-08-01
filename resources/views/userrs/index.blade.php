@extends('layouts.panel')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-center my-4">İstifadəçi Siyahısı</h1>

    <a href="{{ route('userrs.create') }}" class="btn btn-primary mb-3">Yeni İstifadəçi Yarat</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Email</th>
                <th>Şifrə</th>
                <th>Tələblər</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        @foreach ($user->userRequirements as $userRequirement)
                            <div>{{ $userRequirement->requirement->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @if($user->userRequirements->isNotEmpty())
                            <a href="{{ route('user-requirements.edit', $user->userRequirements->first()->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
