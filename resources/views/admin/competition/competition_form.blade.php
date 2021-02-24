@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card  bg-dark text-light border-green">
                    <div class="card-header">
                        Создание направления
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('admin.save_competition',['page'=>'all','id'=>$competition->id??null]) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <input id="description" name="description" type="hidden"
                                   value="{{$competition->description??' '}}">
                            <input id="teaching_materials" name="teaching_materials" type="hidden"
                                   value="{{$competition->teaching_materials??' '}}">
                            @include('components.fields.common_text',['label'=>'Название','value' =>$competition->name??'','field_name'=>'name'])
                            @include('components.fields.common_text',['label'=>'Максимальное количество баллов','value' =>$competition->max_points??'','field_name'=>'max_points'])
                            @include('components.fields.common_select',['label'=>'Тип пользователя','value' =>$competition->user_type??'','field_name'=>'user_type','options'=>App\Models\User::types()['slug']])

                            @include('components.fields.common_file', ['label'=>'Учебное видео','field_name' => 'video'])

<div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Далее</button>
</div>
                        </form>


                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
