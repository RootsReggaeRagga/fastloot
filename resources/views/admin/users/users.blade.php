@extends('admin')

@section('content')

        <!-- Theme JS files -->
<script type="text/javascript" src="{{ asset('/template/admin/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/template/admin/js/plugins/forms/selects/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/template/admin/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('/template/admin/js/pages/datatables_basic.js') }}"></script>
<!-- /theme JS files -->


<!-- Basic datatable -->
<div class="panel panel-flat">



    <table class="table datatable-basic">
        <thead>
        <tr>
            <th>#</th>
            <th>Ник</th>
            <th>STEAMID64</th>
            <th>Профиль стим</th>
            <th>Трейд ссылка</th>
            <th>Админ</th>
            <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Настройки" style="width: 100px;">Настройки</th>
        </tr>
        </thead>
        <tbody>
      @foreach($user as $i)
        <tr>
            <td>{{$i->id}}</td>
            <td>{{$i->username}}</td>
            <td>{{$i->steamid64}}</td>
            <td><a href="//steamcommunity.com/profiles/{{$i->steamid64}}" target="_blank">Перейти в профиль</a></td>
            <td>@if($i->trade_link)<a href="{{$i->trade_link}}"  target="_blank">Трейд</a>@else <span class="label label-danger">Нету</span> @endif</td>
            <td>@if($i->is_admin)<span class="label label-danger">Да</span> @else <span class="label label-danger">Нет</span> @endif</td>
            <td class="text-center">
                <ul class="icons-list">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="/admin/user/{{$i->id}}"><i class="icon-file-pdf"></i>Редактировать</a></li>

                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
          @endforeach
        </tbody>
    </table>
</div>
<!-- /basic datatable -->

@endsection