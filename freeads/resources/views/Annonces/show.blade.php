@extends('layouts.app')



@section('content')


<div class="col-xs-12 col-sm-12 col-md-12 text-center">

    <a href="{{ route('annonces.edit', ['id' => $annonces->id]) }}" class="btn btn-default Add-friend">
        <i class="fa fa-rocket" aria-hidden="true"></i> Edit Annonce
    </a>

</div>

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        @if (isset($info))

        <div class="alert alert-info">

            {{ $info }} <br><br>

        </div>

        @endif

        <div class="form-group">

            <strong>Titre :</strong>

            {{ $annonces->title }}

        </div>

        <div class="form-group">

            <strong>Content :</strong>

            {{ $annonces->content }}

        </div>

        <div class="form-group">

            <strong>Prix :</strong>

            {{ $annonces->price }}$

        </div>

        @foreach ($images as $image)

        <img style="max-width: 500px;max-height: 500px" src="/images/{{ $image->filePath }}" alt="">

        @endforeach


    </div>



</div>


@endsection