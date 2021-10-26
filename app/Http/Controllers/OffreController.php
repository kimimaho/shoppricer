<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Imports\OffresImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OffreController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits=Produit::where("user_id",Auth::user()->id)->get();

        // fore
       return view('pages.offres.index',[
           'produits' => $produits,
        //    'Offres' => Offre::where('user_id', Auth::user()->id),
       ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.offres.create',[
            'produits' => Produit::whereUserId(Auth::user()->id)->get(),
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required|string|min:2",
            "prix" => "nullable|integer|min:2",
            "url" => "required|string|min:2", 
        ]);
        $offreUrl=Offre::where("urlOffre",$request->url)->first();
        if($offreUrl != null){
            if($offreUrl->produit->user==Auth::user()){
                //dd($offreUrl->produit->user);
                 return back()->with("error", "Cette URL a déjà été definie pour une autre offre!");
            }
        } 
           $offre = Offre::create([
                            "produit_id" => $request->produit_id,
                            "nomOffre" => $request->nom,
                            "urlOffre" => $request->url,
                            "prixOffre" => $request->prix,
        ]);
        return redirect()->route("offres.index")->with("success", "L'offre a été ajouté avec succès");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $Offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offre  $Offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        // dd($offre);
        return view('pages.offres.edit',[
            'produits' => Produit::whereUserId(Auth::user()->id)->get(),
            'offre' => $offre
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        // dd('ffff');
        $request->validate([
            "nom" => "required|string|min:2",
            "prix" => "nullable|integer|min:2",
            "url" => "required|string|min:2",

        ]);
           $offre->update([
                    "produit_id" => $request->produit_id,
                    "nomOffre" => $request->nom,
                    "urlOffre" => $request->url,
                    "prixOffre" => $request->prix,
        ]);
        return redirect()->route("offres.index")->with("success", "L'offre a été modifié avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
       $offre->delete();
        return redirect()->route("offres.index")->with("success", "L'offre a été supprimé avec succès"); 

    }
    public function importation()
    {
        Excel::import(new OffresImport,request()->file('fichier'));

        return back();
    }
}
