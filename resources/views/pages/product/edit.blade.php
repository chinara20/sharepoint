@extends('layouts.panel')
@section('content')
<div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
   <div class="panel">
      <div class="panel-heading">
         <span class="panel-title">
         Məshul Yarat
         </span>
      </div>
      <!-- -------------- /Panel Heading -------------- -->
      <form  enctype="multipart/form-data" action="{{ route('product.update',$product->id) }}" method="POST" >
      	{!! csrf_field() !!}
    <input type="hidden" name="_method" value="PATCH">
         
         <div class="panel-body pn">
            <div class="section row">
               <div class="col-md-6 ph10 mb5">
                  <label for="name" class="field prepend-icon">
                  <input required="required" type="text" value="{{$product->name}}" name="name" id="name" class="gui-input" placeholder="Məhsulun Adı">
                  <label for="name" class="field-icon">
                  <i class="fa fa-user"></i>
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <div class="col-md-6 ph10 mb5">
                  <label for="email" class="field prepend-icon">
                 <select name="category_id" class="form-control">
                  @foreach($categories as $category)
                    <option @if($category->id == $product->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                 </select>
                  
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
               <!-- -------------- /section -------------- -->
               <div class="col-md-12 ph10 mb5">
                  <label for="surname" class="field prepend-icon">
                  <textarea required="required" placeholder="Açıqlama" name="text" style="height: 200px;" class="gui-input">{{$product->text}}</textarea>
                  <label for="surname" class="field-icon">
                  </label>
                  </label>
               </div>
               <!-- -------------- /section -------------- -->
                
               <!-- -------------- /section -------------- -->
               <div class="col-md-12 ph10 mb5">
                  <label for="img" class="field prepend-icon">
                  <input required="required" type="file" name="img" id="img" class="gui-input" placeholder="img">
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