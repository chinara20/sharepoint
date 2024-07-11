@extends('layouts.panel')
@section('content')
<style>
    .list-item:hover{
        background-color:#fef9c3;
        cursor:pointer;
        text-decoration:underline;
    }
    .list-item a{
        color:#000;
    }
</style>
    <div>
        <div class="info-heading">
            <h5>
                Departament
            </h5>
        </div>
        <br />
        @if(Auth::user()->id != 1)
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('departments.create') }}">
                  YENİ  Departament
                </a>
            @endif
        <table class="table permissionsTable">
            <thead>
                <tr>
                    <th>Departament adı</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr class="list-item">
                   
                    <td>
                        <a download target="_blank" href="{{$department->name}}">
                            {{$department->name}}
                        </a>
                    </td>
                    <td class="button-container">
                        <a class="btn btn-info edit-button" href="{{ route('departments.edit', $department->id) }}">Redaktə</a>
                        
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sil</button>
                            </form>
                        </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
