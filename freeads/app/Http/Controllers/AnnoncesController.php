<?php

namespace freeads\Http\Controllers;

use freeads\Annonces;
use freeads\Categorie;
use freeads\Image;
use freeads\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use freeads\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use freeads\Repository\AnnonceRepository;

class AnnoncesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $annonces = AnnonceRepository::findAllAnnoncesLike($request);
        $categories = Categorie::all();
        return view('Annonces.index', ['annonces' => $annonces, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('Annonces.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'price' => 'required',
            'picture' => 'required',
            'cat' => 'required'
        ]);

        $annonces = Annonces::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'categorie_id' => $request->cat
        ]);

        $images = Input::file('picture');
        foreach( $images as $file) {
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            Image::create([
                'filePath' => $name,
                'annonce_id' =>$annonces->id,
            ]);
            $file->move(public_path().'/images/', $name);
        }

        $info = "Article created";

        return redirect()->route('annonces.show', ['id' => $annonces->id,'annonces' => $annonces ,'info' => $info]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \freeads\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $annonces = Annonces::find($id);
        $images = Image::where('annonce_id', '=' , $annonces->id )->get();
        $categorie = Categorie::find($annonces->categorie_id);
        $matchs = AnnonceRepository::findMatch($annonces->categorie_id, $id);

        return view("Annonces.show", ['annonces' => $annonces , 'images' => $images, 'categorie' => $categorie, 'matchs' => $matchs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \freeads\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $annonces = Annonces::find($id);

        if($annonces->user_id != Auth::id())
        {
            return redirect('annonces');
        }
        else
        {
            return view('Annonces.edit', ["annonces" => $annonces]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \freeads\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $annonces = Annonces::find($id);

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'price' => 'required'
        ]);

        $annonces->title = $request->title;

        $annonces->content = $request->content;

        $annonces->price = $request->price;


        if(Input::file('picture')) {
            Image::where('annonce_id', '=' , $annonces->id )->delete();
            $images = Input::file('picture');
            foreach ($images as $file) {
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file->getClientOriginalName();
                Image::create([
                    'filePath' => $name,
                    'annonce_id' => $annonces->id,
                ]);
                $file->move(public_path() . '/images/', $name);
            }
        }

        $info = "Annonce mis a jour";

        $annonces->save();

        return redirect()->route('annonces.show', ['id' => $annonces->id,'annonces' => $annonces ,'info' => $info]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \freeads\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annonces = Annonces::find($id)->delete();
        return redirect()->route('annonces.index');
    }
}
