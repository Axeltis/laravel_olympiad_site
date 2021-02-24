@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light  border-green">
                    <div class="card-header"><h4>{{ __('Проведения олимпиады "'.$competition->name).'"' }}</h4></div>
                    <div class="card-body">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <a onclick="set_value(-1)" class="text-success"><i
                                    class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a>

                            <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="holdings_search"
                                   class="form-control"
                                   placeholder="Search"
                                   aria-label="Search" onkeyup="filter_holdings()"/>

                        </div>
                        <p>
                        <table  class="table  bg-light text-dark">

                            <thead class="bg-dark text-light">
                            <tr>
                                <th class="d-none" scope="col">id</th>
                                <th scope="col">№</th>
                                <th scope="col">Дата начала</th>
                                <th scope="col">Дата конца</th>
                                <th scope="col">Кол-во участников</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="holdings_table">
                            @foreach($competition->holdings as $key =>$holding)
                                <tr>
                                    <td class="d-none">{{$holding->id}}</td>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{$holding->start_date }}</td>
                                    <td>{{$holding->end_date}}</td>
                                    <td>{{count($holding->users)}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="btn-group">
                                                <a onclick="set_value({{$key-1}})"
                                                   type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a onclick="document.getElementById('deleteForm').submit();"
                                                   class="btn btn-danger"><i
                                                        class="fa fa-trash "></i></a>
                                            </div>

                                            <form class="d-none" id="deleteForm"
                                                  action="{{ route('admin.delete_holding',['id'=>$holding->id]) }}"
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
                    <script>
                        function filter_holdings() {
                            // Declare variables
                            var input, filter, table, tr, td, i, j, txtValue, show;
                            input = document.getElementById("holdings_search");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("holdings_table");
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
            <div class="col">
                <div class="card bg-dark text-light  border-green">
                    <div class="card-header bg-light text-dark"><h4 id="header">{{ 'Новая запись'}}</h4></div>
                    <div class="card-body">
                        <form id="holdingForm"
                              action="{{ route('admin.hold_competition',['competition_id'=>$competition->id]) }}"
                              method="POST">
                            @csrf
                            <input name="id" id="id" type="hidden"/>
                            @include('components.fields.common_date_picker',['label'=>'Дата начала','value' =>'','field_name'=>'start_date'])
                            @include('components.fields.common_date_picker',['label'=>'Дата конца','value' =>'','field_name'=>'end_date'])

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit"
                                            class="btn btn-success rounded-pill align-middle"
                                            onclick="document.getElementById('registerForm').submit();">
                                        {{ __('Сохранить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        function set_value(row_num) {
                            if (row_num == -1) {
                                $('#start_date').val('');
                                $('#end_date').val('');
                                $('#id').val('');
                                $('#header').text('Новая запись');
                            } else {
                                var start_date_value = '';
                                var end_date_value = '';
                                var id_value = '';
                                table = document.getElementById("holdings_table");
                                tr = table.getElementsByTagName("tr")[row_num];

                                td = tr.getElementsByTagName("td");

                                start_date_value = td[1].innerText;
                                end_date_value = td[2].innerText;
                                id_value = td[0].innerText;
                                $('#start_date').val(start_date_value);
                                $('#end_date').val(end_date_value);
                                $('#id').val(id_value);
                                $('#header').text('Запись №'+(row_num+1).toString())
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
