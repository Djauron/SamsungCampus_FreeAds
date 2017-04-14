@extends('layouts.app')



@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Create article</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('annonces.index') }}"> Back</a>

        </div>

    </div>

</div>


{!! Form::open(['method' => 'post','route' => ['annonces.store'], 'files' => true]) !!}

<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Titre :</strong>

            {!! Form::text('title', null, array('placeholder' => 'Titre','class' => 'form-control')) !!}

        </div>

    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Content :</strong>

            {!! Form::text('content', null, array('placeholder' => 'Description','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Prix :</strong>

            {!! Form::number('price', null, array('placeholder' => 'Prix','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong> Ajouter une categorie :</strong>

            <select name="cat" class="form-control">
                <option value="0">Choisir une categorie</option>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->name_categorie }}</option>
                @endforeach
            </select>

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong> Ajouter une image :</strong>

            {!! Form::file('picture[]',array('class' => 'control', 'multiple' => true)) !!}

        </div>

    </div>



    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>


</div>

{!! Form::close() !!}


@endsection