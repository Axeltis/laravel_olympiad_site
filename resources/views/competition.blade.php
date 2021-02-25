@extends('layouts.app')

@section('content')
    <div class="container ">


            <div class="d-flex bd-highlight justify-content-around mb-3">
                <div class="bd-highlight">
                </div>
                <div class="bd-highlight">
                <h1>{{ $competition->name}}</h1>
                </div>
                <div class="bd-highlight">
                    <form class="d-none" id="join({{$competition->id}})"
                          action="{{route('user.join_competition',['id'=>$competition->id])}}"
                          method="POST">
                        @csrf
                    </form>
                    <a onclick="document.getElementById('join({{$competition->id}})').submit();"
                                             type="button" class="btn btn-success rounded-pill"
                                             href="#"><i class="fa fa-user-plus"></i> Участвовать</a>
                </div>
            </div>
        <hr>

        <div class="card bg-dark text-light  border-green mt-4" style="border-radius: 12px; ">
            <div class="card-header">
                <h4><p class="font-weight-bold">Описание направления</p></h4>
            </div>
            <div class="card-body bg-light text-dark" style="border-radius: 12px; ">
                <h5><p>{!! $competition->description !!}</p></h5>
            </div>
        </div>
        <div class="card bg-dark text-light  border-green mt-4" style="border-radius: 12px; ">
            <div class="card-header">
                <h4><p class="font-weight-bold">Учебные материалы</p></h4>
            </div>
            <div class="card-body bg-light text-dark" style="border-radius: 12px; ">
                <h5><p>{!! $competition->teaching_materials !!}</p></h5>
            </div>
        </div>

        @if(Storage::disk('public')->exists(App\Models\Competition::$videos_folder_path . $competition->id))
            <div class="card bg-dark text-light  border-green mt-4" style="border-radius: 12px; ">
                <div class="card-header">
                    <h4><p class="font-weight-bold">Учебное видео</p></h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">

                        <video style="height: auto;max-width:1100px;border-radius: 12px" controls>
                            <source
                                src="{{asset('storage/'.App\Models\Competition::$videos_folder_path . $competition->id )}}"/>
                            Your browser does not support the video tag.
                        </video>

                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
