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
            <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">

                {!! csrf_field() !!}
                <div class="panel-body pn">
                    <div class="section row">

                        <div class="col-md-12 ph10 mb5">
                            <label>Ad Soyad</label>
                            <input value="{{ request('name') }}" required="required" type="text" name="name"
                                id="name" class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Vəzifə</label>
                            <input value="{{ request('role') }}" required="required" type="text" name="role"
                                id="name" class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Nömrə</label>
                            <input value="{{ request('phone') }}" type="text" name="phone" id="name"
                                class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Email</label>
                            <input value="{{ request('email') }}" required="required" type="text" name="email"
                                id="name" class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Daxili Nömrə</label>
                            <input value="{{ request('internal_number') }}" type="text" name="internal_number"
                                id="name" class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Doğum Tarixi </label>
                            <input value="{{ request('birthday_date') }}" type="date" name="birthday_date" id="name"
                                class="gui-input">
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Rəhbər Email</label>
                            <select name="permission" class="gui-input permisson_emails">
                                <option value="">Seçin</option>
                                @foreach ($emails as $email)
                                    <option value="{{ $email }}">
                                        {{ $email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Departament</label>
                            <select name="department_id" class="gui-input">
                                <option value="">Seçin</option>
                                @foreach ($departaments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 ph10 mb5">
                            <label>Şöbə</label>
                            <select name="branch_id" class="gui-input">
                                <option value="">Seçin</option>
                                @foreach ($branchs as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" value="1" name="status">
                        <input type="hidden" value="update" name="password">

                        <div class="col-md-12 ph10 mb5">
                            <label>Foto</label>
                            <input type="file" name="img" id="name" class="gui-input">
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
