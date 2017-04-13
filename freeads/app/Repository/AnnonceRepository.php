<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

Class AnnonceRepository
{

    public static function findAllAnnoncesLike($find)
    {
        $annonces = DB::table('annonces')
            ->join('images', 'annonce_id', '=', 'annonces.id')
            ->join('users', 'users.id', '=', 'annonces.user_id')
            ->select('annonces.*', 'users.name', 'images.filePath','annonces.id as id')
            ->where('title', 'like', '%'.$find.'%')
            ->orderby('created_at','desc')->get();

        return $annonces;
    }

    public static function findAllAnnonces()
    {
        $annonces = DB::table('annonces')
            ->join('images', 'annonce_id', '=', 'annonces.id')
            ->join('users', 'users.id', '=', 'annonces.user_id')
            ->select('annonces.*', 'users.name', 'images.filePath','annonces.id as id')
            ->orderby('created_at','desc')->get();

        return $annonces;
    }


}


?>