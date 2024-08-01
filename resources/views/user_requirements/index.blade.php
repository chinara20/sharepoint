@extends('layouts.panel')

@section('content')
  
    <div class="container">
        <h1 class="text-center mb-4">İstifadəçi tələbləri</h1>
        <a href="{{ route('user_requirements.create') }}" class="btn btn-primary mb-3">Yeni İstifadəçi tələbi yarat</a>
        <table class="table">
            <thead>
                <tr>
                    <th>İstifadəçi</th>
                    <th>Tələb</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->userRequirements->isNotEmpty())
                    <tr>
                        <td>{{ $user->name }} {{ $user->surname }}</td>
                        <td>
                            @foreach($user->userRequirements as $userRequirement)
                                {{ $userRequirement->requirement->name }}<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('user_requirements.edit', $user->userRequirements->first()->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('user_requirements.destroy', $user->userRequirements->first()->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
