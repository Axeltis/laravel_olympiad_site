@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="col-md-10">
                <div class="card-body bg-dark text-light border-green mt-2 " style="border-radius: 12px;">
                    <table class="table table-th-block bg-light text-dark">
                        <tbody>
                        <tr>
                            <td class="active">ФИО</td>
                            <td>     {{$user->surname.' '.$user->name.' '.$user->middlename}}</td>
                        </tr>
                        <tr>
                            <td class="active">Телефон</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td class="active">E-mail</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td class="active">Дата рождения</td>
                            <td>{{$user->birth_date}}</td>
                        </tr>
                        @if(Auth::user()->role->slug=='admin')
                            <tr>
                                <td class="active">Роль</td>
                                <td>{{$user->role->name}}</td>
                            </tr>
                            <tr>
                                <td class="active">Статус</td>
                                <td>{{$user->status->name}}</td>
                            </tr>
                        @endif
                        @if($user->type)
                            <tr>
                                <td class="active">Тип участника</td>
                                <td>{{App\Models\User::types_label[$user->type_name]}}</td>
                            </tr>
                            @foreach(array_keys($user->type->viewables) as $viewable )
                                <tr>
                                    <td class="active">{{$user->type->viewables[$viewable]}}
                                    <td>{{$user->type[ $viewable]}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif

                    </table>

                    <a href="{{ route('user.edit_user_page',['user_id'=>$user->id])}}"
                       type="button" class="btn btn-success"><i class="fa fa-edit"></i>
                        Изменить данные</a>
                </div>
            </div>

    </div>
@endsection
