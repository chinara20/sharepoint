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
    <a class="btn btn-primary" href="{{route('product.create')}}">Əlavə Et</a>
    <br>
    

    @if(app('request')->input('view'))
        <div class="card-container">
            <!--Card 1-->
            @foreach($products as $products)
            <div class="card">
                <div style="background-image:url('/storage/{{$products->img}}');" class="card-image card-1"></div>
                <h3>{{$products->name}}</h3>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="row">
      <div style="height:570px; background-repeat:no-repeat;background-image: url('/products/1.png');"  onclick="location.href = '/product?view=1';" class="col-sm-6 col-xl-4 card-image">
         <!-- <div class="panel panel-tile">
            <div class="panel-body">
               <div  class="row pv10">
                  <div class="col-xs-12 pl5">
                     <h2 class="text-center">Qala altı</h2>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      <div style="height:570px; background-repeat:no-repeat;background-image: url('/products/2.png');" onclick="location.href = '/product?view=1';" class="col-sm-6 col-xl-4 card-image">
         <!-- <div class="panel panel-tile">
            <div class="panel-body">
               <div  class="row pv10">
                  <div class="col-xs-12 pl5">
                     <h2 class="text-center">Yeni İl</h2>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      <div style="height:570px; background-repeat:no-repeat;background-image: url('/products/3.png');" onclick="location.href = '/product?view=1';" class="col-sm-6 col-xl-4 card-image">
         <!-- <div class="panel panel-tile">
            <div class="panel-body">
               <div  class="row pv10">
                  <div class="col-xs-12 pl5">
                     <h2 class="text-center">Futbol</h2>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      
      @endif
   </div>
@endsection