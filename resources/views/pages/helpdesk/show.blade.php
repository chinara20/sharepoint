@extends('layouts.panel')
@section('content')

    <style>
        .forwarded_alert {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin: 20px auto;
        }

        .forwarded_alert .forward_details {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .forwarded_alert .forward_details i {
            font-size: 24px
        }

        .forwarded_alert p {
            font-size: 20px;
            font-weight: bold;
        }

        .forwarded_alert .forward_details .user_info {
            display: flex;
            flex-direction: column;
            align-items: center
        }

        .forwarded_alert .forward_details .user_info img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <div class="helpdesk">
        <div class="info">
            <div>
                <span>Sorğu :</span>
                <strong>{{ $desk->subject->name }}</strong>
            </div>
            <div>
                <span>Başlıq :</span>
                <strong>{{ $desk->title }}</strong>
            </div>
            <div>
                <span>Yaradıldı : </span>
                <strong>{{ $desk->created_at->format('d.m.Y H:i') }}</strong>
            </div>
            <div>
                <span>Status :</span>
                <strong class="text-{{ $desk->get_status()['class'] }}">{!! $desk->get_status()['text'] !!}</strong>
            </div>

            @if ($desk->responder)
                <div>
                    <span>Əlaqədar əməkdaş : </span>
                    <strong>{{ $desk->responder->user->name }}</strong>
                </div>
            @endif

            <br>

            <div class="actions">
                @if (
                    $desk->responder &&
                        ($desk->responder->user->id == Auth::user()->id || (Auth::user()->id == 9 || Auth::user()->id == 140)) &&
                        ($desk->status === 'activ' || $desk->status === 'forwarded'))
                    <form action="{{ route('helpdesk.update', $desk->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">
                        <input type="hidden" name="action" value="success">
                        <input type="hidden" name="status" value="success">
                        <button type="submit" class="btn btn-success">Həll olundu <i class="fa fa-check"
                                aria-hidden="true"></i></button>
                    </form>

                    <form action="{{ route('helpdesk.update', $desk->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">
                        <input type="hidden" name="action" value="unsuccess">
                        <input type="hidden" name="status" value="unsuccess">
                        <button type="submit" class="btn btn-danger">Həll olunmadı <i class="fa fa-times"
                                aria-hidden="true"></i></button>
                    </form>
                @endif

                @if (
                    $desk->status === 'activ' ||
                        $desk->status === 'forwarded' ||
                        (($desk->status === 'pending' || $desk->status === 'forwarded') && $desk->user_id === Auth::user()->id))
                    <a href="#create-message" class="btn btn-primary">Mesaj yaz</a>
                @endif

                @if ($desk->user_id === Auth::user()->id && ($desk->status == 'success' || $desk->status == 'unsuccess'))
                    <form action="{{ route('helpdesk.update', $desk->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">
                        <input type="hidden" name="action" value="activ">
                        <input type="hidden" name="status" value="activ">
                        <button type="submit" class="btn btn-info">Sorğunu bərpa et <i class="fa fa-refresh"
                                aria-hidden="true"></i></button>
                    </form>
                @endif

                @if ($desk->status === 'pending' && $desk->user_id != Auth::user()->id)
                    <form action="{{ route('helpdesk.update', $desk->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">
                        <input type="hidden" name="action" value="start">
                        <input type="hidden" name="status" value="activ">
                        <button type="submit" class="btn btn-warning">Problemin həllinə başla</button>
                    </form>
                @endif
            </div>
            @if (
                $desk->responder &&
                    $desk->responder->user->id == Auth::user()->id &&
                    ($desk->status === 'activ' || $desk->status === 'forwarded'))
                @if ($department_users)
                    <form style="display: flex; align-items: center; margin-top:20px; gap:8px ;"
                        action="{{ route('helpdesk.update', $desk->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">

                        <select id='myselect' name="department_user_id">
                            <option value=" " selected>Hamısı</option>
                            @foreach ($department_users as $user)
                                <option value="{{ $user->id }}" @if (request('user_id') == $user->id) selected @endif>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" name="action" value="forward">
                        <input type="hidden" name="status" value="forwarded">
                        <button type="submit" class="btn btn-warning">Yönləndir</button>
                    </form>


                    <script>
                        $('#myselect').select2({
                            width: '101%',
                            height: '35px',
                            placeholder: "Siyahıdan seçin",
                            allowClear: true
                        });
                    </script>
                @endif
            @endif

        </div>

        <div>
            @foreach ($desk->messages->reverse() as $message)
                @if ($message->forwarded_from && !$message->message)
                    <div class="forwarded_alert">
                        <div class="forward_details">
                            <div class="user_info">
                                <img src="/storage/{{ $message->forwarded_user->img }}" alt="">
                                <span>{{ $message->forwarded_user->name }}</span>
                            </div>
                            <i class="fa-solid fa-arrow-right"></i>
                            <div class="user_info">
                                <img src="/storage/{{ $message->user->img }}" alt="">
                                <span>{{ $message->user->name }}</span>
                            </div>
                        </div>
                        <p>Sorğu yönləndirildi.</p>
                    </div>
                @else
                    <div class="message {{ $message->user_id === $desk->user_id ? 'owner' : 'responder' }}">
                        <div class="message_header">
                            <div class="left">
                                <div class="avatar">
                                    <img src="/storage/{{ $message->user->img }}" alt="">
                                </div>
                                <div>
                                    <span>{{ $message->user->name }}</span>
                                    <span>{{ $message->user_id === $desk->user_id ? 'Sorğu sahibi' : $message->user->show_department->name }}</span>
                                </div>
                            </div>
                            <div class="right">
                                <span>{{ $message->created_at->format('d.m.Y (H:i)') }}</span>
                            </div>
                        </div>
                        <div class="content">
                            {{ $message->message }}
                        </div>
                        @if ($message->image)
                            <a href="/storage/{{ $message->image }}" download><i class="fa fa-paperclip"
                                    aria-hidden="true"></i>
                                Şəkil</a>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        @if (
            ($desk->user_id == Auth::user()->id && ($desk->status != 'success' && $desk->status != 'unsuccess')) ||
                ($desk->responder &&
                    $desk->responder->user->id == Auth::user()->id &&
                    ($desk->status === 'activ' || $desk->status === 'forwarded')) ||
                (Auth::user()->id == 9 || Auth::user()->id == 140))
            <form action="{{ route('helpdesk_new_message') }}" enctype="multipart/form-data" method="POST"
                id="create-message">
                {!! csrf_field() !!}


                <div class="form-group">
                    <label for="exampleInputPassword1">Mətn</label>
                    <textarea name="message" id="" cols="30" required rows="3"
                        placeholder="Problemlə bağlı mətni buraya daxil edin." class="form-control"></textarea>
                </div>

                <div class="form-group file-input">
                    <label>
                        <span>Problemlə bağlı şəkil seçərək <strong class="text-primary">yükləyin</strong></span>
                        <input type="file" name="image" id="fileInput" class="hide">
                    </label>
                </div>

                <input type="hidden" name="helpdesk_id" value="{{ $desk->id }}">

                <button type="submit" class="btn btn-primary">GÖNDƏR</button>
            </form>
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

{{-- ! 291 --}}
