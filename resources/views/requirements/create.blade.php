@extends('layouts.panel')

@section('content')
    <div class="container">
        <h1>Yeni Tələb Yarat</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('requirements.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tələb Adı:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Yarat</button>
        </form>
    </div>
@endsection
