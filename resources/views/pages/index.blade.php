{{-- @php
    Maatwebsite\Excel\Facades\Excel::load('bdays.xlsx', function ($reader) {
        $results = $reader->all()[0];
        foreach ($results as $result) {
            $user = \App\User::where('email', $result->mail);
            if ($user->get()) {
                $user->update([
                    'birthday_date' => $result->ad_guenue_2->format('Y-m-d'),
                ]);
            }
        }
    });
@endphp --}}
@extends('layouts.panel')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://preview.colorlib.com/theme/magnews2/css/util.min.css">
    <link rel="stylesheet" type="text/css" href="https://preview.colorlib.com/theme/magnews2/css/main.css">
    <style type="text/css">
        .new_img {
            height: 100px;
            width: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .location .city {
            color: #fff;
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .location .date {
            color: #fff;
            font-size: 16px;
        }

        .current .temp {
            color: #fff;
            font-size: 102px;
            font-weight: 900;
            margin: 30px 0px;
            text-shadow: 2px 10px rgba(0, 0, 0, 0.6);
        }

        .current .temp span {
            font-weight: 500;
        }

        .current .weather {
            color: #fff;
            font-size: 32px;
            font-weight: 700;
            font-style: italic;
            margin-bottom: 15px;
            text-shadow: 0px 3px rgba(0, 0, 0, 0.4);
        }

        .current .hi-low {
            color: #fff;
            font-size: 24px;
            font-weight: 500;
            text-shadow: 0px 4px rgba(0, 0, 0, 0.4);
        }

        .main {
            width: 100%;
            height: 346px;
            background-color: #ffffff;
            /*box-shadow: 0px 31px 35px -26px #080c21;*/
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            margin-top: 10px;
        }

        .left {
            margin-top: 80px;
            padding: 15px;
        }

        .right {
            margin-top: 35px;
            margin-right: 14px;
        }

        .left-img {
            width: 60px;
        }

        .right-img {
            width: 244px;
            border-radius: 4px;
            height: 300px;
            object-fit: cover;
            margin-left: 67px;
        }

        .date {
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            font-weight: bold;
        }

        .city {
            font-size: 21px;
            color: rgba(0, 0, 0, 0.7);
            padding-top: 5px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .tempreture {
            padding-top: 10px;
            font-size: 55px;
            color: rgba(0, 0, 0, 0.9);
            font-weight: 100;
        }
    </style>
    <style type="text/css">
        #news-slider {
            margin-top: 80px;
        }

        .post-slide {
            background: #fff;
            margin: 20px 15px 20px;
            border-radius: 15px;
            padding-top: 1px;
            box-shadow: 0px 14px 22px -9px #bbcbd8;
        }

        .post-slide .post-img {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin: -12px 15px 8px 15px;
            margin-left: -10px;
        }

        .post-slide .post-img img {
            width: 100%;
            height: auto;
            transform: scale(1, 1);
            transition: transform 0.2s linear;
        }

        .post-slide:hover .post-img img {
            transform: scale(1.1, 1.1);
        }

        .post-slide .over-layer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            background: linear-gradient(-45deg, rgba(6, 190, 244, 0.75) 0%, rgba(45, 112, 253, 0.6) 100%);
            transition: all 0.50s linear;
        }

        .post-slide:hover .over-layer {
            opacity: 1;
            text-decoration: none;
        }

        .post-slide .over-layer i {
            position: relative;
            top: 45%;
            text-align: center;
            display: block;
            color: #fff;
            font-size: 25px;
        }

        .post-slide .post-content {
            background: #fff;
            padding: 2px 20px 40px;
            border-radius: 15px;
        }

        .post-slide .post-title a {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
        }

        .post-slide .post-title a:hover {
            text-decoration: none;
            color: #3498db;
        }

        .post-slide .post-description {
            line-height: 24px;
            color: #808080;
            margin-bottom: 25px;
        }

        .post-slide .post-date {
            color: #a9a9a9;
            font-size: 14px;
        }

        .post-slide .post-date i {
            font-size: 20px;
            margin-right: 8px;
            color: #CFDACE;
        }

        .post-slide .read-more {
            padding: 7px 20px;
            float: right;
            font-size: 12px;
            background: #2196F3;
            color: #ffffff;
            box-shadow: 0px 10px 20px -10px #1376c5;
            border-radius: 25px;
            text-transform: uppercase;
        }

        .post-slide .read-more:hover {
            background: #3498db;
            text-decoration: none;
            color: #fff;
        }

        .owl-controls .owl-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .owl-controls .owl-buttons .owl-prev {
            background: #fff;
            position: absolute;
            top: -13%;
            left: 15px;
            padding: 0 18px 0 15px;
            border-radius: 50px;
            box-shadow: 3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }

        .owl-controls .owl-buttons .owl-next {
            background: #fff;
            position: absolute;
            top: -13%;
            right: 15px;
            padding: 0 15px 0 18px;
            border-radius: 50px;
            box-shadow: -3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }

        .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after {
            content: "\f104";
            font-family: FontAwesome;
            color: #333;
            font-size: 30px;
        }

        .owl-controls .owl-buttons .owl-next:after {
            content: "\f105";
        }

        @media only screen and (max-width:1280px) {
            .post-slide .post-content {
                padding: 0px 15px 25px 15px;
            }
        }

        .f1-l-1 {
            font-size: 24px;
            width: 460px;
            padding-left: 10px;
        }

        .hov-cl10:hover {
            color: #023262;
             !important;
        }

        /*  .how-txt1:hover{
                                                                                                                                                                                                                                                                                                                                                                       color: #54b8be;!important;
                                                                                                                                                                                                                                                                                                                                                                       }*/
        .m-rl--1 {
            margin-right: -11px !important;
        }

        .card {
            background: #fdfdfd;
            border-radius: 4px;
            /*height: 300px;*/
            margin-bottom: 25px;
            /*width: 80vw;*/
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            text-align: center;
            display: flex;
            flex-direction: column !important;
            justify-content: center;
            align-items: center;
            padding: 1em;
            overflow: hidden;

        }

        @media only screen and (min-width: 1000px) {
            .card {
                flex-direction: row-reverse;
            }

            .card img.birthday {
                width: 100%;
                max-width: 50vw;
                max-height: unset;
            }
        }

        @media only screen and (max-height: 640px) {
            .card {
                flex-direction: row-reverse;
            }

            .card img.birthday {
                width: 100%;
                max-width: 50vw;
                max-height: unset;
            }
        }

        img.birthday {
            max-height: 40vh;
        }

        .text {
            padding: 1em;
        }

        .muted {
            opacity: 0.8;
        }

        .space {
            width: 100%;
            height: 100px;
        }
    </style>
    <!-- -------------- Column Center -------------- -->
    <div class="chute chute-center">
        <!-- -------------- Quick Links -------------- -->
        <div class="row">
            <div class="col-sm-6 col-xl-3" style="cursor:pointer;">
                <div class="panel panel-tile">
                    <div class="panel-body">
                        <div onclick="window.open('https://ticket.nbatech.az:8085/')" class="row pv10">
                            <div class="col-xs-5 ph10">
                                <i style="color: #54b8be;" class="fa fa-4x fa-ticket" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-7 pl5">
                                <h6 class="text-muted">Ticket</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" style="cursor:pointer;">
                <div class="panel panel-tile">
                    <div class="panel-body">
                        <div onclick="location.href = '{{ route('chat') }}';" class="row pv10">
                            <div class="col-xs-5 ph10">
                                <i style="color: #54b8be;" class="fa fa-4x fa-comments" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-7 pl5">
                                <h6 class="text-muted">Chat</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" style="cursor:pointer;">
                <div class="panel panel-tile">
                    <div class="panel-body">
                        <div onclick="location.href = '{{ route('vacansy.index') }}';" class="row pv10">
                            <div class="col-xs-5 ph10">
                                <i style="color: #54b8be;" class="fa fa-4x fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-7 pl5">
                                <h6 class="text-muted">Vakansiya</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" style="cursor:pointer;">
                <div class="panel panel-tile">
                    <div class="panel-body">
                        <div onclick="window.open('https://outlook.office.com/calendar/view/week')" class="row pv10">
                            <div class="col-xs-5 ph10">
                                <i style="color: #54b8be;" class="fa fa-4x fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-7 pl5">
                                <h6 class="text-muted">Görüş otağı </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------- AllCP Info -------------- -->
        <!-- -------------- AllCP Info -------------- -->
        <div class="col-md-12">
            @foreach ($birthdays as $birthday)
                <div class="row card"
                    style="-webkit-box-shadow: 1px 2px 0 #e5eaee;
                    box-shadow: 1px 2px 0 #e5eaee;">
                    {{-- <img src="https://i.imgur.com/AdmabyE.png" style="width: 150px;border-radius: 50%;" alt="birthday"
                            class="birthday"> --}}
                    <div class="text"
                        style="display: flex; gap:20px; align-items: center;flex-wrap: wrap; justify-content: center">
                        <img src="" alt="">
                        {{-- <img width="130" height="130" style="border-radius: 100%"
                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                                alt=""> --}}
                        <img width="130" height="130" style="border-radius: 100%; object-fit: cover"
                            src="/storage/{{ $birthday->img }}" alt="">
                        <div>
                            <h1 style="font-size: 30px;margin-bottom: 0">{{ $birthday->name }}</h1>
                            <p class="muted" style="font-size: 22px">Ad gününüz mübarək!</p>
                            <p style="color: rgba(0,0,0,.5)">Sizə müvəffəqiyyətlər arzulayırıq</p>
                        </div>
                        <img width="160" src="bday.png" alt="">
                    </div>
                    <!-- <div class="space"></div> -->
                </div>
            @endforeach
        </div>
        <!-- -------------- Country List -------------- -->
        <!-- -------------- Country List -------------- -->


        @if (count($news) >= 4)
            <div class="col-md-12 row">
                <div class="row m-rl--1">
                    <div class="col-md-6 p-rl-1 p-b-2">


                       <!--  <div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url('/eurocis1.webp');">
                            <a href="/xeber?id=19159" class="dis-block how1-child1 trans-03"></a>
                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20" style="padding:0;">
                                <div style="background-color: #becde0;opacity: .7;height: 93px;width: 486px;bottom: 20px;position: absolute;"
                                    class="item-div-new">
                                </div>

                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="/xeber?id=19159" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                    Şirkətimizin əməkdaşları EuroCİS 2024 sərgisində
                                    </a>
                                </h3>
                                <span class="how1-child2">
                                    <span class="f1-s-4 cl11">
                                    </span>
                                    <span class="f1-s-3 cl11 m-rl-3">
                                    </span>
                                    <span class="f1-s-3 cl11">
                                    </span>
                                </span>
                            </div>
                        </div> -->

                        <div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url('https://sharepoint.nbatech.az:9490/20240624_084124.jpg');">
                            <a href="/xeber?id=24321" class="dis-block how1-child1 trans-03"></a>
                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20" style="padding:0;">
                                <div style="background-color: #becde0;opacity: .7;height: 93px;width: 486px;bottom: 20px;position: absolute;"
                                    class="item-div-new">
                                </div>

                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="/xeber?id=24321" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">24-26 iyun tarixlərində 200-ə yaxın yerli şirkətin iştirakı ilə Bakı Ekspo Mərkəzində Kiçik və Orta Biznesin İnkişafı Agentliyinin (KOBİA) və Marsol Group-un birgə təşkilatçılığı, Kapital Bankın rəsmi tərəfdaşlığı ilə “5-ci Yerli şirkətlərin tanıtım sərgisi” baş tutmuşdu.Şirkətimizin əməkdaşları EuroCİS 2024 sərgisində
                                    </a>
                                </h3>
                                <span class="how1-child2">
                                    <span class="f1-s-4 cl11">
                                    </span>
                                    <span class="f1-s-3 cl11 m-rl-3">
                                    </span>
                                    <span class="f1-s-3 cl11">
                                    </span>
                                </span>
                            </div>
                        </div> 


                         <!-- <div class="bg-img1 size-a-3 how1 pos-relative"
                            style="background-image: url({{ $news[0]['thumbnail'] }});">
                            <a href="" class="dis-block how1-child1 trans-03"></a>
                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20" style="padding:0;">
                                <div style="background-color: #becde0;opacity: .7;height: 93px;width: 486px;bottom: 20px;position: absolute;"
                                    class="item-div-new">
                                </div>

                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="/xeber?id={{ $news[0]['id'] }}"
                                        class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                        {{ $news[0]['title'] }}
                                    </a>
                                </h3>
                                <span class="how1-child2">
                                    <span class="f1-s-4 cl11">
                                    </span>
                                    <span class="f1-s-3 cl11 m-rl-3">
                                    </span>
                                    <span class="f1-s-3 cl11">
                                    </span>
                                </span>
                            </div>
                        </div>  -->
                    </div>
                    <div class="col-md-6 p-rl-1">
                        <div class="row m-rl--1">
                           
                       <!--  <div class="col-12 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-4 how1 pos-relative"
                                    style="background-image: url('/pasha1.webp');">
                                    <div style="padding: 0;" class="flex-col-e-s s-full p-rl-25 p-tb-24">
                                        <div style="background-color: #becde0;opacity: .7;height: 93px;width: 486px;bottom: 20px;position: absolute;"
                                            class="item-div-new">
                                        </div>
                                        <h3 style="padding-left: 10px;" class="how1-child2 m-t-14">
                                            <a style="margin-bottom: 34px; width: 486px;"
                                                href="/xeber?id=19188"
                                                class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
                                                Şirkətimizin əməkdaşlarının “PAŞA Bank” ASC-nin dəvəti ilə “İqtisadiyyatın və cəmiyyətin dayanıqlı inkişafında qadınların rolu” konfransında iştirakı
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-4 how1 pos-relative"
                                    style="background-image: url({{ $news[1]['thumbnail'] }});">
                                    <div style="padding: 0;" class="flex-col-e-s s-full p-rl-25 p-tb-24">
                                        <div style="background-color: #becde0;opacity: .7;height: 93px;width: 486px;bottom: 20px;position: absolute;"
                                            class="item-div-new">
                                        </div>
                                        <h3 style="padding-left: 10px;" class="how1-child2 m-t-14">
                                            <a style="margin-bottom: 34px; width: 486px;"
                                                href="/xeber?id={{ $news[1]['id'] }}"
                                                class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03">
                                                {{ $news[1]['title'] }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url({{ $news[2]['thumbnail'] }});">
                                    <a href="/xeber?id={{ $news[2]['url'] }}" class="dis-block how1-child1 trans-03"></a>
                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20" style="padding:0;">
                                        <!--  <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                                                                                                                                                                                                                                                                                                                                                                               </a> -->
                                        <div style="background-color: #becde0;opacity: .7;height: 60px;width: 100%;bottom: 20px;position: absolute;"
                                            class="item-div-new">
                                        </div>
                                        <h3 style="padding-left: 10px;" class="how1-child2 m-t-14">
                                            <a style="margin-bottom: 34px;" href="/xeber?id={{ $news[2]['id'] }}"
                                                class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
                                                {{ $news[2]['title'] }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url({{ $news[3]['thumbnail'] }});">
                                    <a href="/xeber?id={{ $news[3]['url'] }}" class="dis-block how1-child1 trans-03"></a>
                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20" style="padding:0;">
                                        <!--  <a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                                                                                                                                                                                                                                                                                                                                                                               </a> -->
                                        <div style="background-color: #becde0;opacity: .7;height: 60px;width: 100%;bottom: 20px;position: absolute;"
                                            class="item-div-new">
                                        </div>
                                        <h3 style="padding-left: 10px;" class="how1-child2 m-t-14">
                                            <a style="margin-bottom: 34px;width: 198px;"
                                                href="/xeber?id={{ $news[3]['id'] }}"
                                                class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
                                                {{ $news[3]['title'] }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        <div class="col-md-12 row" style="padding: 10px;">
            <div class="col-md-6" style="padding: 0;">
                <form style="background: white;padding: 10px; margin: 10px;border-radius: 4px;"
                    action="{{ route('report_send') }}" method="POST">
                    {!! csrf_field() !!}
                    <h3>Şikayət və təkliflərinizi bildirin!</h3>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Başlıq</label>
                        <input name="title" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Başlıq">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Məzmun</label>
                        <textarea name="text" cols="15" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Növ</label>
                        <select name="type" class="form-control">
                            <option value="1">Təklif</option>
                            <option value="2">Şikayət</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Göndər</button>
                </form>
            </div>
            <div style="padding: 0" class="col-md-6">
                <!-- -------------- Country List -------------- -->
                <div class="">
                    <main class="main" style="margin-left: 10px;">
                        <div class="left">
                            <div class="date">Cümə 3 Mart 2023</div>
                            <div class="city">Baku, AZ</div>
                            <div class="tempreture">
                                <img src="https://cdn-icons-png.flaticon.com/512/1779/1779940.png" alt="icon"
                                    class="left-img">
                                <span class="temp">11<span>°c</span></span>
                            </div>
                        </div>
                        <div class="right">
                            <div class="city-img">
                                <img src="/Baku.jpg" alt="tajmahal" class="right-img">
                            </div>
                        </div>
                    </main>
                    <!-- <div class="container">
                                                                                                                                                                                                                                                                                                                                                                                   <div class="row hidden-md-up">
                                                                                                                                                                                                                                                                                                                                                                                      <div class="col-md-4">
                                                                                                                                                                                                                                                                                                                                                                                         <div style="margin-top: 20px;" class="panel panel-default">
                                                                                                                                                                                                                                                                                                                                                                                            <div class="text-center panel-heading"><img style="height: 185px;" src="/nicat.png"></div>
                                                                                                                                                                                                                                                                                                                                                                                            <div class="panel-body">Hörmətli <b> Nicat Bağırov </b>, sizi NBA ailəsi  adından ad gününüzü təbrik edirik</div>
                                                                                                                                                                                                                                                                                                                                                                                         </div>
                                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                                   </div>
                                                                                                                                                                                                                                                                                                                                                                                </div> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
