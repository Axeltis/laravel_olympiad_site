@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-header">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form id="registerForm" method="POST" action="{{ route('admin.create_user') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                                   value="{{ old('middlename') }}" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="surname"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                        <div class="col-md-6">
                                            <input id="surname" type="text"
                                                   class="form-control @error('surname') is-invalid @enderror"
                                                   name="surname"
                                                   value="{{ old('surname') }}" required autocomplete="surname"
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
                                                   value="{{ old('phone') }}" required autocomplete="phone">

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
                                                   value="{{ old('email') }}" required autocomplete="email">

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
                                                   value="{{ old('birth_date') }}" required autocomplete="birth_date">
                                            @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
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
                                                        <option selected value="none">None</option>
                                                        <option value="student">Студент</option>
                                                        <option value="pupil">Школьник</option>
                                                        <option value="teacher">Преподаватель</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div id="student">
                                                <div class="form-group row">
                                                    <label for="college"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Колледж') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="student_college" type="text"
                                                               class="form-control @error('student_college') is-invalid @enderror"
                                                               name="student_college"
                                                               value="{{ old('student_college') }}" required
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
                                                               value="{{ old('student_speciality') }}" required
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
                                                            <option selected value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
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
                                                               value="{{ old('teacher_organization') }}" required
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
                                                               value="{{ old('teacher_position') }}" required
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
                                                               class="form-control @error('organization') is-invalid @enderror"
                                                               name="pupil_organization"
                                                               value="{{ old('pupil_organization') }}" required
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
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option selected value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit"
                                                            class="btn btn-success rounded-pill align-middle"
                                                            onclick="document.getElementById('registerForm').submit();">
                                                        {{ __('Создать') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-xl-left">
                                    <div class="form-group row">
                                        <h3>Роль пользователя</h3>
                                        <div class="container">
                                            @foreach($roles as $role)
@if($role->slug!='moderator')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="role"
                                                           id="{{ $role->slug }}" value="{{ $role->slug }}"
                                                           @if($role->slug=='user') checked @endif>
                                                    <label class="form-check-label" for=" {{ $role->slug }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
@endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h3>Статус пользователя</h3>
                                        <div class="container">
                                            @foreach($statuses as $status)
@if($status->slug!='waiting')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{ $status->slug }}" value="{{ $status->slug }}"
                                                           @if($status->slug=='waiting') checked @endif>
                                                    <label class="form-check-label" for="{{ $status->slug }}">
                                                        {{ $status->name }}
                                                    </label>
                                                </div>
@endif
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
                $('#student').hide();
                $('#pupil').hide();
                $('#teacher').hide();
                $('#' + this.value).show();
            });
            $('#pupil').hide();
            $('#teacher').hide();
            $('#student').hide();
        });
    </script>
@endsection
