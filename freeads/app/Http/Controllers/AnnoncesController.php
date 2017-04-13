<?php

namespace App\Http\Controllers;

use App\Annonces;
use App\Image;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Repository\AnnonceRepository;

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
        if(isset($request->search))
        {
            $annonces = AnnonceRepository::findAllAnnoncesLike($request->search);
        }
        else
        {
            $annonces = AnnonceRepository::findAllAnnonces();
        }
        return view('Annonces.index', ['annonces' => $annonces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Annonces.create');
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
            'picture' => 'required'
        ]);

        $annonces = Annonces::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
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
     * @param  \App\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $annonces = Annonces::find($id);

        $images = Image::where('annonce_id', '=' , $annonces->id )->get();
        return view("Annonces.show", ['annonces' => $annonces , 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonces  $annonces
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
     * @param  \App\Annonces  $annonces
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
     * @param  \App\Annonces  $annonces
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annonces = Annonces::find($id)->delete();
        return redirect()->route('annonces.index');
    }
}
