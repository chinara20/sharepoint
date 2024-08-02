@extends('layouts.panel')
@section('content')

    @if (!empty($news))
        <div class="pl15 pr50">
            <h4> {{ $news['title'] }} </h4>
            <img style="width: 500px;height:450px;object-fit:cover;" src="{{ $news['thumbnail'] }}">
            <hr class="alt short">
            <p class="text-muted"> {!! $news['text'] !!}</p>
        </div>
    @endif
@endsection
