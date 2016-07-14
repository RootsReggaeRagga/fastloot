@if(!\Request::ajax())
    <html>
    <head>

        <meta charset="utf-8">
        <title>FASTLOOT.ME- TRY YOUR LUCK!</title>
        <meta name="keywords" content="counter strike cs go betting luck bets skins csgo skins cs go fast csgofast gofast">
        <meta name="description" content="Service where CS:GO players can try their luck and get awesome skins! Just deposit your skins to the raffle, become a winner and sweep the board!">
        <meta name="viewport" content="width=1180">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="theme-color" content="black">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <meta name="csrf-token" content="{!!  csrf_token()   !!}">
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:700,400,500|italic,700,500" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('template/js/all-7574fcd097.js') }}"></script>
        @if(!Auth::guest())
            <script>
                $('body').ready(function () {
                    $("#depositsite").animatedModal({
                        animatedIn: 'zoomIn',
                        animatedOut: 'bounceOut', color: 'rgba(17, 28, 42, 0.97)'
                    });
                });
                const USER_SECRET = '{{hash('SHA224', $u->steamid64) }}';
                const USER_ID = '{{ $u->steamid64 }}';
            </script>
        @endif
        <script type="text/javascript" src="{{ asset('template/js/app.js') }}"></script>

    </head>
    <body>


    <body class="chat-hidden"><!-- wrapper -->
    <header>
        <div class="top">
            <div class="left">
                @if(!Auth::guest())
                    <div class="profile">
                        <a href="/user/{{$u->id}}" onclick="Page.Go(this.href); return false;">
                            <img src="{{$u->avatar}}">
                        </a>
                        <a href="/user/{{$u->id}}" onclick="Page.Go(this.href); return false;">
                            <div class="name">{{$u->username}}</div>
                        </a>
                        <a href="/logout" class="exit">Выход</a>
                    </div>
                    <div class="profile_trade">
                        <div class="wrap-input"><input type="text" id="par2" name="par2" value="{{$u->trade_link}}" placeholder="Введите ссылку на трейдоффер">
                        </div>
                        <div class="save_trade"><span>ОК</span><a href="https://steamcommunity.com/id/gaben/tradeoffers/privacy#trade_offer_access_url" target="_blank">?</a></div>
                    </div>
                @endif
            </div>
            @if(Auth::guest())
                <div class="auth"><a href="/login">Авторизоваться через STEAM</a></div>
            @endif

            <div class="lang right">
                <div class="sound-toggle sound-sprite middle-block header-right-item"></div>
                <a href="/postLang/ru" class="flag flag-ru" data-lang="ru"></a>
                <a  href="/postLang/en" class="flag flag-en" data-lang="en"></a>
            </div>
        </div>

    </header>
    <div class="wrapper"><!-- header -->
            <div class="stats">
                <ul class="left">
                    <a href="/" onclick="Page.Go(this.href); return false;">Главная</a>
                    <a href="/history" onclick="Page.Go(this.href); return false;">История</a>
                    <a href="/ladder" onclick="Page.Go(this.href); return false;">Топ</a>
                    <a href="/faq" onclick="Page.Go(this.href); return false;">О сайте</a>
                </ul>
                <ul class="right">
                    <li><b id="online">0</b><span>Онлайн на сайте</span></li>
                    <li><b id="maxwin">0</b>Р<span>Макс. Выигрыш</span></li>
                    <li><b id="usertoday">0</b><span>Игроков сегодня</span></li>
                    <li><b id="gametoday">0</b><span>Игр сегодня</span></li>
                </ul>
            </div>
            <div id="main">
                @endif
                @yield('content')
                @if(!\Request::ajax())
            </div>
        </div>
        <div class="chat-wrapper">
            <div class="chat">
                <div class="chat-top-placeholder">
                    <div class="chat-show-button">
                        <div class="chat-icon"></div>
                        <div class="title">Чат</div>
                    </div>
                    <div class="chat-hide-button">
                        <div class="chat-icon"></div>
                    </div>
                </div>
                <div class="chat-header">
                    <div class="chat-icon"></div>
                    <div class="title"><span>Чат</span> - <span class="room-name">Roulette</span></div>
                    <div class="controls">
                        <div class="hide-chat">
                            <span class="underscore"></span>
                        </div>
                    </div>
                </div>
                <div class="chat-body">

                    <div id="common-messages"></div>
                    <div class="chat-scroll"></div>
                </div>
                <div class="chat-footer">
                    <div class="chat-ban" style="display: none;">
                        <span>Вы забанены. Причина:</span> <span class="chat-ban-reason"></span>.
                        <br><span>Осталось:</span>
                        <span class="ban-end-timestamp"></span>
                    </div>
                    <div class="chat-not-auth" style="display: none;">
                        Чтобы писать сообщения необходимо авторизоваться.
                    </div>
                    <div class="chat-not-play-any-game" style="display: none;">
                        Только учавствовшие в игре игроки могут писать.
                    </div>
                    <form class="message-block" onsubmit="return false;" style="display: block;">
                        <div class="message-wrapper">
                            <input type="text" maxlength="100" class="new-message-input"
                                   placeholder="Введите сообщение...">
                        </div>
                        <!--<div class="smiles-button"></div>
                        <div class="smiles-container"></div>-->
                        <input type="submit" class="send-message" value="OK">
                    </form>
                </div>
            </div>
        </div>

        <footer>
            <div class="left">
                <b>FASTLOOT.ME - Уникальная система игр.</b>
                Победитель определяется независимым сервисом генерации случайных чисел Random.org Комиссия сервиса –
                10%
            </div>
            <div class="right"></div>
        </footer>
    </div>


    @if(!Auth::guest())
        <div id="animatedModal">
            <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID -->
            <div id="btn-close-modal" class="close-animatedModal">
                Закрыть окно
            </div>

            <div class="modal-content">
                <div class="inventory">
                    <div class="items">

                    </div>
                    <div class="info">Выбрано <span class="countitem">0</span> предметов из <span>25</span> на сумму
                        <span class="price">0</span>Р
                    </div>
                    <div class="deposit"><span>Внести</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    </body>

    </body>
    </html>
@endif