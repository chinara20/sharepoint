@extends('layouts.panel')

@section('content')
<h1 class="mb-3" style="margin-left: 120px;">Yeni tələb yarat</h1>

    <form class="container" action="{{ route('requirements.store') }}" method="POST">
    @csrf
        <label for="name">Tələb:</label>
        <input type="text" name="name" id="name" required>

        <button type="submit">Yarat</button>
    </form>
@endsection

