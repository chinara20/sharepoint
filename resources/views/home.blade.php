@extends('layouts.panel')
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
<style media="screen">
    .online {
        color: #32CD32;
    }

    .ffside {
        height: 100%;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        width: 18em;
        overflow-x: hidden;
        padding-top: 50px;
    }

    .chat_box {
        width: 260px;
        padding: 5px;
        position: fixed;
        bottom: 0px;
    }

    .navbar-btn {
        margin-top: 8px !important;
    }

    #sidebar_left_toggle {
        margin-top: 25px !important;
    }

    .main_chat>ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .main_chat>ul>li {
        float: left;
        cursor: pointer;
        margin: 1px;
        font-size: 16px;
    }

    .main_chat {
        display: none;
        position: absolute;
        right: 10px;
        bottom: 10px;
        padding: 6px;
        height: 250px;
        width: 210px;
        background-color: #ddd;
        overflow-y: scroll;
        border-radius: 2px;
        z-index: 9999;
    }
</style>
@section('content')
    <audio id="sound" style="display: none;" controls>
        <source src="https://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <div class="container-fluid">
        <div class="error"></div>
        <div class="row">
            <div class="col-md-2" id="chatApp">
                <div class="panel panel-default ffside">
                    <div class="panel-heading">İstifadəçilər</div>
                    <div class="panel-body" style="padding:0px;">
                        <input id="search_user" type="text" class="form-control" placeholder="İstifadəçini axtarın..."
                            name="">
                        <br>
                        <ul style="height: 300px;overflow-y: scroll;" id="user_list" class="list-group">
                            <li class="list-group-item" v-for="chatList in chatLists" style="cursor: pointer;"
                                @click="chat(chatList)">@{{ chatList.name }} <i class="fa fa-circle pull-right"
                                    v-bind:class="{'online': (chatList.online=='Y')}"></i> <span class="badge"
                                    v-if="chatList.msgCount !=0">@{{ chatList.msgCount }}</span></li>
                            <li class="list-group-item" v-if="socketConnected.status == false">@{{ socketConnected.msg }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/chat.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $("#search_user").on("keyup", function() {
            var value = this.value.toLowerCase().trim();
            $("#user_list li").show().filter(function() {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script>
    <script type="text/javascript">
        (async () => {
            // create and show the notification
            const showNotification = () => {
                // create a new notification
                const notification = new Notification('Sahepoint test message', {
                    body: 'Sharepoint message',
                    // icon: './img/js.png'
                });

                // close the notification after 10 seconds
                setTimeout(() => {
                    notification.close();
                }, 10 * 1000);

                // navigate to a URL when clicked
                notification.addEventListener('click', () => {

                    window.open('https://sharepoint.nbatech.az:8085/chat', '_blank');
                });
            }

            // show an error message
            const showError = () => {
                const error = document.querySelector('.error');
                error.style.display = 'block';
                error.textContent = '';
            }

            // check notification permission
            let granted = false;

            if (Notification.permission === 'granted') {
                granted = true;
            } else if (Notification.permission !== 'denied') {
                let permission = await Notification.requestPermission();
                granted = permission === 'granted' ? true : false;
            }

            // show notification or error
            granted ? showNotification() : showError();

        })();
    </script>
    <script type="text/javascript">
        $(".main_chat > ul > li").click(function() {
            console.log($(this).text());
        });
        $(".smile_icons").click(function() {
            alert('a');
            $(".main_chat").show()
            // console.log($(this).text());
        });
    </script>
@stop
