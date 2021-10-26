<?php

namespace App\Imports;

use App\Models\Offre;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class OffresImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $user = Auth::user()->id;
        $produit_id = Produit::where('nomProduit',  $row[3])->first()->id;
        $offre=[
            'nomOffre'    => $row[0],
            'urlOffre'    => $row[1],
            'prixOffre'    => $row[2],
            'produit_id'     => $produit_id
        ];
        // dd($offre);
        return new Offre($offre);
    }
}
