@foreach($history as $game)
<div class="history-item">
    <div class="history-item-top">
        <div class="history-item-top-left">
            <div class="history-item-top-right">
                <a onclick="Page.Go(this.href); return false;" href="/game/{{$game->id}}">К ИГРЕ</a>
            </div>
            <div class="gamenum">Игра №<a onclick="Page.Go(this.href); return false;" href="/game/{{$game->id}}">{{$game->id}}</a></div>
            <div class="history-winner-avatar" style="background-image: url({{$game->winner->avatar}}});"></div>
            <div class="history-item-winner-name">
                {{$game->winner->username}}
            </div>
            <ul class="history-item-desc-list">
                <li class="price">
                    {{$game->price}} руб.
                </li>
                <li class="chance">
                    {{$game->percent}}%
                </li>
            </ul>
        </div>
    </div>

</div>
@endforeach