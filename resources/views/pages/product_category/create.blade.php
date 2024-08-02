@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Məhsul Kateqoriyası Yarat
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" enctype="multipart/form-data" action="{{ route('product_category.store') }}" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-12 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="text" name="name" id="name" class="gui-input" placeholder="Kateqoriya adı">
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