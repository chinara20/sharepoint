@extends('layouts.panel')

@section('content')
    <h1 class="mb-3" style="margin-left: 160px;">Redaktə Et</h1>

    <form class="container" action="{{ route('requirements.update', $requirement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tələb:</label>
            <select name="name" id="name" class="form-control" required>
                @foreach ($allRequirements as $req)
                    <option value="{{ $req->name }}" {{ $req->id == $requirement->id ? 'selected' : '' }}>
                        {{ $req->name }}
                    </option>
                @endforeach
            </select>
        </div>
        


        <button type="submit" class="btn btn-primary">Redaktə Et</button>
    </form>
@endsection
