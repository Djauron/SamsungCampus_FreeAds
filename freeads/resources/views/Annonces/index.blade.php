@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row col-md-12">

        {!! Form::open(['method' => 'post','route' => ['annonces.index']]) !!}

        {!! Form::text('search', null, array('placeholder' => 'Rechercher une annonce','class' => 'control')) !!}
        {!! Form::number('price', null, array('placeholder' => 'Prix','class' => 'control')) !!}
        {!! Form::text('vendor', null, array('placeholder' => 'Vendeur','class' => 'control')) !!}

        <select name="cat" class="form-control">
            <option value="0"> Choisir une categorie</option>
            @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->name_categorie }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-default">Submit</button>

        {!! Form::close() !!}

        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Annonces</th>
            </tr>
            </thead>
            @foreach ($annonces as $annonce)
            <tr>
                <td>
                    <a href="{{ route('annonces.show', ['id' => $annonce->id]) }}" class="btn btn-default Add-friend">
                        <i class="fa fa-rocket" aria-hidden="true"></i> View
                    </a>
                </td>
                <td>Vendor : {{ $annonce->name }}</td>
                <td>Titre : {{ $annonce->title }}</td>
                <td>Content : {{ $annonce->content }}</td>
                <td>Categorie : {{ $annonce->name_categorie }}</td>
                <td>Price : {{ $annonce->price }}</td>
                <td>created : {{ $annonce->created_at }}</td>
                <td><img style="max-width: 100px;max-height: 100px" src="/images/{{ $annonce->filePath }}" alt=""></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>


@endsection