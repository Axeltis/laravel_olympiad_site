@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">

                <div class="card  bg-dark text-light border-green">


                    <div class="card-header">
                      Обучающие материалы
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('admin.save_competition',['page'=>'teaching_materials','competition_id'=>$competition_id]) }}">
                            @csrf
                            <input id="description" name="description" type="hidden"
                                   value="{{$data['description']}}">
                            @include('components.text_editors.tiny', ['field_name' => 'teaching_materials','value'=>old('teaching_materials')??$data['teaching_materials']])
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection
