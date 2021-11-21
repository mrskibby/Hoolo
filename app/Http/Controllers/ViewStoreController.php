<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class ViewStoreController extends Controller
{
   

    public function view(Request $request, $uuid,$title){

        require_once 'price.php';

        $store = Store::where('uuid','=',$uuid)->orWhere('name',$title)->first();

        if(!$store){
            notify()->error('Store not found !','404');
            return back();
        }

        if($store->uuid == '' || $uuid == 0){
            notify()->error('If you\'re store owner than update store once to get a unique id !','Attention !');
            return back();
        }


        if($request->sort == 'A-Z'){

            $items = $store->products->sortBy('name');

        }elseif($request->sort == 'Z-A'){

            $items = $store->products->sortByDesc('name');

        }else{

            $items = $store->products->sortBy('name');

        }

        

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $itemCollection = collect($items);

        // Define how many items we want to be visible in each page
        $perPage = $request->limit ?? 10;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $products = new LengthAwarePaginator($currentPageItems, count($itemCollection) , $perPage);

        
        // set url path for generted links
        $products->setPath($request->url());

        /** Google Reviews */

        

        $google_reviews = array();


        if($store->show_google_reviews == 1){

            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json',[
                'key'     => $store->google_place_api_key,
                'placeid' => $store->google_place_id
            ]);

            if($response->successful()){
                $response = $response->json();
    
               if($response['status'] == 'OK'){
                $google_reviews = array(
                    'rating'  => $response['result']['rating'],
                    'reviews' => $response['result']['reviews']
                );
               }
    
            }
        }


        return view('front.viewstore',compact('conversion_rate','store','products','google_reviews'));

    }
}
