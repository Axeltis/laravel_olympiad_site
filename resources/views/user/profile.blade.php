@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <div class="text-nowrap">
                            <h3>{{$user->name.' '.$user->middlename.' '.$user->surname}}</h3>
                        </div>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <a href="{{route('user.edit_user_page',['id'=>$user->id])}}"
                           type="button" class="btn btn-success"><i class="fa fa-edit"></i>
                        Изменить профиль</a>
                        <form class="d-none" id="deleteForm"
                              action="{{ route('user.delete_user',['id'=>$user->id]) }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <a onclick="document.getElementById('deleteForm').submit();"
                           class="btn btn-danger"><i
                                class="fa fa-trash "></i>Удалить профиль</a>

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

                        @if($user->type()=='student')
                            <tr><td class="active">Тип участника</td><td>Студент</td></tr>
                            <tr><td class="active">Колледж</td><td>{{$user->asStudent->college}}</td></tr>
                            <tr><td class="active">Специальность</td><td>{{$user->asStudent->speciality}}</td></tr>
                            <tr><td class="active">Курс</td><td>{{$user->asStudent->course}}</td></tr>
                        @elseif($user->type()=='teacher')
                            <tr><td class="active">Тип участника</td><td>Учитель</td></tr>
                            <tr><td class="active">Образовательная организация</td><td>{{$user->asTeacher->organization}}</td></tr>
                            <tr><td class="active">Должность</td><td>{{$user->asTeacher->position}}</td></tr>
                        @elseif($user->type()=='pupil')
                            <tr><td class="active">Тип участника</td><td>Школьник</td></tr>
                            <tr><td class="active">Образовательная организация</td><td>{{$user->asPupil->organization}}</td></tr>
                            <tr><td class="active">Класс</td><td>{{$user->asPupil->class}}</td></tr>
                        @else
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
