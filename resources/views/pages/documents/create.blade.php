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
      <form method="post" action="{{ route('documents.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="panel-body pn">
        <div class="section row">
            <div class="col-md-6 ph10 mb5">
                <label for="name" class="field prepend-icon">
                    <input type="text" name="name" id="name" class="gui-input form-control" placeholder="Name">
                </label>
            </div>
            <div class="col-md-6 ph10 mb5">
                <label for="src" class="field prepend-icon">
                    <input type="file" name="src" id="src" class="gui-input form-control" placeholder="File">
                </label>
            </div>
            <div class="col-md-6 ph10 mb5">
                <select name="type" id="type" class="gui-input form-control">
                    <option value="0">Unknown</option>
                    <option value="1">pdf</option>
                    <option value="2">docs</option>
                    <option value="3">xlsx</option>
                </select>
            </div>
        </div>
        <div class="section">
            <div class="pull-right">
                <button type="submit" class="btn btn-bordered btn-primary">Gönder</button>
            </div>
        </div>
    </div>
</form>

   <!-- -------------- /Panel -------------- -->
</div>
@endsection