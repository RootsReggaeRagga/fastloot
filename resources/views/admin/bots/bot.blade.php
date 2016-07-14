@extends('admin')

@section('content')






    <div class="top-bar">
        <h3>Настройки сайта</h3>

    </div>



    <div class="well panel-body">

        <!-- Forms: Form -->
        <form method="post" action="/admin/bot/{{$bots->id}}" class="form-horizontal">


            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Ник в стиме</label>
                <div class="controls">
                    <input type="text" name="nick" value="{{$bots->nick}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Ник в стиме</span>
                </div>
            </div>

            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Логин</label>
                <div class="controls">
                    <input type="text" name="accountName" value="{{$bots->accountName}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Логин в стиме</span>
                </div>
            </div>

            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Пароль</label>
                <div class="controls">
                    <input type="password" name="password" value="{{$bots->password}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Пароль в стиме</span>
                </div>
            </div>

            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Shared</label>
                <div class="controls">
                    <input type="text" name="shared" value="{{$bots->shared}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Shared key для входа первого входа в стим</span>
                </div>
            </div>


            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">Trade</label>
                <div class="controls">
                    <input type="text" name="trade" value="{{$bots->trade}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">Trade key для трейда в стиме</span>
                </div>
            </div>



            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">steamguard</label>
                <div class="controls">
                    <input type="text" name="steamguard" value="{{$bots->steamguard}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">steamguard в стиме</span>
                </div>
            </div>


            <!-- Forms: Normal input field -->
            <div class="control-group">
                <label class="control-label" for="inputNormal">token</label>
                <div class="controls">
                    <input type="text" name="token" value="{{$bots->token}}" placeholder="..."
                           class="form-control">
                    <span class="help-inline">token в стиме</span>
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