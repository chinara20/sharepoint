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
      <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data" method="POST" >
      	{!! csrf_field() !!}
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-6 ph10 mb5">
                  <label for="title" class="field prepend-icon">
                  <select name="category_id" class="form-control">
                     @foreach($gallery_categories as $category)
                     <option value="{{$category->id}}">{{$category->name}}</option>
                     @endforeach
                  </select>
                  
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="file" class="field prepend-icon">
                  <input type="file" name="name" id="file" class="gui-input form-control" placeholder="file">
                 
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