@extends('layouts.panel')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                @if (request('permission_type') == 1)
                    <th>Ad / Soyad</th>
                @endif
                <th>İcazə Səbəbi</th>
                <th>Başlama Tarixi</th>
                <th>Bitmə Tarixi</th>
                <th>Növ</th>
                <th>Status</th>
                @if (request('permission_type') == 1)
                    <th>Funksiya</th>
                @endif
            </tr>
        </thead>
        @if (count($permissions_access) > 0)
            <div style="width: 200px;display: inline-block;">
                <form action="" method="GET">
                    <select onchange="this.form.submit()" name="permission_type" class="form-control">
                        <option @if (request('permission_type') == 2) selected="" @endif value="2">İcazələr</option>
                        <option @if (request('permission_type') == 1) selected="" @endif value="1">Sorğular</option>
                    </select>
                    <!-- <button type="submit">Axtar</button> -->
                </form>
            </div>
        @endif
        <!-- <a href="{{ route('permission.create') }}">Əlavə ET</a> -->
        <a href=""></a>
        <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('permission.create') }}">Əlavə
            ET</a>
        <tbody>
            @if (request('permission_type') != 2)
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        @if (request('permission_type') == 1)
                            <th>{{ $permission->user->name }}</th>
                        @endif
                        <td>{{ $permission->subject }}</td>
                        <td>{{ $permission->time_start }}</td>
                        <td>{{ $permission->time_end }}</td>
                        <td>Ödənişli</td>
                        <td>
                            @if ($permission->status == 0)
                                <a class="btn button btn-warning" href="">Gözləmədə</a>
                            @elseif($permission->status == 3)
                                <a class="btn button btn-danger" href="">Ləğv Olunub</a>
                            @else
                                <a class="btn button btn-success" href="">Təsdiqlənib</a>
                            @endif


                    </tr>
                @endforeach
            @endif
            <!-- icazeler -->
            @if (request('permission_type') == 1)
                @foreach ($permissions_access as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        @if (request('permission_type') == 1)
                            <th>{{ $permission->user->name }}</th>
                        @endif
                        <td>{{ $permission->subject }}</td>
                        <td>{{ $permission->time_start }}</td>
                        <td>{{ $permission->time_end }}</td>
                        <td>Ödənişli</td>
                        <td>
                            @if ($permission->status == 0)
                                <a class="btn button btn-warning" href="">Gözləmədə</a>
                            @elseif($permission->status == 3)
                                <a class="btn button btn-danger" href="">Ləğv Olunub</a>
                            @else
                                <a class="btn button btn-success" href="">Təsdiqlənib</a>
                            @endif
                            @if (request('permission_type') == 1)
                        <td>

                            @if ($permission->status != 1 && $permission->status != 3)
                                <a class="btn btn-success"
                                    href="{{ route('change_permission', ['id' => $permission->id, 'status' => '1']) }}">Təsdiq
                                    Et</a>
                                <a class="btn btn-danger"
                                    href="{{ route('change_permission', ['id' => $permission->id, 'status' => '3']) }}">Ləğv
                                    Et</a>
                            @endif




                        </td>
                @endif
                </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
@endsection
