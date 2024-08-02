@extends('layouts.panel')
@section('content')
<style type="text/css">
  .card-container{
    display: flex;
    flex-wrap: wrap;
    margin:1.25rem;
    padding:0.3125rem;
    /*border:2px solid #FFFFFF;*/
}
.card{
    flex:1 0 12.5rem;
    margin:0.625rem;
    /*border:2px solid #FFFFFF;*/
}
.card-image{
    display:block;
    height:21.875rem;
    background-size:cover;
    box-shadow:0.3rem 0.4rem 0.4rem rgba(0, 0, 0, 0.4);
    transition:transform 500ms ease-in;
    /*filter:grayscale(100%);*/
    /*border:2px solid #FFFFFF;*/
}
.card-image:hover{
    transform:scale(1.10);
    filter:grayscale(0%);
}



</style>
<!-- -------------- Main Wrapper -------------- -->
<div id="container">
    
    <div class="row">
      @foreach($product_categories as $category)
      <div   onclick="location.href = '/product_category/{{$category->id}}';" class="col-sm-6 col-xl-4 ">
        <div style="height:80vh; background-repeat:no-repeat;background-image: url('/storage/{{$category->img}}');cursor: pointer;background-size: cover;"></div>
         <!-- <div class="panel panel-tile">
            <div class="panel-body">
               <div  class="row pv10">
                  <div class="col-xs-12 pl5">
                     <h2 class="text-center">{{$category->name}}</h2>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      @endforeach
   </div>
@endsection