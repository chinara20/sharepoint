@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Redaktə et</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Ad</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="surname">Soyad</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ $user->surname }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="form-group">
            <label for="internal_number">Daxili nömrə</label>
            <input type="text" name="internal_number" id="internal_number" class="form-control" value="{{ $user->internal_number }}">
        </div>

        

        <div class="form-group">
            <label for="img">Şəkil</label>
            <input type="file" name="img" id="img" class="form-control">
            @if ($user->img)
                <img src="{{ asset('storage/' . $user->img) }}" alt="User Image" style="width: 150px; height: auto;">
            @endif
        </div>

        <div class="form-group">
            <label for="ise_qebul">İşe Qəbul Tarixi</label>
            <input type="date" name="ise_qebul" id="ise_qebul" class="form-control" value="{{ $user->ise_qebul }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Redaktə et</button>
        </div>
    </form>
</div>
@endsection
