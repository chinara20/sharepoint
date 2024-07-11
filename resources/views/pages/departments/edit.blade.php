@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Sənəd Redaktə et
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form enctype="multipart/form-data" action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="_method" value="PATCH">
         
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-6 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input required="required" type="text" value="{{$department->name}}" name="name" id="name" class="gui-input" placeholder="Məhsulun Adı">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
              
            </div>
            
            <!-- -------------- /section -------------- -->
            <div class="section">
               <div class="pull-right">
                  <button type="submit" class="btn btn-bordered btn-primary">Redaktə et
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