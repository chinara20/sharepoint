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
                    Müraciət formu
                </span>
                <p>Direktora (Anar Şıxəliyev) ünvanlamaq istədiyiniz müraciəti qeyd edin.</p>
            </div>
            <br>
            <form action="{{ route('appeals.store') }}" method="POST">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="exampleInputPassword1">Mövzu</label>
                    <input type="text" name="title" class="form-control"
                        placeholder="Mövzu" value="{{ request('title') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Mətn</label>
                    <textarea name="content" id="" cols="30" rows="3" required
                        placeholder="Müraciət mətni." class="form-control">{{ request('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">MÜRACİƏT ET</button>
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

    <script>
        let fileInput = document.querySelector('.file-input > label > span');
        document.getElementById('fileInput').onchange = function() {
            fileInput.className = "text-primary";
            fileInput.innerHTML = "<strong>" + this.value + "</strong>";
            // document.querySelector('.file-input').append(div)
        };
    </script>

@endsection
