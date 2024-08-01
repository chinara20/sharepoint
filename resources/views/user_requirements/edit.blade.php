@extends('layouts.panel')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Redaktə et</h1>

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

        <button type="submit">Redaktə</button>
    </form>

    <form action="{{ route('user_requirements.destroy', $userRequirement->id) }}" method="POST" style="display:inline;">
        @csrf
        <!-- @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Sil</button> -->
    </form>

    <a href="{{ route('user_requirements.index') }}">Geri</a>
</div>
@endsection
