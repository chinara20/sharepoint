@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Departamen / Şöbə Yarat
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" action="{{ route('structure.store') }}" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-6 ph10 mb5">
                  <label for="firstname" class="field prepend-icon">
                  <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="Ad">
                  <label for="firstname" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="regulation" class="field prepend-icon">
                  <input type="text" name="regulation" id="regulation" class="gui-input" placeholder="Əsasnamə">
                  <label for="regulation" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="regulation" class="field prepend-icon">
                  <input type="text" name="regulation" id="regulation" class="gui-input" placeholder="Prosedur">
                  <label for="procedure" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="regulation" class="field select prepend-icon">
                  <select name="type">
                  	<option selected="selected" disabled="">Seçin</option>
                  	<option value="1">Departament</option>
                  	<option value="2">Şöbə</option>
                  </select>
                  
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