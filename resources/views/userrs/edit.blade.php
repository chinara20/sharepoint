@extends('layouts.panel')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-center my-4">Tələbi Redaktə Et</h1>

    <form action="{{ route('user_requirements.update', $userRequirement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">İstifadəçi ID:</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ old('user_id', $userRequirement->user_id) }}" required>
        </div>

        <div class="form-group">
            <label for="requirement_id">Tələb ID:</label>
            <input type="text" class="form-control" id="requirement_id" name="requirement_id" value="{{ old('requirement_id', $userRequirement->requirement_id) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Yadda Saxla</button>
    </form>
</div>
@endsection
