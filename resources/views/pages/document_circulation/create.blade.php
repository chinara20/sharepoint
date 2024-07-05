@extends('layouts.panel')
@section('content')
    <style type="text/css">
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        input[type="month"] {
            line-height: 1.49;
        }

        .hide {
            display: none;
        }

        .file-input {}

        .file-input label {
            cursor: pointer;
            text-align: center;
            width: 100%;
            padding: 40px 0;
            border-radius: 10px;
            border: 2px dashed #ccc;
            background-color: #fff;
        }


        .select-with-chevron {
            position: relative;
            display: flex;
            align-items: center;
        }

        .select-with-chevron .fa-chevron-down {
            position: absolute;
            right: 16px;
        }
    </style>


    <div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title" style="color:rgba(0,0,0,.7);">
                    Sənəd Əlavə Et
                </span>
            </div>
            <br>
            <form enctype="multipart/form-data" action="{{ route('document_circulation.store') }}" method="POST">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="exampleInputPassword1">Ad</label>
                    <input type="text" name="name" class="form-control"
                        placeholder="Ad" value="{{ request('name') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Sənəd</label>
                    <input type="file" name="file" class="form-control" placeholder="Ad">
                </div>

                

                <button type="submit" class="btn btn-primary">Göndər</button>
            </form>

            <!-- -------------- /Panel Heading -------------- -->

        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <span style="width: 100%; display:block" class="alert alert-danger">
                        {{ $error }}
                    </span>
                @endforeach
            </div>
        @endif
        <!-- -------------- /Panel -------------- -->
    </div>

    

@endsection
