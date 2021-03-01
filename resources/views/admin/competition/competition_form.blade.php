@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form method="POST"
              action="{{ route('admin.save_competition',['page'=>'all','competition_id'=>$competition->id??null]) }}"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card  bg-dark text-light border-green">
                        <div class="card-header">
                            Создание направления
                        </div>
                        <div class="card-body">


                            <input id="description" name="description" type="hidden"
                                   value="{{$competition->description??' '}}">
                            <input id="teaching_materials" name="teaching_materials" type="hidden"
                                   value="{{$competition->teaching_materials??' '}}">
                            @include('components.fields.common_text',['label'=>'Название','value' =>$competition->name??'','field_name'=>'name'])
                            @include('components.fields.common_text',['label'=>'Максимальное количество баллов','value' =>$competition->max_points??'','field_name'=>'max_points'])
                            @include('components.fields.common_select',['label'=>'Тип пользователя','value' =>$competition->user_type??'','field_name'=>'user_type','options'=>App\Models\User::types_label])

                            @include('components.fields.common_file', ['label'=>'Учебное видео','field_name' => 'video'])

                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Далее</button>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card  bg-dark text-light border-green">
                        <div class="card-header">
                            Краткое описание
                        </div>
                        <div class="card-body">
                            @include('components.text_editors.tiny', ['field_name' => 'preview_text','value'=>old('preview_text')??$competition->preview_text??''])
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
