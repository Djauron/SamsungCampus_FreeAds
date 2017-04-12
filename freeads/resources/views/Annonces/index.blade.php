@extends('layouts.app')



@section('content')


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        @foreach ($annonces as $annonce)
        <p>Titre : {{ $annonce->title }}</p>
        <p>Content : {{ $annonce->content }}</p>
        <p>Price : {{ $annonce->price }}$</p>
        <p>Created : {{ $annonce->created_at }}</p>
        <a href="{{ route('annonces.show', ['id' => $annonce->id]) }}" class="btn btn-default Add-friend">
            <i class="fa fa-rocket" aria-hidden="true"></i> Voir l'annonce
        </a>
        @endforeach

    </div>


</div>


@endsection