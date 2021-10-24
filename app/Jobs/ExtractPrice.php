<?php

namespace App\Jobs;

use NumberFormatter;
use App\Models\Offre;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use CurrencyDetector\Detector;
use Illuminate\Queue\SerializesModels;

use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ExtractPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    { 
        $this->request = $request;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $produitId [] = explode(',', $this->request->ExecuterVeille);
        foreach ($this->request as  $produit) {
            // dd($produit);
            //  appliquer le job scheling ici avant de poursuivre


            $offres = Offre::where('produit_id', $produit)->get();

            if(count($offres)>0)
       {
        foreach ($offres as  $offre) {

            $prix=$this->get_price($offre);
            //  dd($prix);
            if($prix != null)
           { $offre->update(["prixOffre"=>$prix]);}
        }
       }
        }
    }

    private function get_price(Offre $offre){

            $url=$offre->urlOffre;
            $selecteur="";
            if(strpos($url,"boulanger.com") !=false){
                $selecteur= '.fix-price span.exponent';
            }else{
                if(strpos($url,"guyane.darty-dom.com") !=false){
                    $selecteur='.product-price-container span.price-int';
                }
            }
        $productPairs = [
            'rum' => [
                'own' => [
                    'url' => 'https://www.boulanger.com/ref/1160631',
                    'selectorPath' => ".fix-price span.exponent"
                ],
                'competitor1' => [
                    'url' => $offre->urlOffre,
                    'selectorPath' =>$selecteur 
                ]
            ]
            # you can add as many product pairs as you wish
        ];
        
        $detector = new Detector();
        
        $comparison = [];
        $priceString="";
        foreach ($productPairs as $productName => $pair) {
        
        
            foreach($pair as $provider => $product) {
        
                $client = new Client();
                $parser = new Dom;
                        // try { 
                        
                                $request = $client->request('GET', $product['url']);
                                $response = (string) $request->getBody();
                                $parser->loadStr($response);
                                $price = $parser->find($product['selectorPath'])[0];
                                $priceString = $price->text; 
                                $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
                //             } catch (\ErrorException $ee) {
                //                 $priceString="";
                //                 break;
                //             }
                //             catch(ConnectException $ge)
                //             {
                                
                //                 break;
                //             }
                 $comparison[$productName][$provider] = [
                    'currency' => $detector->getCurrency($priceString),
                    'prix' => $detector->getAmount($priceString),
                ];     
        
            }
        }
        // echo json_encode($comparison);
        // dd($comparison);
        // dd($detector->getAmount($priceString) );
        return  $detector->getAmount($priceString) != null ? $detector->getAmount($priceString) : null ;
    }

}
