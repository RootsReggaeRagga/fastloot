<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FASTLOOT.ME</title>

    <meta name="csrf-token" content="{!!  csrf_token()   !!}">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('/template/admin/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/template/admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/template/admin/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/template/admin/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/template/admin/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/ui/drilldown.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/template/admin/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/template/admin/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/template/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/template/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/pickers/daterangepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/template/admin/js/core/app.js') }}"></script>

    <!-- /theme JS files -->

</head>

<body class=" pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>


<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/admin/">FASTLOOT.ME - Админ панель</a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">


        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{$u->avatar}}"><span>{{$u->username}}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
                    <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i
                                    class="icon-comment-discussion"></i> Messages</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                        class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li class="active"><a href="/admin/"><i class="icon-display4 position-left"></i> Главная</a></li>

            <li class="dropdown mega-menu mega-menu-wide">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                            class="icon-puzzle4 position-left"></i>
                    Игры <span class="caret"></span></a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-body">
                        <div class="row">
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Рулетка</span>
                                <div class="dd-wrapper" id="dd-wrapper-0">
                                    <div id="dd-header-0" class="dd-header"><h6>Back to parent</h6></div>
                                    <ul class="menu-list has-children dd-menu" style="overflow: hidden; outline: none;"
                                        tabindex="0">

                                        <li style="display: list-item;"><a href="/admin/classconfig"><i
                                                        class="icon-cog3 position-left"></i>Настройки</a>
                                        </li>


                                        <li style="display: list-item;"><a href="/admin/bots"><i
                                                        class="glyphicon glyphicon-globe  position-left"></i>Боты</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Быстрая игра</span>
                                <div class="dd-wrapper" id="dd-wrapper-0">
                                    <div id="dd-header-0" class="dd-header"><h6>Back to parent</h6></div>
                                    <ul class="menu-list has-children dd-menu" style="overflow: hidden; outline: none;"
                                        tabindex="0">

                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>


                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Дабл</span>
                                <div class="dd-wrapper" id="dd-wrapper-0">
                                    <div id="dd-header-0" class="dd-header"><h6>Back to parent</h6></div>
                                    <ul class="menu-list has-children dd-menu" style="overflow: hidden; outline: none;"
                                        tabindex="0">

                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>


                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="menu-heading underlined">Дуели</span>
                                <div class="dd-wrapper" id="dd-wrapper-0">
                                    <div id="dd-header-0" class="dd-header"><h6>Back to parent</h6></div>
                                    <ul class="menu-list has-children dd-menu" style="overflow: hidden; outline: none;"
                                        tabindex="0">

                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>


                                        <li style="display: list-item;"><a href="animations_css3.html"><i
                                                        class="icon-spinner3 spinner position-left"></i> CSS3 animations</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </li>


            <li>
                <a href="/admin/users">
                    <i class="icon-people position-left"></i>
                   Пользователи

                </a>
            </li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="changelog.html">
                    <i class="icon-history position-left"></i>
                    Changelog
                    <span class="label label-inline position-right bg-success-400">1.3</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog3"></i>
                    <span class="visible-xs-inline-block position-right">Share</span>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="page-container">


    <div class="page-content">


        <div class="content-wrapper">


            @yield('content')


        </div>


    </div>


</div>


<div class="footer text-muted">
    © 2016. ДикиЙ [kudo070]
</div>


</body>
</html>

