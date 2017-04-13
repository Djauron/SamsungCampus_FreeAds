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
            ->join('categories', 'categories.id', '=', 'annonces.categorie_id')
            ->select('annonces.*', 'categories.name_categorie', 'users.name', 'images.filePath','annonces.id as id');

            if(isset($find->search))
            {
                $annonces->where('annonces.title', 'like', '%'.$find->search.'%');
            }
            if(isset($find->price))
            {
                $annonces->where('annonces.price', '=', $find->price);
            }
            if(isset($find->vendor))
            {
                $annonces->where('users.name', 'like', '%'.$find->vendor.'%');
            }
            if(isset($find->cat) && $find->cat != 0)
            {
                $annonces->where('categories.id', '=', $find->cat);
            }

            $annonces->orderby('created_at','desc');

        return $annonces->get();
    }


}


?>