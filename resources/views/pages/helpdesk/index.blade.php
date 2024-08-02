@extends('layouts.panel')
@section('content')
    <div style="display: flex; flex-direction: column;">
        @if (Auth::user()->department_id == 7)
            @include('pages.helpdesk.it-department-user.index', ['desks' => $desks])
        @else
            @include('pages.helpdesk.user.index', ['desks' => $desks])
        @endif

        {{ $desks->appends(request()->input())->links() }}

        @if (session()->has('error'))
            <span style="width: 100%; display:block" class="alert alert-danger">
                {{ session()->get('error') }}
            </span>
        @endif
    </div>
@endsection
