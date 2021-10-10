<?php

namespace App\Models;
use App\Models\User;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offre extends Model
{
    use HasFactory;
    protected $fillable = ['produit_id','nomOffre','urlOffre','prixOffre'];

    public function produit(){
        return $this->belongsTo(Produit::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}


