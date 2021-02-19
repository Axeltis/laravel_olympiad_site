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
                                                        @foreach(array_keys($user->type_label) as $type)
                                                        <option @if($user->type()==$type) selected @endif value="{{$type}}">{{$user->type_label[$type]}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div id="none">
                                            </div>
                                            <div id="student">
                                                <div class="form-group row">
                                                    <label for="student_college"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Колледж') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="student_college" type="text"
                                                               class="form-control @error('student_college') is-invalid @enderror"
                                                               name="student_college"
                                                               value="{{ (($user->asStudent)??'')->college??'' }}" required
                                                               autocomplete="college">
                                                        @error('student_college')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="student_speciality"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Специальность') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="student_speciality" type="text"
                                                               class="form-control @error('student_speciality') is-invalid @enderror"
                                                               name="student_speciality"
                                                               value="{{  (($user->asStudent)??'')->speciality??'' }}" required
                                                               autocomplete="student_speciality">

                                                        @error('student_speciality')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="student_course"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Курс') }}</label>

                                                    <div class="col-md-6">
                                                        <select id="student_course" name="student_course" class="form-control">
                                                            @for($i = 1; $i <= 4; $i++)
                                                            <option @if((($user->asStudent)??'')->course??''==$i) selected @endif value="{{$i}}">
                                                                {{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="teacher">
                                                <div class="form-group row">
                                                    <label for="teacher_organization"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Образовательная организация') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="teacher_organization" type="text"
                                                               class="form-control @error('teacher_organization') is-invalid @enderror"
                                                               name="teacher_organization"
                                                               value="{{ (($user->asTeacher)??'')->organization??'' }}" required
                                                               autocomplete="teacher_organization">

                                                        @error('teacher_organization')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="teacher_position"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Должность') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="teacher_position" type="text"
                                                               class="form-control @error('teacher_position') is-invalid @enderror"
                                                               name="teacher_position"
                                                               value="{{ (($user->asTeacher)??'')->position??''  }}" required
                                                               autocomplete="teacher_position">

                                                        @error('teacher_position')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="pupil">
                                                <div class="form-group row">
                                                    <label for="pupil_organization"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Образовательная организация') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="pupil_organization" type="text"
                                                               class="form-control @error('pupil_organization') is-invalid @enderror"
                                                               name="pupil_organization"
                                                               value="{{ (($user->asPupil)??'')->organization??'' }}" required
                                                               autocomplete="pupil_organization">

                                                        @error('pupil_organization')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="pupil_class"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Класс') }}</label>

                                                    <div class="col-md-6">
                                                        <select id="pupil_class" name="pupil_class" class="form-control">
                                                            @for($i = 1; $i <= 11; $i++)

                                                            <option @if((($user->asPupil)??'')->class??''==$i) selected @endif value="{{$i}}">
                                                                {{$i}}
                                                            </option>

                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
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
            $('#type_select').change(function () {
                @foreach(array_keys($user->type_label) as $type)
                $('#{{$type}}').hide();
                @endforeach
                $('#' + this.value).show();
            });
            @foreach(array_keys($user->type_label) as $type)
            @if($type!=$user->type()) $('#{{$type}}').hide(); @endif
            @endforeach

        });
    </script>
@endsection
