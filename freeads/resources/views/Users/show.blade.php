@extends('layouts.app')



@section('content')


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        @if (isset($info))

        <div class="alert alert-info">

            {{ $info }} <br><br>

        </div>

        @endif

        <div class="form-group">

            <strong>Name:</strong>

            {{ $user->name }}

        </div>

        <div class="form-group">

            <strong>Email:</strong>

            {{ $user->email }}

        </div>

        <div class="form-group">

            <strong>Inscrit depuis le:</strong>

            {{ $user->created_at }}

        </div>

    </div>


</div>


@endsection