@extends('layouts.panel')

@section('content')
    <h1 class="mb-3" style="margin-left: 160px;">Redaktə et</h1>

    <form class="container" action="{{ route('requirements.update', $requirement->id) }}" method="POST">
    @csrf
        @method('PUT')
        <label for="name">Tələb:</label>
        <input type="text" name="name" id="name" value="{{ $requirement->name }}" required>

        <button type="submit">Redaktə et</button>
    </form>
@endsection

