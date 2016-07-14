@extends('layout')

@section('content')



<div class="content">


    <div class="end-game">


        <div class="bottom-game">
            <div class="us-win">
                <ul>
                    <li>Победный билет:<span>{{ $game->number }}</span></li>
                    <li>Выигрыш: <span>{{ $game->price }}</span></li>
                </ul>
                <img src="{{$game->winner->avatar}}" class="avatar"></img>

            </div>



            <div class="blk-win">
                <form action='https://api.random.org/verify' method='post' target="_blank">
                    <input type='hidden' name='format' value='json'/>
                    <input type='hidden' name='random' value='{{$game->random}}'/>
                    <input type='hidden' name='signature' value='{{$game->signature}}'/>
                    <button type="submit"
                            class="btn btn-white btn-sm btn-right">Проверить на RANDOM.ORG</button>
                </form>
            </div>

            <div class="part">
                @foreach($percents as $p)
                    <li><img src="{{ $p->avatar }}"><span>{{ $p->chance }}%</span></li>
                @endforeach
            </div>
        </div>


        <div id="items-container">
            @foreach($bets as $bet)
                @include('includes.bet')
            @endforeach
        </div>


    </div>
</div>

@endsection