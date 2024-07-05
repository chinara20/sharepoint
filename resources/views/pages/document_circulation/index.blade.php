@extends('layouts.panel')
@section('content')
    <div style="display: flex; flex-direction: column;">
        <div class="margin:0 40px;">
            <div class="info-heading">
                <h5>
                Sənədlər
                </h5>
                <p>
                    Sənədlərin siyahısını.
                </p>
            </div>
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('document_circulation.create') }}">
                 Əlavə Et
                </a>
                <form action="" method="GET">
                    <div style="display: flex; align-items: center; gap:20px" class="">
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Sənədin adı:</label>
                                <input placeholder="Daxil Edin" value="{{ request('name') }}" type="text" name="name"
                                    class="form-control" id="email">
                            </div>
                        </div>
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Müəllif:</label>
                                <select name="department_id" class="form-control select_sct">
                                    <option value="">Bütün Departamenlər</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div style="flex: 1" class="">
                            <div class="form-group">
                                <label style="font-size: 18px;" for="email">Tarix:</label>
                               <input placeholder="Daxil Edin" value="{{ request('name') }}" type="date" name="name"
                                    class="form-control" id="email">
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
            <table class="table permissionsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad</th>
                        <th>Tarix</th>
                        <th>Müəllif</th>
                        <th>Fayl</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                        <td>
                                {{ $document->id }}
                            </td>
                            <td>
                                {{ $document->name }}
                            </td>
                            <td>
                                {{ $document->created_at }} 
                            </td>
                            <td>
                                {{ $document->user->name }} 
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('document_circulation.show', $document->id) }}">Yüklə</a>
                                <a class="btn btn-info" href="/storage/{{$document->file}}">Bax</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        @if (session()->has('error'))
            <span style="width: 100%; display:block" class="alert alert-danger">
                {{ session()->get('error') }}
            </span>
        @endif
    </div>
@endsection
