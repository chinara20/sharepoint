@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Vakansiya 
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" action="{{ route('vacansy.store') }}" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-12 ph10 mb5">
                  <label for="title" class="field prepend-icon">
                  <input type="text" name="title" value="{{ $vacansy->title }}" id="title" class="gui-input" placeholder="Başlıq">
                  <label for="title" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               
                <!-- -------------- /section -------------- -->
               <div class="col-md-12 ph10 mb5">
                  <label for="text" class="field prepend-icon">
                  <!-- editor -->
                   <textarea class="editor" name="text">{{ $vacansy->text }}</textarea>
                  <!-- editor end -->
                  <!-- <label for="text" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label> -->
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