@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card bg-dark text-light  border-green">
                    <div class="card-header"><h4>{{ __('Список пользователей') }}</h4></div>
                    <div class="card-body">

                        <div class="row-md-12">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a href="{{ route('admin.create_user_page') }}" class="text-success"><i
                                        class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a>

                                <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="users_search"
                                       class="form-control"
                                       placeholder="Search"
                                       aria-label="Search" onkeyup="filter_users()"/>

                            </div>
                            <p>
                            <table class="table  bg-light text-dark">
                                <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Роль</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Тип</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody id="users_table" >
                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $user->name .' '.$user->middlename.' '.$user->surname}}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->status->name }}</td>
                                        <td>{{App\Models\User::types_label[$user->type_name]}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn-group">
                                                    <a href="{{route('user.profile',['id'=>$user->id ])}}" type="button"
                                                       class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('admin.edit_user_page',['id'=>$user->id ])}}"
                                                       type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <a onclick="document.getElementById('delete({{$user->id}})').submit();"
                                                       class="btn btn-danger"><i
                                                            class="fa fa-trash "></i></a>
                                                </div>

                                                <form class="d-none" id="delete({{$user->id}})"
                                                      action="{{ route('admin.delete_user',['id'=>$user->id ]) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                        function filter_users() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue, show;
                            input = document.getElementById("users_search");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("users_table");
                            tr = table.getElementsByTagName("tr");
                            show = false;
                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td");
                                for (j = 0; j < td.length; j++) {
                                    if (td[j]) {
                                        txtValue = td[j].textContent + td[j].innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            show = true;
                                        }
                                    }
                                }
                                if (show) tr[i].style.display = "";
                                else tr[i].style.display = "none";
                                show = false;
                            }

                        }
                    </script>
                </div>


            </div>
        </div>
        <div class="row justify-content-left mt-2">
            <div class="col-md-12">
                <div class="card bg-dark text-light  border-green">
                    <div class="card-header"><h4>{{ __('Список направлений') }}</h4></div>
                    <div class="card-body">
                        <div class="row-md-12">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a href="{{ route('admin.competition_form') }}" class="text-success"><i
                                        class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a>

                                <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="competitions_search"
                                       class="form-control"
                                       placeholder="Search"
                                       aria-label="Search" onkeyup="filter_competitions()"/>

                            </div>
                            <p>
                            <table  class="table  bg-light text-dark">
                                <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Тип участника</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody id="competitions_table">

                                @foreach($competitions as $key =>$competition)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $competition->name }}</td>
                                        <td>{{$competition->status()['label']}}</td>
                                        <td>{{App\Models\User::types_label[$competition->user_type]}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn-group">
                                                    <a href="{{route('admin.hold_competition_form',['id'=>$competition->id])}}"
                                                       type="button"
                                                       class="btn btn-warning">
                                                        <i class="fa fa-calendar-plus-o"></i>
                                                    </a>
                                                    <a href="{{route('competition',['id'=>$competition->id])}}"
                                                       type="button"
                                                       class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('admin.competition_form',['id'=>$competition->id])}}"
                                                       type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <a onclick="document.getElementById('deleteCompetitionForm').submit();"
                                                       class="btn btn-danger"><i
                                                            class="fa fa-trash "></i></a>
                                                </div>

                                                <form class="d-none" id="deleteCompetitionForm"
                                                      action="{{ route('admin.delete_competition',['id'=>$competition->id]) }}"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                        function filter_competitions() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue, show;
                            input = document.getElementById("competitions_search");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("competitions_table");
                            tr = table.getElementsByTagName("tr");
                            show = false;
                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td");
                                for (j = 0; j < td.length; j++) {
                                    if (td[j]) {
                                        txtValue = td[j].textContent + td[j].innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            show = true;
                                        }
                                    }
                                }
                                if (show) tr[i].style.display = "";
                                else tr[i].style.display = "none";
                                show = false;
                            }



                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
