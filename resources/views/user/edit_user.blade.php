@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card bg-dark text-white ">
                    <div class="card-header">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form method="POST" id="registerForm"
                              action="{{ route('user.edit_user',['id'=>$user->id]) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="hidden" name="type" value="{{$user->type()}}">
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
                                        <div class="card-body">
                                            <div id="none">
                                            </div>
                                            @if($user->type()=='student')
                                                <div class="form-group row">
                                                    <label for="college"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Колледж') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="college" type="text"
                                                               class="form-control @error('college') is-invalid @enderror"
                                                               name="college"
                                                               value="{{ (($user->asStudent)??'')->college??'' }}"
                                                               required
                                                               autocomplete="college">
                                                        @error('college')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="speciality"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Специальность') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="speciality" type="text"
                                                               class="form-control @error('speciality') is-invalid @enderror"
                                                               name="speciality"
                                                               value="{{  (($user->asStudent)??'')->speciality??'' }}"
                                                               required
                                                               autocomplete="speciality">

                                                        @error('speciality')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="course"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Курс') }}</label>

                                                    <div class="col-md-6">
                                                        <select id="course" name="course" class="form-control">
                                                            @for($i = 1; $i <= 4; $i++)
                                                                <option
                                                                    @if((($user->asStudent)??'')->course??''==$i) selected
                                                                    @endif value="{{$i}}">
                                                                    {{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($user->type()=='teacher')

                                                <div class="form-group row">
                                                    <label for="teacher.organization"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Образовательная организация') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="teacher.organization" type="text"
                                                               class="form-control @error('organization') is-invalid @enderror"
                                                               name="teacher.organization"
                                                               value="{{ (($user->asTeacher)??'')->organization??'' }}"
                                                               required
                                                               autocomplete="teacher.organization">

                                                        @error('organization')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="teacher.position"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Должность') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="teacher.position" type="text"
                                                               class="form-control @error('position') is-invalid @enderror"
                                                               name="teacher.position"
                                                               value="{{ (($user->asTeacher)??'')->position??''  }}"
                                                               required
                                                               autocomplete="position">

                                                        @error('position')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            @if($user->type()=='pupil')
                                                <div class="form-group row">
                                                    <label for="organization"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Образовательная организация') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="organization" type="text"
                                                               class="form-control @error('organization') is-invalid @enderror"
                                                               name="organization"
                                                               value="{{ (($user->asPupil)??'')->organization??'' }}"
                                                               required
                                                               autocomplete="organization">

                                                        @error('organization')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="class"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Класс') }}</label>

                                                    <div class="col-md-6">
                                                        <select id="class" name="class" class="form-control">
                                                            @for($i = 1; $i <= 11; $i++)

                                                                <option
                                                                    @if((($user->asPupil)??'')->class??''==$i) selected
                                                                    @endif value="{{$i}}">
                                                                    {{$i}}
                                                                </option>

                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
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
@endsection
