@extends('layouts.panel')
@section('content')
<style type="text/css">
  .card-container{
  /*  display: flex;
    flex-wrap: wrap;
    margin:1.25rem;
    padding:0.3125rem;*/
    /*border:2px solid #FFFFFF;*/
      display: grid;
  grid-template-columns: 24% 24% 24% 24%;
  grid-gap: 10px;
}
.card{
/*    flex:1 0 12.5rem;
    margin:0.625rem;*/
    /*border:2px solid #FFFFFF;*/
}
.card-image{
/*    display:block;
    height:21.875rem;
    background-size:cover;
    box-shadow:0.3rem 0.4rem 0.4rem rgba(0, 0, 0, 0.4);
    transition:transform 500ms ease-in;*/
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
        <div class="card-container">
            <!--Card 1-->
            @foreach($products as $products)
            <div class="card">
                <div style="background-image:url('/storage/{{$products->img}}');background-size:cover!important;height: 350px;" class="card-image card-1"></div>
                <h3>{{$products->name}}</h3>
            </div>
            @endforeach
            
        </div>
    </div>
    
   </div>
@endsection