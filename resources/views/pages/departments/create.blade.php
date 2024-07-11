@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Səhifə
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" action="{{ route('departments.store') }}" enctype="multipart/form-data" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
            <div class="col-md-6 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="name" name="name" id="name" class="gui-input form-control" placeholder="name">
                 
                  </label>
               </div>
               
            </div>
            <!-- -------------- /section -------------- -->
            
            <!-- -------------- /section -------------- -->
            <div class="section">
               <div class="pull-right">
                  <button type="submit" class="btn btn-bordered btn-primary">Yarat
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