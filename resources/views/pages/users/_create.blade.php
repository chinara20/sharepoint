@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         İstifadəçi Yarat
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="post" action="{{ route('users.store') }}" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-6 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input type="text" name="name" id="name" class="gui-input" placeholder="Ad">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="surname" class="field prepend-icon">
                  <input type="text" name="surname" id="surname" class="gui-input" placeholder="Soyad">
                  <label for="surname" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="email" class="field prepend-icon">
                  <input type="text" name="email" id="email" class="gui-input" placeholder="Email">
                  <label for="procedure" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="password" class="field prepend-icon">
                  <input type="password" name="password" id="password" class="gui-input" placeholder="Password">
                  <label for="procedure" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="password" class="field prepend-icon">
                  <input type="text" name="internal_number" id="password" class="gui-input" placeholder="Daxili Nomre">
                  <label for="procedure" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="password" class="field prepend-icon">
                  <input type="date" name="password" id="password" class="gui-input" placeholder="Tarix">
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
                  	<option selected="selected" disabled="">Struktur</option>
                  	@foreach($structures as $structure)
                  	<option value="{{ $structure->id }}">{{ $structure->name }}</option>
                  	@endforeach
                  </select>
                  
                  </label>
               </div>
               <!-- -------------- /section -------------- -->


                <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="regulation" class="field select prepend-icon">
                  <select name="type">
                     <option selected="selected" disabled="">Vəzifə</option>
                     <option>Kiçik Mütəxəssis</option>
                     <option>Mütəxəssis</option>
                     <option>Baş Mütəxəssis</option>
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