<div class="gameinf">
    <div class="left">
        <ul class="room">
            <li data-room-name="roulette">ROULETTE</li>
            <li>DOUBLE<span>(Скоро)</span></li>
            <li>1VS1<span>(Скоро)</span></li>
        </ul>
        @if(isset($last))
            <div class="last-winener">
                <div class="title">{{ trans('lang.lastwinner') }}</div>
                <img class="avatar" src="{{$last->last_winner->avatar}}">
                <ul>
                    <li class="name">{{$last->last_winner->username}}</li>
                    <li class="price">{{ trans('lang.win') }}<span>{{ $happy->last_winner->money}}р</span></li>
                    <li class="chance">{{ trans('lang.shance') }}<span>{{ $happy->last_winner->percent}}%</span></li>
                </ul>
            </div>
        @endif
    </div>
    <div class="gamenum">
        {{ trans('lang.gamenum') }}<span class="game-num">{{$game->id}}</span>
    </div>
    <div class="timgm">
        <div class="numitem"><span>{{$game->items}}/50</span>{{ trans('lang.itemcss') }}</div>
        <!-- timer -->
        <div class="timer">
            <div class="countdownHolder">
                <span class="countMinutes">
                    <span class="position">
                        <span class="digit static" style="top: 0px; opacity: 1; transition: none;">0</span>
                    </span>
                    <span class="position">
                        <span class="digit static" style="top: 0px; opacity: 1; transition: none;">0</span>
                    </span>
                </span>
                <span class="countDiv countDiv0">:</span>
                <span class="countSeconds">
                    <span class="position">
                        <span class="digit static" style="top: 0px; opacity: 1; transition: 350ms ease;">3</span>
                    </span>
                    <span class="position">
                        <span class="digit" style="top: 0px; opacity: 1; transition: 350ms ease;">5</span>
                    </span>
                </span>
            </div>
        </div>
        <!-- timer end -->

        <div class="bank"><span id="roundBank">{{round($game->price)}}Р</span>{{ trans('lang.bank') }}</div>
    </div>

    <div id="items-circle">
        <script>
            var items_circle = new ProgressBar.Circle('#items-circle', {
                color: '#5CBA51',
                strokeWidth: 8,
                trailWidth: 8,
                trailColor: 'rgba(214, 192, 174, 0.0470588)'
            });
            skins_count = +{{ $game->items }} > 50 ? 50 : +{{ $game->items }};
            items_circle.animate(skins_count / 50);
            @if(!Auth::guest())
            $('body').ready(function () {
                $("#depositsite").animatedModal({
                    animatedIn: 'zoomIn',
                    animatedOut: 'bounceOut', color: 'rgba(17, 28, 42, 0.97)'
                });
            });
            my_inventory();
            my_inventory_tosite();
            @endif
        </script>
    </div>
    @if(!Auth::guest())
        <div class="right">
            <div class="inventory">
                <div class="items">

                </div>
                <div class="info">{{ trans('lang.s1') }} <span class="countitem">0</span>{{ trans('lang.s2') }}<span>0</span>{{ trans('lang.s3') }}<span class="price">0</span>Р
                </div>
                <div class="deposit"><a id="depositsite" class="depositsite" href="#animatedModal">+
                        {{ trans('lang.s4') }}</a><span>{{ trans('lang.s5') }}</span><span>Вывести</span>
                </div>
            </div>
        </div>
    @endif
</div>


<div class="content">

    <div class="addnick">
        <div class="info">
            <div class="left">{{ trans('lang.s6') }}<span>FASTLOOT.ME</span>{{ trans('lang.s7') }}<span>{{ trans('lang.s8') }}</span></div>
            <div class="left">{{ trans('lang.s9') }}<span>{{ trans('lang.s10') }}</span></div>
            <div class="left">{{ trans('lang.s11') }}<span>1 руб.</span></div>
        </div>
    </div>

    <div class="game-end @if(count($percents) == 0) hidden @endif">
        <div class="all-players">
            <div class="all-players-list">
                @foreach($percents as $p)
                    <li><img src="{{ $p->avatar }}"><span>{{ $p->chance }}%</span></li>
                @endforeach
            </div>
        </div>
        <div class="wininfo hidden">Победитель<span class="name">???</span> Выигрыш<span
                    class="price">???</span>Шанс<span class="chance">???</span>Победная вещь<span
                    class="itemwin">???</span></div>
    </div>
    <div id="items-container">
        <!-- ставки -->
        @foreach($bets as $bet)
        @include('includes.bet')
        @endforeach
                <!-- ставки -->
    </div>


</div>