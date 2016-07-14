@extends('layout')

@section('content')

    <div class="content">
        <div class="history tabs-wrap">
            <div class="titlemain">
                История
            </div>
            <div class="history-wrap">
                @include('includes.history')
            </div>
        </div>
    </div>

@endsection