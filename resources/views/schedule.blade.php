@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card bg-dark text-light  border-green"  style="border-radius: 12px; ">
                    <div class="card-header"><h4>{{ __('Расписание') }}</h4></div>
                    <div class="card-body">
                        <div class="row-md-12">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <input style="text-decoration-color: white; font-size: large; color: white;
                                background-color:transparent !important;
                                border:none !important; box-shadow: none;" type="search" id="competitions_search"
                                       class="form-control"
                                       placeholder="Search"
                                       aria-label="Search" onkeyup="filter_competitions()"/>

                            </div>
                            <p>
                            <table class="table  bg-light text-dark">
                                <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Тип участника</th>
                                </tr>
                                </thead>
                                <tbody id="competitions_table">

                                @foreach($competitions as $key =>$competition)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $competition->name }}</td>
                                        <td>
                                            @if($competition->status()['slug']=='not_hold')
                                                {{ $competition->status()['label']}}
                                            @else
                                                {{$competition->status()['label'].': c '.$competition->holdings()->latest()->first()->start_date.' по '.$competition->holdings()->latest()->first()->end_date}}
                                            @endif
                                        </td>
                                        <td>{{ App\Models\User::types_label[$competition->user_type] }}</td>
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
