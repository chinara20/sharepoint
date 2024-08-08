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
                    <th>Status</th>
                    <th>Tip</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requirements as $requirement)
                    <tr>
                        <td>{{ $requirement->user->name }}</td>
                        <td>{{ $requirement->requirement->name }}</td>
                        <td>{{ $requirement->status }}</td>
                        <td>{{ $requirement->type }}</td>
                        <td>
                            @if($requirement->status === 'pending')
                                <form action="{{ route('user_requirements.accept', $requirement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Qebul Et</button>
                                </form>
                            @endif
                            @if($requirement->status === 'pending')
                                <form action="{{ route('user_requirements.reject', $requirement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning">Rədd Et</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
