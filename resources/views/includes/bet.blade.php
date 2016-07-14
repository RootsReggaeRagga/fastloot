<div class="short-g"  id="bet_{{ $bet->id }}">
    <div class="top"><img
                src="{{ $bet->user->avatar }}" alt="{{ $bet->user->steamid64 }}" title="">
        <ul>
            <li><a href="http://steamcommunity.com/profiles/{{ $bet->user->steamid64 }}" target="_blank">{{ $bet->user->username }}</a> внёс {{ $bet->itemsCount }} {{ trans_choice('lang.items', $bet->itemsCount) }}</li>
        </ul>
        <ul class="right">
            <li class="money">{{ $bet->price }}Р</li>
            <li class="user-chance chance_{{ $bet->user->steamid64 }}">{{ \App\Http\Controllers\GameController::_getUserChanceOfGame($bet->user, $bet->game) }}%</li>
            <li class="blanks">Билеты от <span class="from price">#{{ $bet->from }}</span> до <span class="to price">#{{ $bet->to }}</span></li>
        </ul>
    </div>
    <div class="items">
        @foreach(json_decode($bet->items) as $i)
        <div class="itm"><img class="tooltip" src="https://steamcommunity-a.akamaihd.net/economy/image/class/730/{{$i->classid}}/60fx60f"  title="{{$i->name}}" alt="">
            <div class="price {{$i->rarity}} tooltip" title="Билеты: от #{{ $i->from }} до
                    #{{ $i->to }}">{{$i->price}} р.</div>
        </div>
        @endforeach
    </div>
</div>
