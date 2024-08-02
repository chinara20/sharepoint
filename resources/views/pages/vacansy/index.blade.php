@extends('layouts.panel')
@section('content')
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            /*background-color: #2196F3;*/
            padding: 10px;
        }

        .grid-item {
            /*  background-color: rgba(255, 255, 255, 0.8);
                                                              border: 1px solid rgba(0, 0, 0, 0.8);*/
            padding: 20px;
            /*  font-size: 30px;
                                                              text-align: center;*/
        }
    </style>
    <div class="py-5">
        <div class="container-fluid">
            @if (Auth::user()->department_id == 10)
                <a class="btn btn-primary" href="{{ route('vacansy.create') }}">Əlavə Et</a>
            @endif
            <div class="grid-container  hidden-md-up">
                <div class="row ">
                    @if (count($vacansies) == 0)
                        <h1 class="text-center">Hazırda aktiv vakansiyamız yoxdur</h1>
                    @endif
                    @foreach ($vacansies as $vacansy)
                        <a href="{{ route('vacansy.show', $vacansy->id) }}">
                            <div class="col-lg-4 col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ $vacansy->title }}</h3>
                                    </div>
                                    <div class="panel-body"><img style="width: 100%;margin-bottom:20px;"
                                            src="/vakansiya.png">
                                        <div
                                            style="   overflow: hidden;
                                      display: -webkit-box;
                                      -webkit-line-clamp: 5; /* number of lines to show */
                                              line-clamp: 5; 
                                      -webkit-box-orient: vertical;color:rgba(0,0,0,.5)">
                                            {!! $vacansy->text !!}
                                        </div>
                                        <br>
                                        @if(Auth::user()->department_id == 10 || Auth::user()->email == 'rauf.a@nbatech.az')
                                        <form action="{{ route('vacansy.destroy', $vacansy->id) }}" method="post">
                                            <a class="btn btn-primary"
                                                href="{{ route('vacansy.edit', $vacansy->id) }}">Dəyiş</a>
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                            <button type="submit" class="btn btn-danger">Sil</button>
                                        </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
