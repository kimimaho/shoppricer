<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Produit;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Imports\ProduitsImport;
use App\Jobs\ExtractPrice;
use CallableClass;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProduitController extends Controller
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

       return view('pages.produits.index',[
        //    'produits' => Produit::all(),
           'produits' => Produit::where('user_id', Auth::user()->id)->get(),
       ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.produits.create',[
            'users' => User::all(),
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
        $produits=Produit::where("nomProduit","like",$request->nom)
                            ->where("user_id", "like",Auth::user()->id );
        // dd($produits->count());
        if($produits->count() >= 1){
            return back()->with("error", "Ce produit existe déjà! ");
        }
        $request->validate([
            "nom" => "required|string|min:2",
            "prix" => "required|integer|min:2",

        ]);
           $produit = produit::create([
                    "user_id" => Auth::user()->id,
                    "nomProduit" => $request->nom,
                    "prixProduit" => $request->prix,
        ]);
        return redirect()->route("produits.index")->with("success", "Le produit a été ajouté avec succès");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        // dd($produit->user);
        return view('pages.produits.edit',[
            'users' => User::all(),
            'produit' => $produit
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        // dd('ffff');
        $request->validate([
            "nom" => "required|string|min:2",
            "prix" => "required|integer|min:2",

        ]);
           $produit->update([
                    "nomProduit" => $request->nom,
                    "prixProduit" => $request->prix,
        ]);
        return redirect()->route("produits.index")->with("success", "Le produit a été modifié avec succès");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        
       $produit->delete();
        return redirect()->route("produits.index")->with("success", "Le produit a été supprimé avec succès");

    }

    public function import()
    {
        Excel::import(new ProduitsImport,request()->file('fichier'));

        return back();
    }

    // public function extrairePrixOffre(Request $request)
    // {
    //     ResendAttachment::dispatch();
    // }


    public function excecuter(Request $request)
    {
        // Schedule $schedule;
        // $schedule = new Schedule;
        // $schedule->call(new  CallableClass);
        $produitId [] = explode(',', $request->ExecuterVeille);
        ExtractPrice::dispatch($produitId[0]);
        //    dd($produitId);
        foreach ($produitId[0] as  $produit) {
            //  appliquer le job scheling ici avant de poursuivre


            $offres = Offre::where('produit_id', $produit)
                    ->whereNotNull("prixOffre")->get();

       if(count($offres)>0)
       {
            // dd($offres);
            $strategie = Auth::user()->strategie;
            if ($strategie == "prix minimun") {
                $min = $offres[0]->prixOffre;
                foreach ($offres as $offre) {
                    //  dd($offre);
                     if ($offre->prixOffre < $min) {
                         $min = $offre->prixOffre;
                        //  dd($min);
                     }
                 }

                 $prixUtilisateur = Produit::whereId($produit)->first()->prixProduit;
                 if ($min != $prixUtilisateur) {
                    //  dd(date("Y-m-d"));
                     Notification::create([
                         "user_id" =>Auth::user()->id, 
                         "produit_id" => $produit,
                         "prixRepositionnement" =>$min,
                         "dateNotification" =>date("Y-m-d"),
                         "message" => "Repositionnement de prix de ".$prixUtilisateur ." à ". $min." pour l'article : ". Produit::whereId($produit)->first()->nomProduit,
                         
                         
                         
                        ]); 
                 }
               
             }else{
                if ($strategie == "prix moyen") {
                    $somme = 0;
                    $compteur=0;
                foreach ($offres as $offre) {
                    $somme += $offre->prixOffre;
                    $compteur++;
                 }
                 $moyen= $somme/$compteur;
                 $prixUtilisateur = Produit::whereId($produit)->first()->prixProduit;
                 if ($moyen != $prixUtilisateur) {
                    //  dd(date("Y-m-d"));
                     Notification::create([
                         "user_id" =>Auth::user()->id,
                         "produit_id" => $produit,
                         "prixRepositionnement" =>$moyen,
                         "dateNotification" =>date("Y-m-d"),
                         "message" => "Repositionnement de prix de ".$prixUtilisateur ." à ". $moyen." pour l'article : ". Produit::whereId($produit)->first()->nomProduit,
                         
                         
                         
                        ]);
                 }
               
                }else{
                    if ($strategie == "prix maximun") {
                                            $max = $offres[0]->prixOffre;
                                    foreach ($offres as $offre) {
                                        //  dd($offre);
                                        if ($offre->prixOffre > $max) {
                                            $max = $offre->prixOffre;
                                        }
                                    }

                                    $prixUtilisateur = Produit::whereId($produit)->first()->prixProduit;
                                    if ($max != $prixUtilisateur) {
                                        //  dd(date("Y-m-d"));
                                        Notification::create([
                                            "user_id" =>Auth::user()->id,
                                            "produit_id" => $produit,
                                            "prixRepositionnement" =>$max,
                                            "dateNotification" =>date("Y-m-d"),
                                            "message" => "Repositionnement de prix de ".$prixUtilisateur ." à ". $max." pour l'article : ". Produit::whereId($produit)->first()->nomProduit,
                                            
                                            
                                            
                                            ]);
                                    }
                    }
                }

             }
    
                    
         }   
        }

         return redirect()->route('produits.index')->with('success', 'Le positionnement a été effectué avec succès');

           
        
    }


    public function repositionnement($id){
        // dd($id);
        $notification=Notification::whereId($id)->first();
        $produitRepositionnement = Notification::whereId($id)->first()->produit;

        // $produit = Produit::whereId($id)->first();
        // dd($produitRepositionnement);
        $produitRepositionnement->update([
            'prixProduit' => $notification->prixRepositionnement
        ]);
        $notification->delete();
        return redirect()->route("notifications.index")->with("success", "Le repositionnement a été effectué avec succès");

    }
}
