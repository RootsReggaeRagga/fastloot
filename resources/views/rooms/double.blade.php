<div class="game bonus-room">
    <div class="game-content">
        <div class="bonus-game-roulette">
            <div class="game-roulette">
                <div>
                    <div class="game-roulette-numbers"
                         style="transition: transform 0s; display: block;transform: rotate3d(0, 0, 1, @if(isset($lastgame)){{$lastgame->position}}@endif deg);"></div>
                    <div class="bonus-game-state-container" style="transition: 0ms ease; transform: rotateY(0deg);">
                        <div class="bonus-game-state bonus-game-timer front" data-left-seconds="40"
                             style="display: block;">
                            <svg class="bonus-game-timer-svg" width="200" height="200"
                                 viewport="0 0 100 100" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle r="65" cx="100" cy="100" stroke-dasharray="565.48"
                                        stroke-dashoffset="0"
                                        style="stroke-dashoffset: 0px; transition: stroke-dashoffset 0.1s linear;"></circle>
                            </svg>
                        </div>
                        <div class="bonus-game-state bonus-game-pre-end back"
                             style="transition: transform 2s; transform: rotateY(180deg)">Розыгрыш
                        </div>
                        <div class="bonus-game-state bonus-game-end back"
                             style="transition: transform 2s;transform: rotateY(180deg);">1
                        </div>
                    </div>
                    <div class="sprite game-roulette-cursor"></div>
                    <div class="sprite game-roulette-cursor-shadow"></div>
                </div>
            </div>

        </div>
        <div class="bonus-game-bet-calc">
            <div>
                <div class="bonus-value-container" @if(Auth::Guest()) style="display: none;" @endif><span>Баланс:</span><span
                            class="bonus-user-value update_balance">@if(!Auth::Guest()) {{$u->money}} @endif</span><span
                            class="sprite add-bonus"></span></div>
                <div class="bonus-game-calc" @if(Auth::Guest()) style="opacity: 0.2;" @endif>
                    <ul class="bonus-game-calc-button-list">
                        <li class="bonus-game-calc-button repeat-bet" data-method="repeat-bet"><span
                                    class="sprite repeat-bet" data-value="0"></span></li>
                        <li class="bonus-game-calc-button clear" data-method="clear"><span
                                    class="sprite clear"></span></li>
                        <li class="bonus-game-calc-button value" data-value="10" data-method="plus">
                            +10
                        </li>
                        <li class="bonus-game-calc-button value" data-value="100" data-method="plus">
                            +100
                        </li>
                        <li class="bonus-game-calc-button value" data-value="1000" data-method="plus">
                            +1K
                        </li>
                        <li class="bonus-game-calc-button value" data-value="10000" data-method="plus">
                            +10K
                        </li>
                        <li class="bonus-game-calc-button value" data-value="2" data-method="multiply">
                            x2
                        </li>
                        <li class="bonus-game-calc-button value" data-value="2" data-method="divide">1/2
                        </li>
                        <li class="bonus-game-calc-button all" data-method="max">Все</li>
                    </ul>
                    <div class="bonus-game-bet-input-container"><input class="bonus-game-bet-input" id="dub-input"
                                                                       value="" placeholder="Введите сумму...">
                    </div>
                    <div class="bonus-game-calc-place-bet-buttons"><p class="place-bet-buttons-text">
                            Поставить:</p>
                        <ul class="place-bet-buttons noselect">
                            <li data-bet-type="red"
                                class="bonus-game-calc-place-bet sprite bonus-red-button noselect">0
                            </li>
                            <li data-bet-type="zero"
                                class="bonus-game-calc-place-bet sprite bonus-zero-button noselect">0
                            </li>
                            <li data-bet-type="black"
                                class="bonus-game-calc-place-bet sprite bonus-black-button noselect">0
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="game-roulette-history">
                    <ul class="game-roulette-history-list"
                        style="transform: translate3d(0px, 0px, 0px); transition: transform 0.5s;">
                        @foreach($games as $i)
                            <li class="game-roulette-history-item {{$i->color}}">{{$i->number}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bonus-game-info">
                    <div class="game-title">
                        №
                        <span class="game-num">{{$double->id}}</span>
                        <a href="#faq/double/3" class="fairplay">Честная игра</a>
                    </div>
                    <div class="game-hash-info">
                        <div>Хэш раунда: <span id="doubroundHash">{{$game->hash}}</span></div>
                        <div>Число раунда: <span id="doubrandNum">скрыто</span></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="game-bets-container">
        <div class="game-bets red">
            <div class="game-bets-header">Общая ставка:<span class="game-bets-value">6446</span></div>
            <ul class="game-bets-list" style="transition: transform 0s; transform: translate3d(0px, 0px, 0px);">
                <li class="bonus-game-bet showed">
                    <div class="bet-user-info">
                        <div class="avatar"
                             style="background-image: url(&quot;https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/8c/8c83fc6af4eaa7a88faa46372cf0289125e6b0a7_full.jpg&quot;);"></div>
                        <div class="user-name">Veggie CSGOFAST.COM</div>
                    </div>
                    <div class="bet-value">16</div>
                </li>
            </ul>
        </div>
        <div class="game-bets zero">
            <div class="game-bets-header">Общая ставка:<span class="game-bets-value">473</span></div>
            <ul class="game-bets-list" style="transition: transform 0s; transform: translate3d(0px, 0px, 0px);">
                <li class="bonus-game-bet showed">
                    <div class="bet-user-info">
                        <div class="avatar"
                             style="background-image: url(&quot;https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/c8/c8fb6c4f20b53da1c60d6045cce553a120a49e1b_full.jpg&quot;);"></div>
                        <div class="user-name">Never Forgetti Spaghetti</div>
                    </div>
                    <div class="bet-value">3</div>
                </li>
            </ul>
        </div>
        <div class="game-bets black">
            <div class="game-bets-header">Общая ставка:<span class="game-bets-value">11199</span></div>
            <ul class="game-bets-list" style="transition: transform 0s; transform: translate3d(0px, 0px, 0px);">
                <li class="bonus-game-bet showed">
                    <div class="bet-user-info">
                        <div class="avatar"
                             style="background-image: url(&quot;https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/c0/c0ae1f2d0943e7ad141aa62a47f17797abecb9bc_full.jpg&quot;);"></div>
                        <div class="user-name">Swagrid</div>
                    </div>
                    <div class="bet-value">4000</div>
                </li>
            </ul>
        </div>
    </div>
</div>