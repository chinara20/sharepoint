@extends('layouts.panel')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-7 offset-md-2">
            <h1 class="text-center mb-4">Tələb Siyahısı</h1>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('requirements.create') }}" class="btn btn-primary">Yeni tələb yarat</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Ad</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requirements as $requirement)
                            <tr>
                                <td>{{ $requirement->name }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('requirements.edit', $requirement->id) }}" class="btn  btn-sm mr-2">Redaktə et</a>
                                    <form action="{{ route('requirements.destroy', $requirement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
