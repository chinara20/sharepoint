@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Layihənizi bizə təqdim edin.
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" action="{{ route('talant.store') }}" enctype="multipart/form-data" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-12 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="text" name="title" id="name" class="gui-input" placeholder="Proyektın Adı">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
              
               <!-- -------------- /section -------------- -->
               <div class="col-md-12 ph10 mb5">
                  <label for="surname" class="field prepend-icon">
                  <textarea class="form-control" placeholder="Qısa Məlumat" name="description" style="height: 200px;" class="gui-input"></textarea>
                  <label for="surname" class="field-icon">
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                
               <!-- -------------- /section -------------- -->
               <div class="col-md-12 ph10 mb5">
                  <label for="img" class="field prepend-icon">
                  <input type="file" name="file" id="img" class="gui-input" placeholder="img">
                  <label for="procedure" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               


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