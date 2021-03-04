@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-12">

                <div class="card bg-dark text-light  border-green">
                    <div class="card-header"><h4>{{ __('Список участников') }}</h4></div>
                    <div class="card-body">

                        <div class="row-md-12">


                            <div class="d-flex flex-row bd-highlight mb-3">
                                <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="users_search"
                                       class="form-control"
                                       placeholder="Search"
                                       aria-label="Search" onkeyup="filter_users()"/>

                                <a style="width: 250px" href="{{route('admin.download_all_answers',['holding_id'=>$holding->id])}}"
                                   type="button"
                                   class="btn btn-warning"
                                >Загрузить все ответы <i class="fa fa-download"></i></a>
                            </div>
                            <p>
                            <table class="table  bg-light text-dark">
                                <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">UUID</th>
                                    <th scope="col">ФИО</th>
                                    <th scope="col">Кол-во баллов (MAX:{{$holding->competition->max_points}})</th>
                                    <th scope="col">Скачать файл</th>
                                </tr>
                                </thead>
                                <tbody id="users_table">
                                @foreach($holding->users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td> {{$user->id}}</td>
                                        <td>{{ $user->surname.' '.$user->name .' '.$user->middlename}}</td>
                                        <td>
                                            <form
                                                action="{{ route('admin.estimate_answer',['holding_id'=>$holding->id,'user_id'=>$user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <input style="width: 100px" id="points" name="points"
                                                           value="{{$user->pivot->points}}">

                                                    <div class="input-group-prepend">

                                                        <button type="submit"
                                                                class="btn btn-success"
                                                        ><i class="fa fa-save"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="btn-group">
                                                    <a href="{{route('admin.download_answer',['holding_id'=>$holding->id,'user_id'=>$user->id ])}}"
                                                       type="button"
                                                       class="btn
                                    @if(!Storage::disk('public')->files(App\Models\Competition::answers_folder_path . $holding->id . '/' . $user->id)
                                   )
                                                           disabled
                                                           btn-secondary
                                                           @else
                                                           btn-warning
                                    @endif"
                                                    ><i class="fa fa-download"></i></a>

                                                </div>
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
    </div>
@endsection
