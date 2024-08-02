@extends('layouts.panel')
@section('content')
    <div style="display: flex; flex-direction: column;">
        <div class="margin:0 40px;">
            <div class="info-heading">
                <h5>
                    @if(Auth::user()->id != 1)
                        Müraciətlərim
                    @else
                        Müraciətlər
                    @endif
                </h5>
                <p>
                @if(Auth::user()->id != 1)
                        Bütün müraciətlərinizi bu səhifədən görə bilərsiniz.
                    @else
                        Bütün müraciətləri bu səhifədən görə bilərsiniz.
                    @endif    
                </p>
            </div>

            @if(Auth::user()->id != 1)
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('appeals.create') }}">
                  YENİ  MÜRACİƏT
                </a>
            @endif
            <table class="table permissionsTable">
                <thead>
                    <tr>
                        <th>Müraciət edən</th>
                        <th>Struktur / bölmə</th>
                        <th>Mövzu</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appeals as $appeal)
                        <tr>
                            <td>
                                <img width="50" height="50" src="/storage/{{ $appeal->user->img }}" alt="">
                                {{ $appeal->user->name }}
                            </td>
                            <td>
                                {{ $appeal->user->show_department->name ?? '' }} /
                                {{ $appeal->user->show_branch->name ?? '' }}
                            </td>
                            <td>{{ $appeal->title ?? '' }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('appeals.show', $appeal->id) }}">Bax</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Sorğunuz yoxdur.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- $desks->appends(request()->input())->links() --}}

        @if (session()->has('error'))
            <span style="width: 100%; display:block" class="alert alert-danger">
                {{ session()->get('error') }}
            </span>
        @endif
    </div>
@endsection
