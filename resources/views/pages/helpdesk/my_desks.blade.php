@extends('layouts.panel')
@section('content')
    <div class="margin:0 40px;">
        <div class="info-heading">
            <h5>
                Üzərimdə olan sorğular
            </h5>
            <p>Bu səhifədə üzərinizdə olan bütün sorğular görünməkdədir.</p>
        </div>
        @if (Auth::user()->department_id === 7)
            <div>
                <table class="table permissionsTable">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>AD \ SOYAD</th>
                            <th>ŞÖBƏ</th>
                            <th>SORĞU</th>
                            <th>BAŞLIQ</th>
                            <th>YARADILMA TARİXİ</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($my_desks as $desk)
                            <tr>
                                <td>H-{{ str_pad($desk->desk->id, 6, 0, STR_PAD_LEFT) }}</td>
                                <td>{{ $desk->desk->user->name }}</td>
                                <td>
                                @if ($desk->desk->user->show_department)
                                    {{ $desk->desk->user->show_department->name ? $desk->desk->user->show_department->name : $desk->desk->user->show_branch->name }}
                                @else
                                -
                                @endif
                                </td>
                                <td>{{ $desk->desk->subject->name }}</td>
                                <td>{{ $desk->desk->title }}</td>
                                <td>{{ $desk->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <a class="btn btn-{{ $desk->desk->get_status()['class'] }}">
                                        {!! $desk->desk->get_status()['text'] !!}
                                    </a>
                                </td>
                                <td>
                                    @if ($desk->desk->responder->user->id == Auth::user()->id)
                                        <a href="{{ route('helpdesk.index') . '/' . $desk->desk->id }}">Bax</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- {{ $my_desks->links() }} --}}

        @if (session()->has('error'))
            <span style="width: 100%; display:block" class="alert alert-danger">
                {{ session()->get('error') }}
            </span>
        @endif
    </div>
@endsection
