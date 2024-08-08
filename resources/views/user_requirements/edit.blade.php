@extends('layouts.panel')

@section('content')
    <h1 class="mb-3" style="margin-left: 160px;">Redaktə Et</h1>

    <form class="container" action="{{ route('user_requirements.update', $userRequirement->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="user_id">İstifadəçi:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $userRequirement->user_id ? 'selected' : '' }}>
                        {{ $user->name }} {{ $user->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tələb:</label>
            <select name="name" id="name" class="form-control" required>
                @foreach ($allRequirements as $req)
                    <option value="{{ $req->id }}" {{ $req->id == $userRequirement->requirement_id ? 'selected' : '' }}>
                        {{ $req->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $userRequirement->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $userRequirement->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $userRequirement->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div class="form-group">
            <label for="guide_user_id">Rəhbər:</label>
            <select name="guide_user_id" id="guide_user_id" class="form-control" required>
                <option value="">Seçiniz</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == ($userRequirement->guideUser ? $userRequirement->guideUser->id : null) ? 'selected' : '' }}>
                        {{ $user->name }} {{ $user->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Redaktə Et</button>
    </form>
@endsection
