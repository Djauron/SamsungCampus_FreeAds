@extends('layouts.app')



@section('content')


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <a href="{{ route('users.edit', ['id' => Auth::user()->id]) }}" class="btn btn-default Add-friend">
            <i class="fa fa-rocket" aria-hidden="true"></i> Edit profile
        </a>
        <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}" class="btn btn-default Add-friend">
            <i class="fa fa-rocket" aria-hidden="true"></i> Voir profile
        </a>

    </div>


</div>


@endsection