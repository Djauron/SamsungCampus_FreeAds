@extends('layouts.app')



@section('content')


<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Annonces</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('annonces.index') }}"> Back</a>

        </div>

    </div>

</div>


{!! Form::model($annonces, ['method' => 'PATCH','route' => ['annonces.update', $annonces->id] , 'files' => true]) !!}

<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Title :</strong>

            {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}

        </div>

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Content :</strong>

            {!! Form::text('content', null, array('placeholder' => 'Content','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Price :</strong>

            {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong> Picture :</strong>

            {!! Form::file('picture[]',array('class' => 'control', 'multiple' => true)) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Categorie :</strong>



        </div>

    </div>



    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>


</div>

{!! Form::close() !!}


@endsection