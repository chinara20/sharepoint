@php
    // dd($users);
@endphp
@extends('layouts.panel')
@section('content')
    <div>
        <form action="" class="permissions_filter">
            <div class="form-group">
                <label style="display: block;" for="exampleInputPassword1">İşçi</label>

                <select id='myselect' name="user_id">
                    <option value=" " selected>Hamısı</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->user->id }}" @if (request('user_id') == $user->user->id) selected @endif>
                            {{ $user->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label style="display: block;" for="exampleInputPassword1">İcazə tarix aralığı</label>
                <input type="date" name="time_start" id="start_date" class="form-control" id="exampleInputPassword1"
                    value="{{ request('time_start') }}">
            </div>

            <div class="form-group">
                <label style="display: block;" for="exampleInputPassword1"> </label>
                <input type="date" name="time_end" id="start_date" class="form-control" id="exampleInputPassword1"
                    value="{{ request('time_end') }}">
            </div>

            <div class="form-groups">
                <label style="display: block;" for="exampleInputPassword1"> </label>
                <button type="submit" class="btn btn-primary">Axtar</button>
            </div>

        </form>
        <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('permission.create') }}">Əlavə
            ET</a>
        <a style="margin: 10px;margin-top: 40px;" class="btn btn-success"
            href="{{ route('permissions_download', ['type' => 'xlsx', 'user_id' => request('user_id'), 'time_start' => request('time_start'), 'time_end' => request('time_end')]) }}">Excel</a>

        <script>
            $('#myselect').select2({
                width: '101%',
                height: '35px',
                placeholder: "Siyahıdan seçin",
                allowClear: true
            });
        </script>


        <table class="table permissionsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad / Soyad</th>
                    <th>İcazə Səbəbi</th>
                    <th>Başlama Tarixi</th>
                    <th>Bitmə Tarixi</th>
                    <th>İcazə müddəti</th>
                    <th>Növ</th>
                    <th>Rəhbər</th>
                    <th>Status</th>
                    <th>Funksiya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    {{-- @php dd($permission->get_status()) @endphp --}}
                    <tr>
                        <th>{{ $permission->id }}</th>
                        <th>{{ $permission->user->name }}</th>
                        <td>
                            @if ($permission->subject === 'Digər')
                                {{ 'Digər : ' . $permission->description }}
                            @else
                                {{ $permission->subject }}
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($permission->time_start)->format('d.m.Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($permission->time_end)->format('d.m.Y H:i:s')  }}</td>
                        <td>{{ $permission->permission_time }}</td>
                        <td>Ödənişli</td>
                        <td>{{ $permission->confirmed_by->name }}</td>
                        <td>
                            @if ($permission->status == 0)
                                <a class="btn button btn-warning" href="">Gözləmədə</a>
                            @elseif($permission->status == 3)
                                <a class="btn button btn-danger" href="">Ləğv Olunub</a>
                            @else
                                <a class="btn button btn-success" href="">Təsdiqlənib</a>
                            @endif
                        <td>
                        <td>
                            @if($permission->user->id == 27 || $permission->user->id == 24 || $permission->user->id == 41)
                            @if($permission->status == 0 && Auth::user()->id == 126)
                                <a class="btn btn-success"
                                    href="{{ route('change_permission', ['id' => $permission->id, 'status' => '1']) }}">Təsdiq
                                    Et</a>
                                <a class="btn btn-danger"
                                    href="{{ route('change_permission', ['id' => $permission->id, 'status' => '3']) }}">Ləğv
                                    Et</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                <!-- icazeler -->
            </tbody>
        </table>
        {{ $permissions->appends(request()->input())->links() }}
        @if (count($permissions) == 0)
            <p>Axtarışa uyğun nəticə tapılmadı</p>
        @endif
    </div>
@endsection
