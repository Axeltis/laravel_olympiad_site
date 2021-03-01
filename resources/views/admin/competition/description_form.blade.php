@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">

                <div class="card  bg-dark text-light border-green">
                    <div class="card-header">
                        Описание направления
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('admin.save_competition',['page'=>'description','competition_id'=>$competition_id]) }}"
                              >
                            <input id="teaching_materials" name="teaching_materials" type="hidden" value="{{$data['teaching_materials']}}">
                            @csrf
                            @include('components.text_editors.tiny', ['field_name' => 'description','value'=>old('description')??$data['description']])
                            <button type="submit" class="btn btn-success">Далее</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
