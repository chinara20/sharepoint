@extends('layouts.panel')
@section('content')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Struktur
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form method="POST" enctype="multipart/form-data" action="{{ route('users.update',$user->id) }}"  >

      	{!! csrf_field() !!}
    <input type="hidden" name="_method" value="PATCH">
         


         <div class="panel-body pn">
            <div class="section row">

            	<div class="col-md-12 ph10 mb5">
                <label>Ad Soyad</label>
                  <input value="{{$user->name}}" required="required" type="text" name="name" id="name" class="gui-input">
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Vəzifə</label>
                  <input value="{{$user->role}}" required="required" type="text" name="role" id="name" class="gui-input">
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Nömrə</label>
                  <input value="{{$user->phone}}"  type="text" name="phone" id="name" class="gui-input">
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Email</label>
                  <input value="{{$user->email}}" required="required" type="text" name="email" id="name" class="gui-input">
               </div>
                <div class="col-md-12 ph10 mb5">
                <label>Daxili Nömrə</label>
                  <input value="{{$user->internal_number}}"  type="text" name="internal_number" id="name" class="gui-input">
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Doğum Tarixi </label>
                  <input value="{{$user->birthday_date}}"  type="date" name="birthday_date" id="name" class="gui-input">
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Rəhbər Email</label>
                <select name="permission" class="gui-input permisson_emails">
                  <option value="">Seçin</option>
                  @foreach($emails as $email)
                  <option @if($email == $user->permission) selected @endif value="{{$email}}">{{$email}}</option>
                  @endforeach
                </select>
               </div>
                <div class="col-md-12 ph10 mb5">
                <label>Departament</label>
                <select name="department_id" class="gui-input">
                	<option value="">Seçin</option>
                	@foreach($departaments as $department)
                	<option @if($department->id == $user->department_id) selected @endif value="{{$department->id}}">{{$department->name}}</option>
                	@endforeach
                </select>
               </div>
               <div class="col-md-12 ph10 mb5">
                <label>Şöbə</label>
                <select name="branch_id" class="gui-input">
                	<option value="">Seçin</option>
                	@foreach($branchs as $branch)
                	<option @if($branch->id == $user->branch_id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                	@endforeach
                </select>
               </div>

               <div class="col-md-12 ph10 mb5">
                <label>Status</label>
                <select name="status" class="gui-input">
                  <option @if($user->status == 1) selected @endif value="1">Aktiv</option>
                  <option @if($user->status == 0) selected @endif value="0">Deaktiv</option>
                </select>
               </div>
               

             <div class="form-group">
                        <label for="accept_date">İşə Qəbul Tarixi</label>
                        <input type="date" name="accept_date" id="accept_date" class="form-control" value="{{ $user->accept_date ? $user->accept_date->format('Y-m-d') : '' }}">
             </div>


               <div class="col-md-12 ph10 mb5">
                <label>Foto</label>
                  <input  type="file" name="img" id="name" class="gui-input">
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