@php
    $notifications = \App\Models\Notification::where('user_id', Auth::user()->id)
        ->where('status', 0)
        ->get()
        ->reverse();
@endphp
<!DOCTYPE html>
<html lang="az">

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>NBA SharePoint</title>
    <meta name="keywords" content="sharepoint,nba" />
    <meta name="description" content="Sharepoint nba">
    <meta name="author" content="nijat baghirov">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="ws_url" content="https://sharepoint.nbatech.az:3000">
    <meta name="user_id" content="{{ Auth::user()->id }}">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
        type='text/css'>

    <!-- -------------- Icomoon -------------- -->
    <link rel="stylesheet" type="text/css" href="https://alliance-html.themerex.net/assets/fonts/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/panel/custom.css') }}">

    <!-- -------------- FullCalendar -------------- -->
    <link rel="stylesheet" type="text/css"
        href="https://alliance-html.themerex.net/assets/js/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://alliance-html.themerex.net/assets/js/plugins/magnific/magnific-popup.css">

    <!-- -------------- Plugins -------------- -->
    <link rel="stylesheet" type="text/css"
        href="https://alliance-html.themerex.net/assets/js/plugins/c3charts/c3.min.css">

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="/assets/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="https://alliance-html.themerex.net/assets/allcp/forms/css/forms.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="https://i.imgur.com/jhSCnHf.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

</head>
<style type="text/css">
    .sidebar-widget.author-widget .media-left img {
        border-radius: 15px;
    }

    .nav>li>a>img {
        border-radius: 15px;
    }

    .navbar-btn {
        margin: 0;
    }

    .navbar .navbar-btn.btn-group>.btn {
        background: unset;
        border-bottom: 0;
    }

    .breadcrumb .fa,
    .breadcrumb .glyphicon,
    .breadcrumb .glyphicons {
        background: #618bb6 !important;
    }

    .breadcrumb>li {
        color: #618bb6 !important;
    }

    .text-muted {
        color: #618bb6;
        margin-top: 20px;
        font-size: 18px !important;
    }

    .header.navbar+#sidebar_left {
        margin-top: 0px;
    }

    #sidebar_left.nano.affix {
        /*width: 240px;*/
    }

    .navbar .nav>li {
        line-height: 50px;
    }

    .text-muted {
        color: #54b8be;
    }

    .navbar-logo-wrapper {
        height: 50px;
    }

    .ad-lines:before {
        content: '';
    }

    body.sb-l-m .sidebar-menu>li>a>span:nth-child(1) {
        color: #fff;
    }
</style>
<style>
    .panel-menu {
        padding: 0 !important;
        color: #000 !important;
        display: flex;
        align-items: center;
        column-gap: 8px;
    }

    .notifications {
        display: flex;
        flex-direction: column;
        max-height: 219px;
        overflow: auto;
    }

    .notifications a {
        /* background-color: red; */
        text-decoration: none;
    }

    .notifications .read-all-btn {
        margin: 10px 0;
    }

    .notifications .notification {
        display: flex;
        align-items: center;
        column-gap: 6px;
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        padding: 12px 10px;
    }

    .notifications .notification:hover {
        background-color: rgba(0, 0, 0, .1);
    }

    .notifications .notification .avatar {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notifications .notification .avatar.notify-icon {
        background-color: #fcd34d;
        color: #fff;
    }

    .notifications .notification .avatar+div {
        line-height: 16px
    }

    .notifications .notification p {
        line-height: 20px;
        color: #000;
    }

    .notifications .notification p+span {
        line-height: 20px;
        color: rgba(0, 0, 0, .5);
    }

    .dropdown-menu {
        background-color: #fff !important;
    }

    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #fff;
        width: 19px;
        height: 19px;
        border-radius: 50%;
        background-color: red;
    }
</style>

<body class="dashboard-page">

    <!-- -------------- Body Wrap  -------------- -->
    <div id="main">

        <!-- -------------- Header  -------------- -->
        <header style="height: 55px;min-height: 1px;" class="navbar navbar-fixed-top bg-dark">
            <div style="background-color:  #618bb6!important;width: 240px;" class="navbar-logo-wrapper">
                <img style="height: 2.2vw;margin-top: 4px;margin-left: 10px;margin-top: 12px;;" src="/logo.png">
                <span id="sidebar_left_toggle" class="ad ad-lines">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </span>
            </div>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-fuse">
                    <div class="navbar-btn btn-group">
                        <button data-toggle="dropdown" class="btn dropdown-toggle">
                            <span style="color:white;" class="fa fa-envelope fs20 text-danger"></span>
                        </button>
                        <!-- <button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        3
                    </button> -->
                        <div class="dropdown-menu keep-dropdown w375 animated animated-shorter fadeIn" role="menu">
                            <div class="panel mbn">
                                <div class="panel-menu">
                                    <div class="btn-group btn-group-justified btn-group-nav" role="tablist">
                                        <a href="#nav-tab1" data-toggle="tab"
                                            class="btn btn-primary btn-bordered btn-sm active">Gələn Bildirişlər</a>
                                        <!--  <a href="#nav-tab2" data-toggle="tab"
                                       class="btn btn-primary btn-bordered btn-sm br-l-n br-r-n">Messages</a>
                                    <a href="#nav-tab3" data-toggle="tab" class="btn btn-primary btn-bordered btn-sm">Notifications</a> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-scroller scroller-overlay scroller-navbar pn">
                                    <div class="tab-content br-n pn">

                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-primary btn-sm btn-bordered"> Ətraflı </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown dropdown-fuse">
                    <div class="navbar-btn btn-group">
                        <button data-toggle="dropdown" class="btn dropdown-toggle">
                            <span style="color:white;" class="fa fa-bell fs20 text-primary"></span>
                            @if (count($notifications) > 0)
                                <span class="notification-badge">{{ count($notifications) }}</span>
                            @endif
                        </button>
                        <!-- <button data-toggle="dropdown" class="btn dropdown-toggle fs18 visible-xl">
                        8
                    </button> -->
                        <div class="dropdown-menu keep-dropdown w375 animated animated-shorter fadeIn" role="menu">
                            <div class="panel mbn">
                                <div class="panel-menu">
                                    <span class="panel-icon"><i class="fa fa-tasks"></i></span>
                                    <span class="panel-title fw600"> Gələn Mesajlar</span>
                                    <button class="btn btn-default light btn-xs btn-bordered pull-right"
                                        type="button"><i class="fa fa-refresh"></i>
                                    </button>
                                </div>

                                <div class="notifications">
                                    @if (count($notifications) > 1)
                                        <a href="{{ route('notification_read_all') }}"
                                            class="btn btn-primary read-all-btn">Hamısını sil</a>
                                    @endif
                                    @foreach ($notifications as $notification)
                                        <a href="{{ route('notification_toggle_status', $notification->id) }}">
                                            <div class="notification">
                                                @if ($notification->reviewer && $notification->reviewer->img)
                                                    <div class="avatar">
                                                        <img src="/storage/{{ $notification->reviewer->img }}"
                                                            alt="">
                                                    </div>
                                                @else
                                                    <div class="avatar notify-icon">
                                                        <i class="fa-regular fa-bell"></i>
                                                    </div>
                                                @endif
                                                {{-- <img src="https://accounts.fozzy.com/templates/fozzy/img/admin-avatar.svg"
                                                        alt=""> --}}
                                                <div>
                                                    <p><strong>{{ $notification->reviewer ? $notification->reviewer->name : null }}
                                                        </strong>{{ $notification->content }}
                                                    </p>
                                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown dropdown-fuse">
                    <a style="line-height: 55px;" href="#" class="dropdown-toggle fw600"
                        data-toggle="dropdown">
                        <span class="hidden-xs">
                            <name style="color: white;">{{ Auth::user()->name }}</name>
                        </span>
                        <span class="fa fa-caret-down hidden-xs mr15"></span>
                        <img style="max-width: 38px!important;display: inline-block;"
                            src="https://cdn-icons-png.flaticon.com/512/1177/1177568.png" alt="avatar"
                            class="mw55">
                    </a>
                    <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                        <li class="dropdown-footer text-center">
                            <a href="{{ route('logout') }}" class="btn btn-primary btn-sm btn-bordered">
                                <span class="fa fa-power-off pr5"></span> Çıxış </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- -------------- /Header  -------------- -->

        <!-- -------------- Sidebar  -------------- -->
        <aside id="sidebar_left" class="nano nano-light affix" style="margin-top: 55px;">

            <!-- -------------- Sidebar Left Wrapper  -------------- -->
            <div class="sidebar-left-content nano-content">

                <!-- -------------- Sidebar Header -------------- -->
                <header class="sidebar-header">


                    <!-- -------------- Sidebar - Author Menu  -------------- -->
                    <div class="sidebar-widget menu-widget">
                        <div class="row text-center mbn">
                            <div class="col-xs-2 pln prn">
                                <a href="dashboard1.html" class="text-primary" data-toggle="tooltip"
                                    data-placement="top" title="Ana Səhifə">
                                    <span class="fa fa-dashboard"></span>
                                </a>
                            </div>
                            <div class="col-xs-4 col-sm-2 pln prn">
                                <a href="charts-highcharts.html" class="text-info" data-toggle="tooltip"
                                    data-placement="top" title="Stats">
                                    <span class="fa fa-bar-chart-o"></span>
                                </a>
                            </div>
                            <div class="col-xs-4 col-sm-2 pln prn">
                                <a href="sales-stats-products.html" class="text-system" data-toggle="tooltip"
                                    data-placement="top" title="Orders">
                                    <span class="fa fa-info-circle"></span>
                                </a>
                            </div>
                            <div class="col-xs-4 col-sm-2 pln prn">
                                <a href="sales-stats-purchases.html" class="text-warning" data-toggle="tooltip"
                                    data-placement="top" title="Invoices">
                                    <span class="fa fa-file"></span>
                                </a>
                            </div>
                            <div class="col-xs-4 col-sm-2 pln prn">
                                <a href="basic-profile.html" class="text-alert" data-toggle="tooltip"
                                    data-placement="top" title="Users">
                                    <span class="fa fa-users"></span>
                                </a>
                            </div>
                            <div class="col-xs-4 col-sm-2 pln prn">
                                <a href="management-tools-dock.html" class="text-danger" data-toggle="tooltip"
                                    data-placement="top" title="Settings">
                                    <span class="fa fa-cogs"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </header>
                <!-- -------------- /Sidebar Header -------------- -->

                <!-- -------------- Sidebar Menu  -------------- -->
                @include('layouts.sidebar')
                <!-- -------------- /Sidebar Menu  -------------- -->



            </div>
            <!-- -------------- /Sidebar Left Wrapper  -------------- -->

        </aside>
        <!-- -------------- /Sidebar -------------- -->

        <!-- -------------- Main Wrapper -------------- -->
        <section id="content_wrapper">

            <!-- -------------- Topbar Menu Wrapper -------------- -->
            <div id="topbar-dropmenu-wrapper">
                <div class="topbar-menu row">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-danger">
                            <span class="fa fa-music"></span>
                            <span class="service-title">Audio</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-success">
                            <span class="fa fa-picture-o"></span>
                            <span class="service-title">Images</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-primary">
                            <span class="fa fa-video-camera"></span>
                            <span class="service-title">Videos</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-alert">
                            <span class="fa fa-envelope"></span>
                            <span class="service-title">Messages</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-system">
                            <span class="fa fa-cog"></span>
                            <span class="service-title">Settings</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="service-box bg-dark">
                            <span class="fa fa-user"></span>
                            <span class="service-title">Users</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- -------------- /Topbar Menu Wrapper -------------- -->


            <!-- -------------- Content -------------- -->
            <section id="content" class="table-layout animated fadeIn">
                @yield('content')
            </section>
            <!-- -------------- /Content -------------- -->


        </section>
        <!-- -------------- /Main Wrapper -------------- -->

        <!-- -------------- Sidebar Right -------------- -->
        <aside id="sidebar_right" class="nano affix">

            <!-- -------------- Sidebar Right Content -------------- -->
            <div class="sidebar-right-wrapper nano-content">

                <div class="sidebar-block br-n p15">

                    <h6 class="title-divider text-muted mb20"> Visitors Stats
                        <span class="pull-right"> 2015
                            <i class="fa fa-caret-down ml5"></i>
                        </span>
                    </h6>

                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34"
                            aria-valuemin="0" aria-valuemax="100" style="width: 34%">
                            <span class="fs11">New visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66"
                            aria-valuemin="0" aria-valuemax="100" style="width: 66%">
                            <span class="fs11 text-left">Returnig visitors</span>
                        </div>
                    </div>
                    <div class="progress mh5">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
                            aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                            <span class="fs11 text-left">Orders</span>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt30 mb10">New visitors</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">350</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-warning mn">
                                <i class="fa fa-caret-down"></i> 15.7%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">660</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success-dark mn">
                                <i class="fa fa-caret-up"></i> 20.2%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt25 mb10">Orders</h6>

                    <div class="row">
                        <div class="col-xs-5">
                            <h3 class="text-primary mn pl5">153</h3>
                        </div>
                        <div class="col-xs-7 text-right">
                            <h3 class="text-success mn">
                                <i class="fa fa-caret-up"></i> 5.3%
                            </h3>
                        </div>
                    </div>

                    <h6 class="title-divider text-muted mt40 mb20"> Site Statistics
                        <span class="pull-right text-primary fw600">Today</span>
                    </h6>
                </div>
            </div>
        </aside>
        <!-- -------------- /Sidebar Right -------------- -->

    </div>
    <!-- -------------- /Body Wrap  -------------- -->

    <!-- -------------- Scripts -------------- -->

    <!-- -------------- jQuery -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- -------------- HighCharts Plugin -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/plugins/highcharts/highcharts.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/plugins/c3charts/d3.min.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/plugins/c3charts/c3.min.js"></script>

    <!-- -------------- Simple Circles Plugin -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/plugins/circles/circles.js"></script>

    <!-- -------------- Maps JSs -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js">
    </script>

    <!-- -------------- FullCalendar Plugin -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/plugins/fullcalendar/lib/moment.min.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

    <!-- -------------- Date/Month - Pickers -------------- -->
    <script src="https://alliance-html.themerex.net/assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
    <script src="https://alliance-html.themerex.net/assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>

    <!-- -------------- Magnific Popup Plugin -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/plugins/magnific/jquery.magnific-popup.js"></script>

    <!-- -------------- Theme Scripts -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/utility/utility.js"></script>
    <script src="/assets/js/demo.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/main.js"></script>

    <!-- -------------- Widget JS -------------- -->
    <script src="https://alliance-html.themerex.net/assets/js/demo/widgets.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/demo/widgets_sidebar.js"></script>
    <script src="https://alliance-html.themerex.net/assets/js/pages/dashboard1.js"></script>
    <!-- -------------- /Scripts -------------- -->
    <!-- <script src="https://alliance-html.themerex.net/assets/js/pages/basic-gallery.js"></script> -->

    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"76e951838d85916a","token":"dab7be3e6ab04952b40d6c8e93f6cc2a","version":"2022.11.3","si":100}'
        crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/socket.io.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <!-- {{-- <script src="{{ asset('js/socket.io-stream.js') }}"></script> --}} -->
    @yield('page-script')
    <script type="text/javascript" src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <script type="text/javascript">
        $('.filters ul li').click(function() {
            $('.filters ul li').removeClass('active');
            $(this).addClass('active');

            var data = $(this).attr('data-filter');
            $grid.isotope({
                filter: data
            })
        });

        var $grid = $(".grid").isotope({
            itemSelector: ".all",
            percentPosition: true,
            masonry: {
                columnWidth: ".all"
            }
        })
    </script>

    @if (Request::path() == '/')
        <script type="text/javascript">
            // const $ = document;
            const searchInput = document.querySelector(".search-box");
            const mainContainer = document.querySelector("main");
            let cityElem = document.querySelector(".city");
            let dateElem = document.querySelector(".date");
            let tempElem = document.querySelector(".temp");
            let weatherElem = document.querySelector(".weather");
            let hi_LowElem = document.querySelector(".hi-low");

            const fetchURL = "https://api.openweathermap.org/data/2.5/weather?q=";
            let cityName = null;
            const apiKey = "05017894b8b0ac83af72659f3dc9d03c";


            weatherData('baku');


            function weatherData(CityName) {
                fetch(`${fetchURL}${CityName}&appid=${apiKey}`)
                    .then(res => res.json())
                    .then(cityData => {
                        console.log(cityData)
                        cityElem.innerHTML = `${cityData.name}, ${cityData.sys.country}`
                        dateElem.innerHTML = mainDate()
                        tempElem.innerHTML = `${Math.floor(cityData.main.temp - 273.15)}<span>°c</span>`
                        weatherElem.innerHTML = `${cityData.weather[0].main}`
                        hi_LowElem.innerHTML =
                            `${Math.floor(cityData.main.temp_min - 273.15)}°c / ${Math.floor(cityData.main.temp_max - 273.15)}°c`
                    })
                // .catch(err => alert("city not found"))
            }

            function mainDate() {
                let weekArray = ["Bazar", "Bazar ertəsi", "Çərşənbə axşamı", "Çərşənbə", "Cümə axşamı", "Cümə", "Şənbə"]
                let monthArray = ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr",
                    "Noyabr", "Dekabr"
                ]
                let localDate = new Date()
                let day = localDate.getDate()
                let week = weekArray[localDate.getDay()]
                let month = monthArray[localDate.getMonth()]
                let year = localDate.getFullYear()
                return `${week} ${day} ${month} ${year}`
            }
        </script>
    @endif

    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".permisson_emails").select2({});
    </script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GDCW0DWQZZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GDCW0DWQZZ');
</script>
 <script type="text/javascript" src="https://dl.dropboxusercontent.com/s/hb9vf8r4vz7imyy/ckeditor.js"></script>
<script type="text/javascript">
    ClassicEditor.create(document.querySelector(".editor"), {
    toolbar: {
      items: [
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "|",
        "indent",
        "outdent",
        "|",
        "imageUpload",
        "blockQuote",
        "mediaEmbed",
        "undo",
        "redo",
      ],
    },
    language: "en",
    image: {
      toolbar: ["imageTextAlternative", "imageStyle:full", "imageStyle:side"],
    },
    licenseKey: "",
  })
    .then((editor) => {
      window.editor = editor;
    })
    .catch((error) => {
      console.error("Oops, something went wrong!");
      console.error(
        "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
      );
      console.warn("Build id: ref2goguw78q-8ghiwfe1qu83");
      console.error(error);
    });
</script> 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $('[data-fancybox]').fancybox({
  // Options will go here
  buttons : [
    'close'
  ],
  wheel : false,
  transitionEffect: "slide",
   // thumbs          : false,
  // hash            : false,
  loop            : true,
  // keyboard        : true,
  toolbar         : false,
  // animationEffect : false,
  // arrows          : true,
  clickContent    : false
});
</script>

</body>

</html>
