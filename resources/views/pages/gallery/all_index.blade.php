@extends('layouts.panel')
@section('content')
<!-- <style type="text/css">
   .section {
   padding: 30px 0;
   color: #333;
   }
   .section .top-side {
   text-align: center;
   }
   .section .top-side .title {
   font-weight: 500;
   font-size: 15px;
   display: inline-block;
   }
   .section .top-side .title:after {
   content: "";
   display: block;
   width: 50%;
   border-bottom: 1px solid #494949;
   margin: 8px auto;
   }
   .section .top-side h2 {
   font-weight: 700;
   }
   .section.portfolio .filters {
   text-align: center;
   margin-top: 50px;
   }
   .section.portfolio .filters ul {
   padding: 0;
   }
   .section.portfolio .filters ul li {
   list-style: none;
   display: inline-block;
   padding: 20px 30px;
   cursor: pointer;
   position: relative;
   }
   .section.portfolio .filters ul li:after {
   content: "";
   display: block;
   width: calc(0% - 60px);
   position: absolute;
   height: 2px;
   background: #333;
   transition: width 350ms ease-out;
   }
   .section.portfolio .filters ul li:hover:after {
   width: calc(100% - 60px);
   transition: width 350ms ease-out;
   }
   .section.portfolio .filters ul li.active:after {
   width: calc(100% - 60px);
   }
   .section.portfolio .filters-content {
   margin-top: 50px;
   }
   .section.portfolio .filters-content .show {
   opacity: 1;
   visibility: visible;
   transition: all 350ms;
   }
   .section.portfolio .filters-content .hide {
   opacity: 0;
   visibility: hidden;
   transition: all 350ms;
   }
   .section.portfolio .filters-content .item {
   text-align: center;
   cursor: pointer;
   margin-bottom: 30px;
   }
   .section.portfolio .filters-content .item .p-inner {
   padding: 20px 30px;
   box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
   }
   .section.portfolio .filters-content .item .p-inner h5 {
   font-size: 15px;
   }
   .section.portfolio .filters-content .item .p-inner .cat {
   font-size: 13px;
   }
   .section.portfolio .filters-content .item img {
   width: 100%;
   }
</style> -->
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
    filter:grayscale(100%);
    /*border:2px solid #FFFFFF;*/
}
.card-image:hover{
    transform:scale(1.10);
    filter:grayscale(0%);
}
.card-image.card-1{
    background-image:url(https://images.unsplash.com/photo-1661586762551-b595e65388ba?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1285&q=80);
}
.card-image.card-2{
    background-image:url(https://images.unsplash.com/photo-1668115118877-ca2946340036?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=327&q=80);
}
.card-image.card-3{
    background-image:url(https://images.unsplash.com/photo-1564678164-f00ad53a38e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80);
}
.card-image.card-4{
    background-image:url(https://images.unsplash.com/photo-1658501656233-6e2c44834760?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1287&q=80);
}
.card-image.card-5{
    background-image:url(https://images.unsplash.com/photo-1536266305399-b367feb671f9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80);
}
.card-image.card-6{
    background-image:url(https://images.unsplash.com/photo-1570299135572-3a10aa26de2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=463&q=80);
}


</style>
<!-- -------------- Main Wrapper -------------- -->
<div id="container">
        <div class="card-container">
            <!--Card 1-->
            <div class="card">
                <div class="card-image card-1"></div>
            </div>
            <!--Card 2-->
            <div class="card">
                <div class="card-image card-2"></div>
            </div>
            <!--Card 3-->
            <div class="card">
                <div class="card-image card-3"></div>
            </div>
            <!--Card 4-->
            <div class="card">
                <div class="card-image card-4"></div>
            </div>
            <!--Card 5-->
            <div class="card">
                <div class="card-image card-5"></div>
            </div>
            <!--Card 6-->
            <div class="card">
                <div class="card-image card-6"></div>
            </div>
        </div>
    </div>
@endsection