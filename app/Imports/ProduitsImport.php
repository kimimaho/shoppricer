<?php

namespace App\Imports;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ProduitsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $user = Auth::user()->id;
        return new Produit([
                'user_id'     => Auth::user()->id,
                'nomProduit'    => $row[0],
                'prixProduit'    => $row[1],
        ]);
    }
}
