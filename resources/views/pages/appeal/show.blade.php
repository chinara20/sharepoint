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
        <div class="info" >
                <div>
                    <span>Başlıq :</span>
                    <strong>{{ $appeal->title }}</strong>
                </div>
                <div>
                    <span>Struktur / Bölmə :</span>
                    <strong>{{ $appeal->user->show_department->name ?? '' }} / {{ $appeal->user->show_branch->name ?? '' }}</strong>
                </div>
                <div>
                    <span>Yaradıldı : </span>
                    <strong>{{ $appeal->created_at->format('d.m.Y H:i') }}</strong>
                </div>
                <br>
                <a href="{{ route('appeals.index') }}" class="btn btn-info">Geri</a>
        </div>

        <div>
            <div class="message {{ $appeal->user_id === $appeal->user_id ? 'owner' : 'responder' }}">
                <div class="message_header">
                    <div class="left">
                        <div class="avatar">
                            <img src="/storage/{{ $appeal->user->img }}" alt="">
                        </div>
                        <div>
                            <span>{{ $appeal->user->name }}</span>
                        </div>
                    </div>
                    <div class="right">
                        <span>{{ $appeal->created_at->format('d.m.Y (H:i)') }}</span>
                    </div>
                </div>
                <div class="content">
                    {{ $appeal->content }}
                </div>
            </div>
        </div>

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
@endsection
