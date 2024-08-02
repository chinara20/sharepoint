<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.png" />
    <title>NBA Sharepoint</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700|Love+Ya+Like+A+Sister|Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,300i,400,400i,600,700,700i,800|Raleway:100,200,300,400,500,600,700,800,900|Roboto:100,100i,300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/public.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/core.animation.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/js/vendor/bp/bbpress-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/custom-style.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/responsive.css' type='text/css' media='all' /> 
    <link rel='stylesheet' href='/assets/css/custom.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/js/vendor/comp/comp.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/core.messages.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/css/flipclock.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/assets/js/vendor/swiper/idangerous.swiper.min.css' type='text/css' media='all' />    
	<link rel='stylesheet' href='/assets/css/notie.css' type='text/css' media='all' />
	    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="ws_url" content="{{ env('WS_URL') }}">
    <meta name="user_id" content="{{ Auth::id() }}">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">

</head>

<body class="home-page home page body_style_fullwide body_filled article_style_stretch top_panel_style_dark top_panel_opacity_solid top_panel_over sidebar_hide responsive_menu vc_responsive no-js">
<div class="body_wrap">
    <div class="page_wrap">
        <header class="top_panel_wrap">
            <div class="menu_user_wrap">
                <div class="logo">
                    <a href="index-2.html">
                        <img src="/assets/images/Logo.png" class="logo_main" alt="">
                    </a>
                </div>
                <div class="menu_user_area menu_user_right menu_user_nav_area m_top">
                    <ul id="menu_user" class="menu_user_nav">
                        <li class="menu_user_register">
                            <a href="#popup_registration" class="popup_link popup_register_link">Register</a>
                            <div id="popup_registration" class="popup_wrap popup_registration bg_tint_light">
                                <a href="#" class="popup_close"></a>
                                <div class="form_wrap">
                                    <form name="registration_form" method="post" class="popup_form registration_form">
                                        <input type="hidden" name="redirect_to" value="index-2.html" />
                                        <div class="form_left">
                                            <div class="popup_form_field login_field iconed_field">
                                                <input type="text" id="registration_username" name="registration_username" value="" placeholder="User name (login)">
                                            </div>
                                            <div class="popup_form_field email_field iconed_field">
                                                <input type="text" id="registration_email" name="registration_email" value="" placeholder="E-mail">
                                            </div>
                                            <div class="popup_form_field agree_field">
                                                <input type="checkbox" value="agree" id="registration_agree" name="registration_agree">
                                                <label for="registration_agree">I agree with</label>
                                                <a href="#">Terms &amp; Conditions</a>
                                            </div>
                                            <div class="popup_form_field submit_field">
                                                <input type="submit" class="submit_button" value="Sign Up">
                                            </div>
                                        </div>
                                        <div class="form_right">
                                            <div class="popup_form_field password_field iconed_field">
                                                <input type="password" id="registration_pwd" name="registration_pwd" value="" placeholder="Password">
                                            </div>
                                            <div class="popup_form_field password_field iconed_field">
                                                <input type="password" id="registration_pwd2" name="registration_pwd2" value="" placeholder="Confirm Password">
                                            </div>
                                            <div class="popup_form_field description_field">Minimum 6 characters</div>
                                        </div>
                                    </form>
                                    <div class="result message_block"></div>
                                </div>
                            </div>
                        </li>
                        <li class="menu_user_login"><a href="#popup_login" class="popup_link popup_login_link">Login</a>
                            <div id="popup_login" class="popup_wrap popup_login bg_tint_light popup_half">
                                <a href="#" class="popup_close"></a>
                                <div class="form_wrap">
                                    <div>
                                        <form action="#" method="post" name="login_form" class="popup_form login_form">
                                            <input type="hidden" name="redirect_to" value="#">
                                            <div class="popup_form_field login_field iconed_field icon-user-2">
                                                <input type="text" id="log" name="log" value="" placeholder="Login or Email">
                                            </div>
                                            <div class="popup_form_field password_field iconed_field icon-lock-1">
                                                <input type="password" id="password" name="pwd" value="" placeholder="Password">
                                            </div>
                                            <div class="popup_form_field remember_field">
                                                <a href="#" class="forgot_password">Forgot password?</a>
                                                <input type="checkbox" value="forever" id="rememberme" name="rememberme">
                                                <label for="rememberme">Remember me</label>
                                            </div>
                                            <div class="popup_form_field submit_field">
                                                <input type="submit" class="submit_button" value="Login">
                                            </div>
                                            <div class="result message_block"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="search_wrap search_style_regular search_ajax" title="Open/close search form">
                        <a href="#" class="search_icon icon-23"></a>
                        <div class="search_form_wrap">
                            <form role="search" method="get" class="search_form" action="#">
                                <button type="submit" class="search_submit icon-23" title="Start search"></button>
                                <input type="text" class="search_field" placeholder="" value="" name="s" title="" />
                            </form>
                        </div>
                        <div class="search_results widget_area bg_tint_light">
                            <a class="search_results_close icon-cancel"></a>
                            <div class="search_results_content"></div>
                        </div>
                    </div>
                    <div class="menu_button show_menu">Show Menu</div>
                </div>
            </div>
        </header>
        <aside class="menu_main_wrap">
            <nav role="navigation" class="menu_main_nav_area">
                <ul id="menu_main" class="menu_main_nav">
                    <li class="icon-3 menu-item current-menu-ancestor current-menu-parent menu-item-has-children"><a>Ana Səhifə</a>
                        <ul class="sub-menu">
                            <li class="menu-item current-menu-item"><a href="index-2.html">Style 1</a></li>
                            <li class="menu-item"><a href="home-2.html">Style 2</a></li>
                            <li class="menu-item"><a href="home-3.html">Style 3</a></li>
                            
                        </ul>
                    </li>
                    <li class="icon-22 menu-item menu-item-has-children"><a>Sturuktur</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="scheme-1.html">Color Scheme 1</a></li>
                            <li class="menu-item"><a href="scheme-2.html">Color Scheme 2</a></li>
                            <li class="menu-item"><a href="scheme-3.html">Color Scheme 3</a></li>
                        </ul>
                    </li>
                    <li class="icon-5 menu-item menu-item-has-children"><a href="/chat">Chat</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="ceo.html">CEO</a></li>
                            <li class="menu-item"><a href="leaders.html">Team Leaders</a></li>
                            <li class="menu-item"><a href="team.html">Department</a></li>
                        </ul>
                    </li>
                     <!--<li class="icon-7 menu-item"><a href="post-formats.html">Blog streampage</a></li>
                    <li class="icon-17 menu-item menu-item-has-children"><a>Education</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="trainings.html">Trainings</a></li>
                            <li class="menu-item"><a href="tests.html">Tests and Quizzes</a></li>
                            <li class="menu-item"><a href="tutorials.html">Tutorials</a></li>
                        </ul>
                    </li>
                    <li class="icon-21 menu-item menu-item-has-children"><a>Career</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="vacancies.html">Vacancies</a></li>
                            <li class="menu-item"><a href="resumes.html">Resumes</a></li>
                        </ul>
                    </li>
                    <li class="icon-8 menu-item menu-item-has-children"><a>Community</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="forums.html">Forums</a></li>
                            <li class="menu-item"><a href="single-topic.html">Single Topic</a></li>
                        </ul>
                    </li>
                    <li class="icon-2 menu-item menu-item-has-children"><a>BuddyPress</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="activity.html">Activity</a></li>
                            <li class="menu-item"><a href="groups.html">Groups</a></li>
                            <li class="menu-item"><a href="members.html">Members</a></li>
                        </ul>
                    </li>
                    <li class="icon-9 menu-item menu-item-has-children"><a>File Storage</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="development.html">Development</a></li>
                            <li class="menu-item"><a href="marketing.html">Marketing</a></li>
                            <li class="menu-item"><a href="accounting.html">Accounting</a></li>
                            <li class="menu-item"><a href="resources.html">Human Resources</a></li>
                            <li class="menu-item"><a href="supporter.html">Support</a></li>
                        </ul>
                    </li>
                    <li class="icon-10 menu-item menu-item-has-children"><a>Photo Gallery</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="events.html">Events list</a></li>
                            <li class="menu-item"><a href="cobbles.html">Cobbles Gallery</a></li>
                            <li class="menu-item"><a href="grid.html">Grid Gallery</a></li>
                            <li class="menu-item"><a href="margin-grid.html">Margin Grid Gallery</a></li>
                            <li class="menu-item"><a href="masonry.html">Masonry Gallery</a></li>
                        </ul>
                    </li>
                    <li class="icon-13 menu-item menu-item-has-children"><a>Theme Elements</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="shortcodes.html">Shortcodes</a></li>
                            <li class="menu-item"><a href="typography.html">Typography</a></li>
                            <li class="menu-item"><a href="infographic.html">Infographic</a></li>
                            <li class="menu-item menu-item-has-children"><a>Pages</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="single-post.html">Blog Post</a></li>
                                    <li class="menu-item"><a href="single-event.html">Event Page</a></li>
                                    <li class="menu-item"><a href="single-training.html">Training Page</a></li>
                                    <li class="menu-item"><a href="single-test.html">Quiz Page</a></li>
                                    <li class="menu-item"><a href="single-team.html">Team Member</a></li>
                                    <li class="menu-item"><a href="about.html">About Company</a></li>
                                    <li class="menu-item"><a href="contacts.html">Contacts</a></li>
                                    <li class="menu-item"><a href="support.html">Support</a></li>
                                    <li class="menu-item"><a href="faq.html">FAQ</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </nav>
        </aside>
        <div class="page_content_wrap">
            <div class="content_wrap">
                <div class="content">
                   @yield('content')
                    <section class="related_wrap related_wrap_empty"></section>
                </div>
            </div>
        </div>
        <div class="copyright_wrap">
            <div class="content_wrap">
                <p>© 2017 All Rights Reserved.
                    <a href="#">Terms of use</a> and
                    <a href="#">Privacy Policy</a>
                </p>
            </div>
        </div>
        <a href="#" class="scroll_to_top icon-angle-up-1" title="Scroll to top"></a>
    </div>
</div>

<div class="custom_html_section"></div>

<script type='text/javascript' src='/assets/js/vendor/jquery/jquery.js'></script>
<script type='text/javascript' src='/assets/js/vendor/jquery/jquery-migrate.min.js'></script>
<script type='text/javascript' src='/assets/js/custom/custom.js'></script>
<script type='text/javascript' src='/assets/js/custom/date.js'></script>
<script type='text/javascript' src='/assets/js/vendor/jquery/jquery.my_add_function.js'></script>
<script type='text/javascript' src='http://use.fontawesome.com/fcc8474e79.js'></script>
<script type='text/javascript' src='/assets/js/custom/excanvas.js'></script>
<script type='text/javascript' src='/assets/js/vendor/booked/datepicker.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/bp/foundation.min.js'></script>
<script type='text/javascript' src='/assets/js/custom/cptfunctions.js'></script>
<script type='text/javascript' src='/assets/js/custom/jquery.nestable.js'></script>
<script type='text/javascript' src='/assets/js/custom/cptinnerfun.js'></script>
<script type='text/javascript' src='/assets/js/vendor/chart/chartjs_new.js'></script>
<script type='text/javascript' src='/assets/js/custom/legend.js'></script>
<script type='text/javascript' src='/assets/js/custom/poll.js'></script>
<script type='text/javascript' src='/assets/js/custom/poll-init.js'></script>
<script type='text/javascript' src='/assets/js/custom/responsive.init.js'></script>
<script type='text/javascript' src='/assets/js/custom/core.utils.js'></script>
<script type='text/javascript' src='/assets/js/custom/core.init.js'></script>
<script type='text/javascript' src='/assets/js/custom/embed.min.js'></script>
<script type='text/javascript' src='/assets/js/custom/core.messages.js'></script>
<script type='text/javascript' src='/assets/js/custom/shortcodes.js'></script>
<script type='text/javascript' src='/assets/js/vendor/comp/comp_front.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/grid.js'></script>
<script type='text/javascript' src='/assets/js/vendor/flipclock.js'></script>
<script type='text/javascript' src='/assets/js/vendor/jquery.flatshadow.js'></script>
<script type='text/javascript' src='/assets/js/vendor/isotope/isotope.pkgd.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/swiper/idangerous.swiper-2.7.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/swiper/idangerous.swiper.scrollbar-2.4.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/chart/chart.min.js'></script>
<script type='text/javascript' src='/assets/js/vendor/chart/Graph.js'></script>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/socket.io.js') }}"></script>
    <!-- <script src="http://64.225.97.114:3000/socket.io/socket.io.js"></script> -->
    <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>


    <script src="{{ asset('js/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('js/socket.io-stream.js') }}"></script> --}}
    @yield('page-script')

</body>

<!-- Mirrored from alliancehtml.themerex.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Oct 2022 12:07:18 GMT -->
</html>