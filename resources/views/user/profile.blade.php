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
                        @if($user->type)
                        <tr><td class="active">Тип участника</td><td>{{App\Models\User::types_label[$user->type_name]}}</td></tr>
                        @foreach(array_keys($user->type->viewables) as $viewable )
                            <tr><td class="active">{{$user->type->viewables[$viewable]}}<td>{{$user->type[ $viewable]}}</td></tr>
                        @endforeach
                        </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
