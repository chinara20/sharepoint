@extends('layouts.panel')

@section('content')
    <h1 class="mb-3" style="margin-left: 160px;">Redaktə Et</h1>

    <form class="container" action="{{ route('requirements.update', $requirement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tələb:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $requirement->name }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $requirement->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $requirement->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $requirement->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Redaktə Et</button>
    </form>
@endsection
