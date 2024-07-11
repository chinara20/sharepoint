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
                Şöbələr
            </h5>
        </div>
        <br />
        @if(Auth::user()->id != 1)
                <a style="margin: 10px;margin-top: 40px;" class="btn btn-primary" href="{{ route('branches.create') }}">
                  YENİ  Departament
                </a>
        @endif
        <table class="table permissionsTable">
            <thead>
                <tr>
                    <th>Şöbə adı</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branch)
                <tr class="list-item">
                   
                    <td>
                        <a download target="_blank" href="{{$branch->name}}">
                            {{$branch->name}}
                        </a>
                    </td>
                    <td class="button-container">
                        <a class="btn btn-info edit-button" href="{{ route('branches.edit', $branch->id) }}">Redaktə</a>
                        
                            <form action="{{ route('branches.destroy', $branch->id) }}" method="POST">
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
