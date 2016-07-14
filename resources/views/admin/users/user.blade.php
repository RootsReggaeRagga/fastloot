@extends('admin')

@section('content')



    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/ui/fullcalendar/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/plugins/visualization/echarts/echarts.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/template/admin/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/admin/js/pages/user_pages_profile.js') }}"></script>

    <div class="profile-cover">
        <div class="profile-cover-img"></div>
        <div class="media">
            <div class="media-left">
                <a href="//steamcommunity.com/profiles/{{$user->steamid64}}" target="_blank" class="profile-thumb">
                    <img src="{{$user->avatar}}" class="img-circle" alt="">
                </a>
            </div>

            <div class="media-body">
                <h1>{{$user->username}}<small class="display-block">{{$user->username}}</small></h1>
            </div>

            <div class="media-right media-middle">
                <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                    <li><a href="//steamcommunity.com/profiles/{{$user->steamid64}}" target="_blank"  class="btn btn-default"><i class="icon-file-picture position-left"></i>Перейти в стим</a></li>
                    <li><a href="/{{$user->tread_link}}" target="_blank"  class="btn btn-default"><i class="icon-file-stats position-left"></i> Трейд ссылка</a></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="navbar navbar-default navbar-xs navbar-component no-border-radius-top">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-menu7 position-left"></i> Активность</a></li>
                <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Настройки</a></li>
            </ul>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="#schedule" data-toggle="tab"><i class="icon-cash position-left"></i> Баланс <span class="badge badge-success badge-inline position-right">{{$u->money}}</span></a></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="tabbable">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="activity">

                <!-- Timeline -->
                тут таблтца
                <!-- /timeline -->

            </div>



            <div class="tab-pane fade" id="settings">

                <!-- Profile info -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Настройки профиля</h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a><a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

                    <div class="panel-body">
                        <form method="post" action="/admin/userdit">
                            <input  name="id" value="{{$user->id}}"  type="hidden">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ник</label>
                                        <input type="text" readonly="readonly" value="{{$user->username}}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>STEAMID64</label>
                                        <input type="text" readonly="readonly" value="{{$user->steamid64 }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Трейд ссылка</label>
                                        <input type="text"  name="trade_link" value="{{$user->trade_link}}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Баланс</label>
                                        <input type="text" name="money" value="{{$user->money}}" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Админ</label>
                                        <select class="select" name="is_admin">
                                            <option value="1" @if($user->is_admin == 1) selected @endif>Да</option>
                                            <option value="0" @if($user->is_admin == 0) selected @endif>Нет</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Саппорт</label>
                                        <input type="text" value="{{$user->money}}" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Бан в чате</label>
                                        <select class="select" name="banned">
                                            <option value="1" @if($user->banchat == 1) selected @endif>Забанить</option>
                                            <option value="0" @if($user->banchat == 0) selected @endif>Пусть живёт</option>
                                        </select>

                                    </div>
                                </div>
                            </div>




                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Сохранить <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>







            </div>
        </div>
    </div>

@endsection