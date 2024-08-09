@extends('layouts.panel')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">İstifadəçi Tələbləri</h1>
        @if(Auth::user()->department_id == 10)
            <a href="{{ route('user_requirements.create') }}" class="btn btn-primary mb-3">Yeni İstifadəçi Tələbi Yarat</a>
        @endif
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
                        <td>@if($requirement->requirement){{ $requirement->requirement->name }} @else - @endif</td>
                        <td>{{ $requirement->status }}</td>
                        <td>{{ $requirement->type }}</td>
                        <td>
                            @if($requirement->status === 'pending' && Auth::user()->department_id == 10)
                                <form action="{{ route('user_requirements.accept', $requirement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Qəbul Et</button>
                                </form>
                                <form action="{{ route('user_requirements.reject', $requirement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger">Rədd Et</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
