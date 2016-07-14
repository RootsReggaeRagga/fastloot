@extends('layout')

@section('content')


    <div class="content">
        <div class="best best-all">
            <div class="titlemain">
                Топ
            </div>
            <div>
                <div class="history-top">
                    <div class="tab-controls">
                        <ul class="tab-controls-list">
                            <li class="tab non-clicked"><span>ТОП игроков за:</span></li>
                            <li class="tab" data-type="24h"><span>24 часа</span></li>
                            <li class="tab" data-type="7d"><span>7 дней</span></li>
                            <li class="tab current" data-type="30d"><span>30 дней</span></li>
                        </ul>
                    </div>
                </div>
                <div class="infos" style="display: block;">
                    <div class="infos-columns">
                        <div class="column-25">
                            <div class="column-inner">
                                <div class="infos-item">
                                    <div class="infos-item-value all-users">{{$ladder->alluser}}</div>
                                    <div class="infos-item-title">Игроков в рейтинге</div>
                                </div>
                            </div>
                        </div>
                        <div class="column-25">
                            <div class="column-inner">
                                <div class="infos-item">
                                    <div class="infos-item-value max-prize-today">{{$ladder->moneytoday}} руб.</div>
                                    <div class="infos-item-title">Макс. выигрыш сегодня</div>
                                </div>
                            </div>
                        </div>
                        <div class="column-25">
                            <div class="column-inner">
                                <div class="infos-item">
                                    <div class="infos-item-value games-today">{{$ladder->gametoday}}</div>
                                    <div class="infos-item-title">Сегодня игр</div>
                                </div>
                            </div>
                        </div>
                        <div class="column-25">
                            <div class="column-inner">
                                <div class="infos-item">
                                    <div class="infos-item-value users-today">{{  $ladder->unqiuser}}</div>
                                    <div class="infos-item-title">Сегодня уникальных игроков</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="history-placeholder" style="display: none;"><span>Загрузка...</span></div>
                <div class="ladder" style="display: block;">
                    <div class="best-content">
                        <div class="def-table best-table">
                            <table>
                                <thead>
                                <tr>
                                    <th class="col-place"><span>Место</span></th>
                                    <th class="col-image"></th>
                                    <th class="col-rank"></th>
                                    <th class="col-nick">Ник в Steam</th>
                                    <th class="col-wincount">Количество побед</th>
                                    <th class="col-prize">Выиграл</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ladder as $i)
                                    <tr>
                                        <td class="col-place">{{$i->place}}</td>
                                        <td class="col-image"><img
                                                    src="{{$i->avatar}}"
                                                    alt="image"></td>
                                        <td class="col-rank"><img src="/template/img/rank/{{$i->rank}}.png" alt="image">
                                        </td>
                                        <td class="col-nick">{{$i->username}}</td>
                                        <td class="col-wincount">{{$i->wins_count}}</td>
                                        <td class="col-prize">{{ round($i->top_value) }} руб.</td>
                                    </tr>
                                @endforeach
                                @if(!Auth::Guest())
                                    @foreach($ladder as $i)
                                        @if($i->userid == $u->id and $i->id > 50)
                                            <tr class="player-selected">
                                                <td class="col-place">{{$i->place}}</td>
                                                <td class="col-image"><img
                                                            src="{{$i->avatar}}"
                                                            alt="image"></td>
                                                <td class="col-rank"><img src="/template/img/rank/{{$i->rank}}.png"
                                                                          alt="image"></td>
                                                <td class="col-nick">{{$i->username}}</td>
                                                <td class="col-wincount">{{$i->wins_count}}</td>
                                                <td class="col-prize">{{ round($i->top_value) }} руб.</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="best-all-bg-left" style="height: 186px"></div>
                            <div class="best-all-bg-right" style="height: 186px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection