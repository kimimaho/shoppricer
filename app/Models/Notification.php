<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['produit_id','user_id','dateNotification','prixRepositionnement','message'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
