@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                @foreach($competitions as $competition)
                    <div class="card  bg-dark text-light border-green mt-2"
                         style="border-radius: 12px; ">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2 ">
                                    <h2>{{ $competition->name}}</h2>
                                </div>
                                <div class="ml-auto p-2">
                                    <h3><span
                                            class="badge badge-primary badge-pill">{{App\Models\User::types_label[$competition->user_type]}}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-light text-dark" style="border-radius: 12px; ">
                            <p class="card-text mb-auto">{!!$competition->preview_text!!}</p>
                            <div class="d-flex bd-highlight mb-3">
                                <div class="bd-highlight"><a href="{{route('competition',['competition_id'=>$competition->id])}}"
                                                             type="button" class="btn btn-success rounded-pill"
                                                             href="#"><i class="fa fa-eye"></i> Информация по
                                        направлению</a>
                                </div>
                                <div class="ml-auto bd-highlight"><h5>
                                        @if($competition->status()['slug']=='not_hold')
                                            {{ $competition->status()['label']}}
                                        @else
                                            {{$competition->status()['label'].': c '.$competition->holdings()->latest()->first()->start_date.' по '.$competition->holdings()->latest()->first()->end_date}}
                                        @endif</h5></div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
