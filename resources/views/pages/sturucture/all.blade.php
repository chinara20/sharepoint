@extends('layouts.panel')
@section('content')
    @php
        function isMobile()
        {
            return preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $_SERVER['HTTP_USER_AGENT']);
        }
    @endphp
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <style type="text/css">
        .text-purple-600 {
            color: black !important;
            height: 40px;
        }
    </style>
    <!-- <style type="text/tailwindcss">
                                                                                                                                                       @layer components {
                                                                                                                                                       .card {
                                                                                                                                                       @apply flex items-center justify-center flex-col gap-2 p-5 w-full sm:w-72 h-full bg-gray-100 border rounded-2xl
                                                                                                                                                       }
                                                                                                                                                       }
                                                                                                                                                    </style> -->
    <style type="text/css">
        /*.card {
                                                                                                                                                       float: right;
                                                                                                                                                      display: flex;
                                                                                                                                                      height: 100%;
                                                                                                                                                      width: 100%;
                                                                                                                                                      flex-direction: column;
                                                                                                                                                      align-items: center;
                                                                                                                                                      justify-content: center;
                                                                                                                                                      gap: 0.5rem;
                                                                                                                                                      border-radius: 1rem;
                                                                                                                                                      border-width: 1px;
                                                                                                                                                      --tw-bg-opacity: 1;
                                                                                                                                                      background-color: rgb(243 244 246 / var(--tw-bg-opacity));
                                                                                                                                                      padding: 1.25rem;
                                                                                                                                                    }*/

        /* __play_start_utilities__ */

        /*@media (min-width: 640px) {
                                                                                                                                                      .card {
                                                                                                                                                        width: 18rem;
                                                                                                                                                      }
                                                                                                                                                    }*/
        .card {
            background-color: #fffefe;
            margin: 5px;
            border: 4px;
            padding: 5px;
        }
    </style>
    <div class="container mx-auto py-8" style="width: 100%!important">
        <div class="flex flex-col text-center gap-4 mb-8 p-4">
            <!-- <div><h1>Struktur</h1></div> -->
            <h1 style="font-size: 38px;" class="text-purple-600  font-bold">Struktur</h1>
            @if (Auth::user()->department_id == 10 || Auth::user()->email == 'nicat.b@nbatech.az' || Auth::user()->email == 'rauf.a@nbatech.az')
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('users.create') }}">Əlavə
                    ET</a>
            @endif
            <div style="padding-top: 10px;" class="text-gray-900 text-3xl md:text-4xl font-bold">
                <form action="" method="GET">
                    <div style="display: flex; align-items: center; gap:20px" class="">
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Ad Soyad:</label>
                                <input placeholder="Daxil Edin" value="{{ request('name') }}" type="text" name="name"
                                    class="form-control" id="email">
                            </div>
                        </div>
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Departament:</label>
                                <select name="department_id" class="form-control select_sct">
                                    <option value="">Bütün Departamenlər</option>
                                    @foreach ($departments as $department)
                                        <option @if ($department->id == request('department_id')) selected @endif
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Şöbə:</label>
                                <select name="branch_id" class="form-control select_sct">
                                    <option value="">Bütün şöbələr</option>
                                    @foreach ($branches as $department)
                                        <option @if ($department->id == request('branch_id')) selected @endif
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email"> </label>
                                <button style="display: block!important" type="submit"
                                    class="btn btn-primary">Axtar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- <div class="text-gray-600 md:text-lg">burada nese soz yaza bilerik</div> -->
            </div>
            <div style="display: grid;
@if (isMobile()) grid-template-columns:200px 200px; @else grid-template-columns: 20% 20% 20% 20% 20%; @endif
"
                class="">
                @foreach ($users as $user)
                @if($user->id != 136)
                    <div style="" class="card">
                        <a href="#" style="color:unset;">
                            @if ($user->img)
                                <img style="height: 140px;" src="/storage/{{ $user->img }}"
                                    class="w-24 h-24 rounded-full object-cover transition duration-200 hover:scale-110">
                            @else
                                <i style="color: #54b8be;" class="fa fa-4x fa-user" aria-hidden="true"></i>
                            @endif
                            <div style="font-size: 16px;  font-family: '-apple-system';"
                                class="text-gray-900 text-lg font-bold">{{ $user->name }}</div>
                            <div class="text-purple-600">
                                @if ($user->show_department and $user->department_id != 5)
                                    {{ $user->show_department->name }}
                                @elseif($user->show_branch)
                                    {{ $user->show_branch->name }}
                                @endif
                            </div>
                            <div class="text-gray-600"> {{ $user->internal_number }}</div>
                            <div class="text-gray-600">{{ $user->email }}</div>
                            @if (Auth::user()->email == 'nail.c@nbatech.az' ||
                                    Auth::user()->email == 'farid.k@nbatech.az' ||
                                    Auth::user()->email == 'rasima.a@nbatech.az' ||
                                    Auth::user()->email == 'nicat.b@nbatech.az' ||
                                    Auth::user()->department_id == 10)
                                <a href="{{ route('users.edit', $user->id) }}">Dəyiş</a>
                            @endif
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endsection
