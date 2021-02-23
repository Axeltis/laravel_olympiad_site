@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card bg-dark text-white ">
                    <div class="card-header">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form method="POST"  id="registerForm" action="{{ route('admin.edit_user',['id'=>$user->id]) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group row">
                                <div class="form-group col">
                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{ $user->name }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="middlename"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

                                        <div class="col-md-6">
                                            <input id="middlename" type="text" class="form-control" name="middlename"
                                                   value="{{ $user->middlename }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="surname"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                        <div class="col-md-6">
                                            <input id="surname" type="text"
                                                   class="form-control @error('surname') is-invalid @enderror"
                                                   name="surname"
                                                   value="{{ $user->surname }}" required autocomplete="surname"
                                                   autofocus>

                                            @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone"
                                                   value="{{ $user->phone }}" required autocomplete="phone">

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ $user->email }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="birth_date"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>
                                        <div class="col-md-6">
                                            <input id="birth_date" name="birth_date" type="date"
                                                   class="form-control @error('birth_date') is-invalid @enderror"
                                                   value="{{ $user->birth_date }}" required autocomplete="birth_date">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>

                                <div class="col-md-4">
                                    <div class="card bg-dark text-light border-light">
                                        <div class="card-header">
                                            <div class="row">
                                                <label for="type_select"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('Тип участника') }}</label>
                                                <div class="col-md-8">

                                                    <select id="type_select" name="type_select" class="form-control">
                                                            <option  value="none">None</option>
                                                            <option  value="student" >Студент</option>
                                                            <option value="pupil">Школьник</option>
                                                            <option  value="teacher">Преподаватель</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div id="none">
                                            </div>
                                            <div id="student">
                                                @include('components.fields.common_text',['label'=>'Колледж','value' =>$user->type->college??'','field_name'=>'student_college'])
                                                @include('components.fields.common_text',['label'=>'Специальность','value' =>$user->type->speciality??'','field_name'=>'student_speciality'])
                                                @include('components.fields.common_num_select',['label'=>'Курс','value' =>$user->type->course??'','field_name'=>'student_course','max_num'=>4,'min_num'=>1])

                                            </div>
                                            <div id="teacher">
                                                @include('components.fields.common_text',['label'=>'Организация','value' =>$user->type->organization??'','field_name'=>'teacher_organization'])
                                                @include('components.fields.common_text',['label'=>'Должность','value' =>$user->type->position??'','field_name'=>'teacher_position'])
                                            </div>
                                            <div id="pupil">
                                                @include('components.fields.common_text',['label'=>'Организация','value' =>$user->type->organization??'','field_name'=>'pupil_organization'])
                                                @include('components.fields.common_num_select',['label'=>'Класс','value' =>$user->type->class??'','field_name'=>'pupil_class','max_num'=>11,'min_num'=>1])

                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit"
                                                            class="btn btn-success rounded-pill align-middle"
                                                            onclick="document.getElementById('registerForm').submit();">
                                                        {{ __('Сохранить') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col col-md-4 text-xl-left">
                                    <div class="form-group row">
                                        <h3>Роль пользователя</h3>
                                        <div class="container">
                                            @foreach($roles as $role)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role"
                                                           id="{{ $role->slug }}" value="{{ $role->slug }}"
                                                           @if($role->slug==$user->role->slug) checked @endif>
                                                    <label class="form-check-label" for=" {{ $role->slug }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h3>Статус пользователя</h3>
                                        <div class="container">
                                            @foreach($statuses as $status)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{ $status->slug }}" value="{{ $status->slug }}"
                                                           @if($status->slug==$user->status->slug) checked @endif>
                                                    <label class="form-check-label" for="{{ $status->slug }}">
                                                        {{ $status->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#type_select option[value={{$user->type->type_name??'none'}}]').attr('selected','selected');
            $('#type_select').change(function () {
                $('#student').hide();
                $('#pupil').hide();
                $('#teacher').hide();
                $('#' + this.value).show();
            });
            $('#pupil').hide();
            $('#teacher').hide();
            $('#student').hide();
            $('#' + {{ $user->type->type_name??'none' }}).show();
        });
    </script>
@endsection
