@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Yeni İstifadəçi əlavə et</h1>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Ad</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="surname">Soyad</label>
            <input type="text" name="surname" id="surname" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="internal_number">Daxili nömrə</label>
            <input type="text" name="internal_number" id="internal_number" class="form-control">
        </div>



        <div class="form-group">
            <label for="img">Şəkil</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>

        <div class="form-group">
            <label for="ise_qebul">İşə Qəbul Tarixi</label>
            <input type="date" name="ise_qebul" id="ise_qebul" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Əlavə et</button>
        </div>
    </form>
</div>
@endsection
