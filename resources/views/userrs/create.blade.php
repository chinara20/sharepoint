@extends('layouts.panel')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Yeni İstifadəçi Yarat</h1>

    <form action="{{ route('userrs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Ad:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Şifrə:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="requirements">Tələblər:</label>
            <div>
                @foreach ($requirements as $requirement)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="requirement_ids[]" value="{{ $requirement->id }}" id="requirement_{{ $requirement->id }}">
                        <label class="form-check-label" for="requirement_{{ $requirement->id }}">
                            {{ $requirement->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Yarat</button>
    </form>
</div>
@endsection
