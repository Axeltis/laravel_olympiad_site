@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-md-8">
                <div class="card bg-dark text-white ">
                    <div class="card-header">{{ __('Изменение данных профиля') }}</div>

                    <div class="card-body">
                        <form method="POST" id="registerForm"
                              action="{{ route('user.edit_user',['user_id'=>$user->id]) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="hidden" name="type" value="{{$user->type->type_name??'none'}}">
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
                                    <div class="form-group row d-none">
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

                                            @if($user->type_name==App\Models\User::types_path['student'])
                                                @include('components.fields.common_text',['label'=>'Колледж','value' =>$user->type->college??'','field_name'=>'student_college','type_name'=>'student'])
                                                @include('components.fields.common_text',['label'=>'Специальность','value' =>$user->type->speciality??'','field_name'=>'student_speciality','type_name'=>'student'])
                                                @include('components.fields.common_num_select',['label'=>'','value' =>$user->type->course??'','field_name'=>'student_course','type_name'=>'student','max_num'=>4,'min_num'=>1])
                                            @endif
                                            @if($user->type_name == App\Models\User::types_path['teacher'])
                                                @include('components.fields.common_text',['label'=>'Организация','value' =>$user->type->organization??'','field_name'=>'teacher_organization','type_name'=>'teacher'])
                                                @include('components.fields.common_text',['label'=>'Должность','value' =>$user->type->position??'','field_name'=>'teacher_position','type_name'=>'teacher'])
                                            @endif
                                            @if($user->type_name==App\Models\User::types_path['pupil'])
                                                @include('components.fields.common_text',['label'=>'Организация','value' =>$user->type->organization??'','field_name'=>'pupil_organization','type_name'=>'pupil'])
                                                @include('components.fields.common_num_select',['label'=>'Класс','value' =>$user->type->class??'','field_name'=>'pupil_class','type_name'=>'pupil','max_num'=>11,'min_num'=>1])
                                            @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
