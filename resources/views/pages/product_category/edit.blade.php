@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Məhsul Kateqoriyası
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form  enctype="multipart/form-data" action="{{ route('product_category.update',$product_category->id) }}" method="POST" >

      	{!! csrf_field() !!}
    <input type="hidden" name="_method" value="PATCH">
         


         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-12 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="text" value="{{$product_category->name}}" name="name" id="name" class="gui-input" placeholder="Kateqoriya adı">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
                <div class="col-md-12 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="file" name="img" id="name" class="gui-input">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
              


            </div>
            <!-- -------------- /section -------------- -->
            
            <!-- -------------- /section -------------- -->
            <div class="section">
               <div class="pull-right">
                  <button type="submit" class="btn btn-bordered btn-primary">Göndər
                  </button>
               </div>
            </div>
            <!-- -------------- /section -------------- -->
         </div>
         <!-- -------------- /Form -------------- -->
         <div class="panel-footer"></div>
      </form>
   </div>
   <!-- -------------- /Panel -------------- -->
</div>
@endsection