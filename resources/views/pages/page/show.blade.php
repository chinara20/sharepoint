@extends('layouts.panel')
@section('content')
<style type="text/css">
	.image > img{
		width: 100%;
	}
	.full-data{
		display: block!important;
	}
</style>
@foreach($pages as $page)
<div id="{{$page->title}}" class="full-data">
{!!$page->text!!}
</div>
@endforeach
@endsection