<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function strategie(){
// dd(Auth::user());
        return view('pages.strategies.create',[
            'strategie' => Auth::user()->strategie
        ]);
    }


    public function update(Request $resquest){
               $user = Auth::user();
               $user->strategie = $resquest->strategie;
               $user->save();
        

            return redirect()->route("strategie.create")->with("success", "La stratégie de prix a été definie avec succès");

    }

}
