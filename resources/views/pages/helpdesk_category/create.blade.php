@extends('layouts.panel')
@section('content')
    <div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    Yeni şablon
                </span>
            </div>
            <!-- -------------- /Panel Heading -------------- -->
            <form method="post" action="{{ route('helpdesk-category.store') }}" method="POST">
                {!! csrf_field() !!}
                <div class="panel-body pn">
                    <div class="section row">
                        <div class="mb5">
                            <label for="file" class="field prepend-icon">
                                <input type="text" name="name" id="file" class="gui-input form-control"
                                    placeholder="Yeni şablon adı" required>
                            </label>
                        </div>

                    </div>
                    <!-- -------------- /section -------------- -->

                    <!-- -------------- /section -------------- -->
                    <div class="section">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-bordered btn-primary">Əlavə et
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
