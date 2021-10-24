<?php

namespace App\Console;

use CallableClass;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Http\Request;

// use Goutte\Client;

// use GuzzleHttp\Client as GuzzleClient;
// use PhpOffice\PhpSpreadsheet\Chart\Title;

 
use NumberFormatter;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use CurrencyDetector\Detector;
use Sunra\PhpSimple\HtmlDomParser;  
use App\Jobs\ExtractPrice;



class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->job(new ExtractPrice())->everyFiveMinutes();
        $schedule->call(function () {
        //     $parametres=array('Referer'=>'', 'Proxy'=>'', 'BrowserName'=>'');
        //     $url="https://www.made-in-china.com/cs/hot-china-products/Cosmetic_Brush.html?gclid=EAIaIQobChMInIb05rT_8gIVUoFQBh3k6QOKEAAYAyAAEgLu2fD_BwE";
        //    $html=$this->get_html($url,$parametres);
        //    echo($html); 
            // $url = "https://www.materiel.net/pc-portable/l409/";
            // $produit="ACER Nitro 5 AN515-57-5194";
            $html=$this->get_html();
            // print_r($html);

            // $tag=$this->getTag($html,"div",$produit);
            // print_r($tag);




            
        })->everyMinute();

        // $obj = new CallableClass;
        // $obj(5);
        // $schedule->call(new  CallableClass)->daily();
        // $schedule->call($obj(5))->daily();


        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    private function get_html(){

                ///echo "=========================";
        $productPairs = [
            'rum' => [
                'own' => [
                    'url' => 'https://www.allendalewine.com/products/11262719/diplomatico-reserva-exclusiva',
                    'selectorPath' => '.sale-price.currency'
                ],
                'competitor1' => [
                    'url' => 'https://guyane.darty-dom.com/p/acer-aspire-3-a315-54k-54rc',
                    'selectorPath' => '.product-price-container span.price-int'
                ]
            ]
            # you can add as many product pairs as you wish
        ];
        
        $detector = new Detector();
        
        $comparison = [];
        
        foreach ($productPairs as $productName => $pair) {
        
        
            foreach($pair as $provider => $product) {
        
                $client = new Client();
                $parser = new Dom;
        
                $request = $client->request('GET', $product['url']);
                $response = (string) $request->getBody();
                $parser->loadStr($response);
                $price = $parser->find($product['selectorPath'])[0];
                $priceString = $price->text;
        
                $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
        
                $comparison[$productName][$provider] = [
                    'currency' => $detector->getCurrency($priceString),
                    'prix' => $detector->getAmount($priceString),
                ];     
        
            }
        }
        echo json_encode($comparison);
        // echo  $detector->getAmount($priceString);
    }

    private function get_html1($url) {
      
        // $client = new \Goutte\Client();
        // $crawler = $client->request('GET', $url);
        // return $crawler;
        // // foreach ($crawler as $link) {
        // //     echo $link;
        // //     }

                // scraping books to scrape: https://books.toscrape.com/ 
                $httpClient = new \Goutte\Client();
                $response = $httpClient->request('GET', $url);
                $titles = $response->evaluate('//ol[@class="row"]//li//article//h3/a');
                $prices = $response->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
                // we can store the prices into an array
                $priceArray = [];
                foreach ($prices as $key => $price) {
                $priceArray[] = $price->textContent;
                }
                // we extract the titles and display to the terminal together with the prices
                foreach ($titles as $key => $title) {
                echo $title->textContent . ' @ '. $priceArray[$key] . PHP_EOL;
                }


        }
        

            private function get_page_html($url){

            // Initialisez une session CURL.
                $ch = curl_init();  
                
                // Récupérer le contenu de la page
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
                //Saisir l'URL et la transmettre à la variable.
                curl_setopt($ch, CURLOPT_URL, $url); 
                //Désactiver la vérification du certificat puisque waytolearnx utilise HTTPS
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                //Exécutez la requête 
                $html = curl_exec($ch); 
                // $this->getTag($html,"div");
                // echo $html;

                curl_close($ch); 
                return $html;
        }
        

        private function getTag($html,$tag,$productName){
            
            $result = array();
            $out = array();
            preg_match_all("#<".$tag."(?:\s*.*?)>([a-zA-Z]*)<\/".$tag.">#", $html, $out,PREG_SET_ORDER); 
            // print_r($out);
            foreach($out as $element){
                if(strpos($element[0],$productName)==false){

                }else{
                    array_push($result,$element[0]);
                }
            }
            return $result;
        }

        // private function get_html($url,$produit){

        //     // Initialisez une session CURL.
        //         $ch = curl_init();  
                
        //         // Récupérer le contenu de la page
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
        //         //Saisir l'URL et la transmettre à la variable.
        //         curl_setopt($ch, CURLOPT_URL, $url); 
        //         //Désactiver la vérification du certificat puisque waytolearnx utilise HTTPS
        //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //         //Exécutez la requête 
        //         $result = curl_exec($ch); 
        //         //Afficher le résultat
        //         echo $result;  
        // }


    // private function get_html($url) {
    //     if (strtoupper(substr($url,0,7))=="HTTP://") $url=substr($url,7);
    //     $p = strpos($url,"/");
    //     if ($p===FALSE) {
    //         $nom_domaine=$url;
    //         $get="/";
    //     }
    //     else {
    //             $nom_domaine=substr($url,0,$p);
    //             $get=substr($url,$p);
    //          }
         
    //     $errno=""; $errstr=""; $r="";
    //     $fp = fsockopen($nom_domaine, 80, $errno, $errstr, 15);
    //     if($fp) {
    //                 socket_set_timeout($fp, 15);
    //                 fputs($fp,"GET $get HTTP/1.1\r\n");
    //                 fputs($fp,"Host: $nom_domaine\r\n");
    //                 fputs($fp,"Connection: Close\r\n\r\n");
    //                 $r="";
    //                 while(!feof($fp)) {
    //                 $r.=fgets($fp,1024);
    //                 }
    //                 fclose($fp);
    //                 return($r);
    //             }
    //     return('');
    //     }
}
