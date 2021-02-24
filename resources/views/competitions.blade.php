@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="jumbotron p-3 p-md-5 text-light  bg-dark border-green" style="border-radius: 12px">
            <div class="col-md-6 px-0">
                <h1 class="display-6 font-italic">Компетенции</h1>
                <p class="lead my-3">Multiple lines of tehxt that form the lede, informing new readers quickly and
                    efficiently about what's most interesting in this post's contents.</p>


            </div>
        </div>
            <div class="col-md-9">
                @foreach($competitions as $competition)
                    <div class="card  border-dark border-green mt-2"
                         style="border-radius: 12px; ">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2 ">
                                    <h2>{{ $competition->name}}</h2>
                                </div>
                                <div class="ml-auto p-2">
                                    <h3><span  class="badge badge-primary badge-pill">{{App\Models\User::types()["path"][$competition->user_type]}}</span></h3>
                                </div>
                            </div>
                        </div>

                            <div class="card-body">
                                <p class="card-text mb-auto" >{!!$competition->description!!}</p>
                                                 <div class="d-flex bd-highlight mb-3">
                                    <div class="bd-highlight"> <a href="{{route('competition',['id'=>$competition->id])}}"  type="button" class="btn btn-success rounded-pill" href="#"><i class="fa fa-eye"></i> Информация по направлению</a>
                                    </div>
                                    <div class="ml-auto bd-highlight"><h5>{{$competition->status()['label'].': c '.$competition->holdings()->latest()->first()->start_date.' по '.$competition->holdings()->latest()->first()->end_date}}</h5></div>
                                </div>
                            </div>

                    </div>
                @endforeach
                @if(Auth::user()->role->slug=='admin')
                    <div class="row">
                        <div class="col">
                            <hr class="border-green">
                        </div>
                        <div class="col-md-1"><a href="{{ route('admin.competition_form') }}" class="text-success"><i
                                    class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
