<div>
    <div class="duel-room">
        <div class="room-header noselect">
            <div class="description">
                <div class="description-item">
                    <h4>Правила игры:</h4>
                    <div class="description-text">Дуэль - режим игры где все решает оружие! Сделай выбор и победи
                        соперника. <span id="inf" class="more" style="display: inline">Подробнее ></span></div>
                </div>
                <div class="description-item-tutorial hidden">
                    <div class="tutorial-item middle-block">
                        <span class="tutorial-weapon automaton"></span><span
                                class="tutorial-text">AK-47 побеждает НОЖ</span><span
                                class="tutorial-weapon knife"></span>
                    </div>
                    <div class="tutorial-item middle-block">
                        <span class="tutorial-weapon knife"></span><span
                                class="tutorial-text">НОЖ побеждает AWP</span><span
                                class="tutorial-weapon sniper"></span>
                    </div>
                    <div class="tutorial-item middle-block">
                        <span class="tutorial-weapon sniper"></span><span
                                class="tutorial-text">AWP побеждает AK-47</span><span
                                class="tutorial-weapon automaton"></span>
                    </div>
                </div>
            </div>
            <div class="not-auth-placeholder" style="display: none;">
                <span class="middle-block">Авторизируйся, чтобы испытать удачу</span>
                <a href="https://server02.csgofast.com/auth" class="btn-yellow action-login middle-block">
                    <span class="icon-steam"></span><span class="text">Войти через STEAM</span>
                </a>
            </div>
            <div class="bet-block" style="display: block;">
                <div class="bet-value-container middle-block">
                    <label class="place-bet-text">Сделай ставку:</label>
                    <div class="input-container middle-block">
                        <input class="bet-value-input" type="text" placeholder="1000">
                        <div class="error coins-not-enough">
                            <div class="error-text">Недостаточно средств на счете</div>
                            <a class="refill-link" href="javascript:;">Пополнить баланс</a>
                        </div>
                    </div>
                </div>
                <div class="duel-weapons-container middle-block">
                    <span class="choose-weapon-text">Выбери оружие:</span>
                    <div class="duel-weapons middle-block">
                        <div data-weapon="1" data-weapon-name="AK47" class="duel-weapon automaton"></div>
                        <div data-weapon="3" data-weapon-name="Knife" class="duel-weapon knife"></div>
                        <div data-weapon="2" data-weapon-name="AWP" class="duel-weapon sniper"></div>
                    </div>
                </div>
                <div class="btn-yellow bet-button middle-block disabled">Создать игру</div>
            </div>
        </div>

        <div class="duel-view-game">
            <div class="duel-game">
                <div class="game-header">
                    <div class="first-player middle-block">
                        <div class="ava middle-block"></div>
                        <div class="name middle-block"></div>
                        <div class="bet-weapon middle-block">
                            <div class="bet-weapon-icon in-progress"></div>
                            <svg class="bonus-game-timer-svg" width="50" height="50" viewport="0 0 10 10" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle class="circle-placeholder" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                                <circle class="circle-bar in-progress" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="game-state middle-block">
                        <div class="new">
                            <span class="middle-block">Ставка:</span>
                            <span class="coins-value bet middle-block">0</span>
                        </div>
                        <div class="in-progress">
                            <span class="middle-block">На кону:</span>
                            <span class="coins-value total middle-block">0</span>
                        </div>
                        <div class="win">
                            <span class="middle-block">Выигрыш:</span>
                            <span class="coins-value total middle-block">0</span>
                        </div>
                        <div class="draw">
                            <span>Ничья</span>
                        </div>
                    </div>
                    <div class="second-player middle-block">
                        <div class="bet-weapon middle-block">
                            <div class="bet-weapon-icon in-progress"></div>
                            <svg class="bonus-game-timer-svg" width="50" height="50" viewport="0 0 10 10" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle class="circle-placeholder" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                                <circle class="circle-bar in-progress" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                            </svg>
                        </div>
                        <div class="name middle-block"></div>
                        <div class="ava middle-block"></div>
                    </div>
                </div>
                <div class="game-field">
                    <div class="find-rival">
                        <div class="first-player middle-block"></div>
                        <div class="middle-block">VS</div>
                        <div class="second-player-roulette-container middle-block">
                            <div class="roulette-container">

                            </div>
                        </div>
                    </div>

                    <div class="rival-waiting">
                        <div class="bonus-game-timer" data-left-seconds="15">
                            <svg class="bonus-game-timer-svg" width="226" height="226" viewport="0 0 100 100"
                                 version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <circle class="circle-placeholder" r="103" cx="88" cy="112" stroke-dasharray="646.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                                <circle class="circle-bar" r="103" cx="88" cy="112" stroke-dasharray="646.48"
                                        stroke-dashoffset="0" fill="transparent"></circle>
                            </svg>
                        </div>
                    </div>

                    <div class="fight">
                        Fight
                    </div>

                    <div class="finish">
                        <div class="duel-finish-weapon first-player-weapon"></div>
                        <div class="duel-finish-weapon second-player-weapon"></div>

                        <div class="result-container">
                            <div class="result win">Вы победили</div>
                            <div class="result loss">Вы проиграли</div>
                            <div class="result draw">Ничья</div>
                            <div class="result user-win">
                                <div>Выиграл</div>
                                <div class="user-win-ava"></div>
                                <div class="user-win-name"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="game-footer noselect">
                    <div class="new">
                        <div class="waiting-info">
                            <div class="time-after-create"></div>
                            <div class="time-for-find-rival-container">
                                Примерное время ожидания
                                <span class="time-for-find-rival">&lt; <span class="time"></span> мин.</span>
                            </div>
                        </div>
                        <button class="btn-yellow disabled cancel-button">Отменить игру <span class="time-left"></span>
                        </button>
                    </div>
                    <div class="in-progress">
                        <div class="self">
                            Ожидание соперника...
                        </div>
                        <div class="rival">
                            <div class="weapon-notification middle-block">
                                Если ты не успеешь выбрать оружие оно будет выбрано автоматически.
                            </div>
                            <div class="duel-weapons-container middle-block">
                                <div class="duel-weapons middle-block">
                                    <div data-weapon="1" data-weapon-name="AK47" class="duel-weapon automaton"></div>
                                    <div data-weapon="3" data-weapon-name="Knife" class="duel-weapon knife"></div>
                                    <div data-weapon="2" data-weapon-name="AWP" class="duel-weapon sniper"></div>
                                </div>
                            </div>
                            <div class="btn-yellow disabled ready-button middle-block">Готов</div>
                        </div>
                    </div>
                    <div class="win">
                        <button class="btn-yellow-inside exit-button">Выйти</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="duel-games-container">
            <div>
                <div class="duel-game new-game" style="display: block;">
                    <div class="game-header">
                        <div class="first-player middle-block">
                            <div class="ava middle-block"
                                 style="background-image: url(&quot;https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/b0/b0391a22ce041d79be4a18ba22e12bad2f0a73b6_full.jpg&quot;);"></div>
                            <div class="name middle-block">csgofast.com</div>
                            <div class="bet-weapon middle-block ">
                                <div class="bet-weapon-icon"></div>
                                <svg class="bonus-game-timer-svg" width="50" height="50" viewport="0 0 10 10"
                                     version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="circle-placeholder" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                            stroke-dashoffset="0" fill="transparent"></circle>
                                    <circle class="circle-bar" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                            stroke-dashoffset="0" fill="transparent"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="game-state middle-block">
                            <div class="new">
                                <div class="at-stake">
                                    <span class="middle-block">На кону:</span>
                                    <span class="coins-value total middle-block">1520</span>
                                </div>
                                <div class="bet">
                                    <span class="middle-block">Ставка:</span>
                                    <span class="coins-value bet middle-block">800</span>
                                </div>
                            </div>
                            <div class="in-progress">
                                <div>
                                    <span class="at-stake middle-block">На кону:</span>
                                    <span class="coins-value total middle-block">1520</span>
                                </div>
                                <a href="javascript:;" class="duel-watch-game">Смотреть игру</a>
                            </div>
                            <div class="win">
                                <span class="middle-block">Выигрыш:</span>
                                <span class="coins-value total middle-block">1520</span>
                            </div>
                            <div class="draw">
                                <div>Ничья</div>
                                <div class="draw-coins">
                                    <span class="middle-block">На кону:</span>
                                    <span class="coins-value total middle-block">1520</span>
                                </div>
                            </div>
                        </div>
                        <div class="second-player middle-block">
                            <div class="bet-weapon middle-block">
                                <div class="bet-weapon-icon"></div>
                                <svg class="bonus-game-timer-svg" width="50" height="50" viewport="0 0 10 10"
                                     version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="circle-placeholder" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                            stroke-dashoffset="0" fill="transparent"></circle>
                                    <circle class="circle-bar" r="18" cx="175" cy="23" stroke-dasharray="565.48"
                                            stroke-dashoffset="0" fill="transparent"></circle>
                                </svg>
                            </div>
                            <div class="name middle-block"></div>
                            <div class="ava middle-block"></div>
                        </div>
                        <button class="btn-yellow-inside btn-duel-accept-challenge noselect"
                                style="display: inline-block;">Принять вызов
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>