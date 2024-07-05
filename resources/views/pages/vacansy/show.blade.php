@extends('layouts.panel')
@section('content')
    <div class="pl15 pr50">
        <h4 class="text-center"> {{ $vacansy->title }} </h4>
        <img style="width: 500px;  display: block;
  margin-left: auto;
  margin-right: auto;" src="/vakansiya.png">
        <hr class="alt short">
        <p class="text-muted"> {!! $vacansy->text !!}</p>
    </div>
@endsection
