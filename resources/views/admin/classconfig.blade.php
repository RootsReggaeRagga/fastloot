@extends('admin')

@section('content')




    <div class="top-bar">
        <h3>Настройки сайта</h3>

    </div>



    <div class="well panel-body">

        <!-- Forms: Form -->
        <form method="post" action="/admin/classconfig" class="form-horizontal">


            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Макс.</label>
                <div class="controls">
                    <input type="text" name="MAX_ITEMSALL" value="{{$config->MAX_ITEMSALL}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Максимально вещей в игре</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputNormal">Макс.</label>
                <div class="controls">
                    <input type="text" name="MIN_USERS" value="{{$config->MIN_USERS}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Минимально игроков для начала игры</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputNormal">Макс.</label>
                <div class="controls">
                    <input type="text" name="MIN_PRICE" value="{{$config->MIN_PRICE}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Минимальная ставка</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputNormal">Макс.</label>
                <div class="controls">
                    <input type="text" name="MAX_ITEMS" value="{{$config->MAX_ITEMS}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Максимальное кол-во предметов в ставке</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputNormal">Комиссия.</label>
                <div class="controls">
                    <input type="text" name="COMMISSION" value="{{$config->COMMISSION}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Комиссия</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputNormal">Комиссия.</label>
                <div class="controls">
                    <input type="text" name="COMMISSION_FOR_FIRST_PLAYER" value="{{$config->COMMISSION_FOR_FIRST_PLAYER}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Комиссия для первого игрока сделавшего ставку. </span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputNormal">APPID.</label>
                <div class="controls">
                    <input type="text" name="maxprice" value="{{$config->APPID}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">AppID игры: 570 - Dota2, 730 - CS:GO</span>
                </div>
            </div>


            <!-- Forms: Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>

            </div>
            <!-- / Forms: Form Actions -->

        </form>
        <!-- / Forms: Form -->


        <!-- / Add News: WYSIWYG Edior -->

    </div>
    <!-- / Add News: Content -->




    </div>

    </div>



@endsection