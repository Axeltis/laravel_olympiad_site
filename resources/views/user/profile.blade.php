@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="row">
                    <div class="col-md-2">
                        <div class="text-nowrap">
                            <h3>{{$user->name.' '.$user->middlename.' '.$user->surname}}</h3>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <table class="table table-th-block">
                        <tbody>
                        <tr><td class="active">Телефон</td><td>{{$user->phone}}</td></tr>
                        <tr><td class="active">E-mail</td><td>{{$user->email}}</td></tr>
                        <tr><td class="active">Дата рождения</td><td>{{$user->birth_date}}</td></tr>
                        @if(Auth::user()->role->slug=='admin')
                        <tr><td class="active">Роль</td><td>{{$user->role->name}}</td></tr>
                        <tr><td class="active">Статус</td><td>{{$user->status->name}}</td></tr>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
