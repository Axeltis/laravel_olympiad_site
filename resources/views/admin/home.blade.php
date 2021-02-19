@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-light">
                    <div class="card-header">{{ __('Список пользователей') }}</div>
                    <div class="card-body">

                        <div class="row-md-12">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <a href="{{ route('admin.create_user_page') }}" class="text-success"><i
                                        class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a>

                                <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="search"
                                       class="form-control"
                                       placeholder="Search"
                                       aria-label="Search" onkeyup="Filter()"/>

                            </div>
                            <p>

                            <table id="table" class="table  bg-light text-dark">
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
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $user->name .' '.$user->middlename.' '.$user->surname}}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->status->name }}</td>
                                        <td>{{ $user->type_label[$user->type()] }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn-group">
                                                    <a href="{{route('user.profile',['id'=>$user->id])}}" type="button"
                                                       class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('admin.edit_user_page',['id'=>$user->id])}}"
                                                       type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <a onclick="document.getElementById('deleteForm').submit();"
                                                       class="btn btn-danger"><i
                                                            class="fa fa-trash "></i></a>
                                                </div>

                                                <form class="d-none" id="deleteForm"
                                                      action="{{ route('admin.delete_user',['id'=>$user->id]) }}"
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function Filter() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue,show;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");
            show = false;
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent + td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            show=true;
                        }
                    }
                }
                if(show) tr[i].style.display = "";
                else  tr[i].style.display = "none";
                show=false;
            }
        }
    </script>
@endsection
