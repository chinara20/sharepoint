@extends('layouts.panel')

@section('content')
    <div class="container">
        <h1>Yeni</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user_requirements.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">İstifadəçi</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Tip</label>
                <select name="type" id="type" class="form-control">
                 <option value="entry">İşə Giriş</option>
                 <option value="exit">İşdən Çıxış</option>
                </select>
            </div>
         

            <div class="form-group">
                <label for="requirement_ids">Tələblər</label>
                <div class="checkboxes">
                    @foreach ($requirements as $requirement)
                        <div class="form-check">
                            <input type="checkbox" name="requirement_ids[]" value="{{ $requirement->id }}" class="form-check-input" id="requirement_{{ $requirement->id }}">
                            <label class="form-check-label" for="requirement_{{ $requirement->id }}">{{ $requirement->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Yarat</button>
        </form>
    </div>
@endsection


