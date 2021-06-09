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
                @if(Auth::check())
                    @if(array_key_exists(Auth::user()->type_name,App\Models\User::types_label))
                        <form class="d-none" id="join({{$competition->id}})"
                              action="{{ route('user.join_competition',['competition_id'=>$competition->id]) }}"
                              method="POST">
                            @csrf
                        </form>
                        <a onclick="document.getElementById('join({{$competition->id}})').submit();"
                           type="button" class="btn btn-success rounded-pill @if($competition->status()['slug']=='was_hold' or $competition->status()['slug']=='not_hold') disabled @endif"
                           href="#"><i class="fa fa-user-plus"></i> Участвовать</a>
                    @endif
                @endif
            </div>
        </div>
        <hr>

        <div class="card bg-dark text-light  border-green mt-4"  style="border-radius: 12px;">
            <div class="card-header">
                <h4><p class="font-weight-bold">Описание направления</p></h4>
            </div>
            <div class="card-body text-dark"  style="border-radius: 12px; background-color: #FFFFFF;">
                <h5><p>{!! $competition->description !!}</p></h5>
            </div>
        </div>




    </div>
@endsection
