@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card bg-transparent " style="border-radius: 12px;  width: 880px">
            <div class="card-header bg-dark text-light " style="border-radius: 12px;">
                <div class="row justify-content-between">
                    <div class="col"></div>
                    <div class="col">
                        <h3>Олимпиады</h3>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
            <div class="card-body   border-green border-dark" style="border-radius: 12px;">
                <div class="d-flex flex-wrap">
                    @foreach($holdings as $holding)
                        <div class="p-2">
                            <div class="card border-green bg-dark text-light  mt-2 "
                                 style="border-radius: 12px; width: 400px;height: 400px;">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <div class="p-2 ">
                                            <h4>{{ $holding->competition->name}}</h4>
                                        </div>
                                        <div class="ml-auto p-2">
                                            <form class="d-none" id="join({{ $holding->competition->id}})"
                                                  action="{{route('user.leave_competition',['competition_id'=> $holding->competition->id])}}"
                                                  method="POST">
                                                @csrf
                                            </form>
                                            <a onclick="document.getElementById('join({{ $holding->competition->id}})').submit();"
                                               type="button" class="btn btn-danger rounded"
                                               href="#"><i class="fa fa-minus-circle"></i></a>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body border-green border-left-0 border-right-0">
                                    <div class="row offset-1">
                                        <p>Кол-во баллов: {{$holding->users()->find(Auth::user())->pivot->points}}</p>
                                    </div>

                                    <div class="row offset-1">
                                        <p>{{ $holding->status()['label'].': c '. $holding->start_date.' по '. $holding->end_date}}</p>
                                    </div>
                                </div>
                                <div class="card-body " style="border-radius: 12px;">


                                    <div class="row mt-2 justify-content-end">
                                        <a style="width: 300px; border-top-left-radius: 400px;border-bottom-left-radius: 400px"
                                           href="{{route('competition',['competition_id'=>$holding->competition->id])}}"
                                           type="button" class="btn btn-light  btn-block">
                                            Информация по направлению</a>
                                    </div>
                                    <div class="row mt-2 justify-content-end">
                                        <a style="width: 300px; border-top-left-radius: 400px;border-bottom-left-radius: 400px"
                                           href="{{route('competition.teaching_materials',['competition_id'=>$holding->competition->id])}}"
                                           type="button" class="btn btn-light  btn-block"
                                        > Материал для изучения</a>


                                    </div>

                                </div>
                                <div class="row justify-content-end">
                                    <form id="answer({{ $holding->competition->id}})"
                                          action="{{route('user.upload_answer',['holding_id'=> $holding->id])}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group mb-3 col-md-11">

                                            <div class="input-group-prepend">
                                                <button
                                                    class="btn btn-success @if($holding->status()['slug']!='holding') disabled @endif"
                                                    type="submit">Отправить
                                                </button>
                                            </div>
                                            <div class="custom-file ">
                                                <input id="answer_file" type="file"
                                                       class="form-control  custom-file-input @error('answer_file') is-invalid @enderror"
                                                       name="answer_file"
                                                       autocomplete="answer_file">
                                                <label class="custom-file-label"
                                                       for="inputGroupFile03">
                                                    @if($holding->status()['slug']=='holding')
                                                        @if($holding->users()->find(Auth::user())->pivot->file_attached)
                                                            Файл прикреплен
                                                        @else
                                                            Прикрепите файл-ответ
                                                        @endif @else @endif</label>
                                                @error('answer_file')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>



    </div>
@endsection
