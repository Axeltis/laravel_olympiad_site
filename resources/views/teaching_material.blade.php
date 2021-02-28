@extends('layouts.app')

@section('content')
    <div class="container ">

        <div class="row justify-content-between">
            <div class="col"></div>
            <div class="col">
                <h1>{{ $competition->name }}</h1>
            </div>
            <div class="col"></div>
        </div>
        <hr>
        <div class="card bg-dark text-light  border-green mt-4" style="border-radius: 12px; ">
            <div class="card-header">
                <h4><p class="font-weight-bold">Учебные материалы</p></h4>
            </div>
            <div class="card-body bg-light text-dark" style="border-radius: 12px; ">
                <h5><p>{!! $competition->teaching_materials !!}</p></h5>
            </div>
        </div>

        @if(Storage::disk('public')->exists(App\Models\Competition::videos_folder_path . $competition->id))
            <div class="card bg-dark text-light  border-green mt-4" style="border-radius: 12px; ">
                <div class="card-header">
                    <h4><p class="font-weight-bold">Учебное видео</p></h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">

                        <video style="height: auto;max-width:1100px;border-radius: 12px" controls>
                            <source
                                src="{{asset('storage/'.App\Models\Competition::videos_folder_path . $competition->id )}}"/>
                            Your browser does not support the video tag.
                        </video>

                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
