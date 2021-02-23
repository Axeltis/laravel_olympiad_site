@extends('layouts.app')

@section('content')
    <div class="container border-right border-left">

        <div class="header">
            <div class="row justify-content-center">
                <h2>{{ $competition->name}}</h2>
            </div>
        </div>
        <hr>

        <div class="card-header">
            <h4><p class="font-weight-bold">Описание направления</p></h4>
        </div>
        <div class="card-body border-0">
            <h5><p>{!! $competition->description !!}</p></h5>
        </div>
        <hr>
        <div class="card-header">
            <h4><p class="font-weight-bold">Учебные материалы</p></h4>
        </div>
        <div class="card-body border-0">
            <h5><p>{!! $competition->teaching_materials !!}</p></h5>
        </div>
        <hr>

        @if(Storage::disk('public')->exists(App\Models\Competition::$videos_folder_path . $competition->id))
            <div class="card-header">
                <h4><p class="font-weight-bold">Учебное видео</p></h4>
            </div>
            <div class="card-body border-0">
                <div class="row justify-content-center">

                    <video style="height: auto;max-width:1100px;border-radius: 12px" controls>
                        <source
                            src="{{asset('storage/'.App\Models\Competition::$videos_folder_path . $competition->id )}}"/>
                        Your browser does not support the video tag.
                    </video>

                </div>
            </div>
        @endif

    </div>
@endsection
