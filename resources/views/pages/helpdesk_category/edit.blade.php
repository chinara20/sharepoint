@extends('layouts.panel')
@section('content')
    <div class="allcp-form theme-primary tab-pane mw600 active" id="register" role="tabpanel">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                    Düzəliş et
                </span>
            </div>
            <!-- -------------- /Panel Heading -------------- -->
            <form method="post" action="{{ route('helpdesk-category.update', $category->id) }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body pn">
                    <div class="section row">
                        <div class="mb5">
                            <label for="file" class="field prepend-icon">
                                <input type="text" name="name" id="file" class="gui-input form-control"
                                    placeholder="Yeni şablon adı" value="{{ $category->name }}" required>
                            </label>
                        </div>

                    </div>
                    <!-- -------------- /section -------------- -->

                    <!-- -------------- /section -------------- -->
                    <div class="section">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-bordered btn-primary">Düzəlişi tamamla
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
