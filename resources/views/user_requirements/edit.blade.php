@extends('layouts.panel')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Redaktə Et</h1>

        <form action="{{ route('user_requirements.update', $userRequirement->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <h2>Tələblər</h2>
            <ul>
                @foreach ($requirements as $requirement)
                    <li>
                        <input type="checkbox" name="requirement_ids[]" value="{{ $requirement->id }}"
                            {{ in_array($requirement->id, $userRequirement->user->userRequirements->pluck('requirement_id')->toArray()) ? 'checked' : '' }}>
                        {{ $requirement->name }}
                    </li>
                @endforeach
            </ul>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $userRequirement->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $userRequirement->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $userRequirement->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Redaktə Et</button>
        </form>

        <form action="{{ route('user_requirements.destroy', $userRequirement->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
        </form>

        <a href="{{ route('user_requirements.index') }}" class="btn btn-secondary">Geri</a>
    </div>
@endsection
