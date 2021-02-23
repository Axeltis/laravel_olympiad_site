@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card  bg-dark text-light border-green">
            <div class="card-header">
                Создание направления
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.save_competition',['id'=>$competition->id??null]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @include('components.fields.common_text',['label'=>'Название','value' =>$competition->name??'','field_name'=>'name'])
                            @include('components.fields.common_text',['label'=>'Максимальное количество баллов','value' =>$competition->max_points??'','field_name'=>'max_points'])
                            @include('components.fields.common_select',['label'=>'Тип пользователя','value' =>$competition->user_type??'','field_name'=>'user_type','options'=>App\Models\User::types()['slug']])

                            @include('components.text_editors.tiny', ['label'=>'Описание','field_name' => 'description','value'=>$competition->description??''])
                            @include('components.text_editors.tiny', ['label'=>'Учебные материалы','field_name' =>   'teaching_materials','value'=>$competition->teaching_materials??''])
                            @include('components.fields.common_file', ['label'=>'Учебное видео','field_name' => 'video'])

                        </div>

                    </div>
                    <div class="col">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>


            </div>

        </div>


    </div>
@endsection
