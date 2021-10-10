<?php

namespace App\Models;

use App\Models\User;
use App\Models\Notification;
use App\Models\Offre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','nomProduit','prixProduit'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offres(){
        return $this->hasMany(Offre::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
