<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Recepies extends Controller
{
    public function show(){
        $myProducts = DB::table('products_units','pu')
            ->join('products as p', 'p.product_id', '=', 'pu.product_id')
            ->join('storages as s', 's.storage_id', '=', 'p.storage_id')
            ->join('units as u', 'u.unit_id', '=', 'pu.unit_id')
            ->select('p.product_id','p.name','pu.quantity','u.short_name as unit')
            ->get();


        $recepies = DB::table('recepies')->get();

        $ingridients = [];
        $statuses = [];
        foreach($recepies as $recepy){

            $_ingridients = DB::table('recepies_ingridients','ri')
            ->join('products as p','p.product_id','=','ri.product_id')
            ->join('units as u','u.unit_id','=','ri.unit_id')
            ->where('ri.recepy_id', '=' ,$recepy->recepy_id)
            ->select('p.product_id','p.name as product','u.short_name as unit','ri.quantity')
            ->get();

            $count = 0;
            foreach ($_ingridients as $ingridient) {
                foreach ($myProducts as $product) {
                    if ($product->product_id == $ingridient->product_id && $product->quantity >= $ingridient->quantity && $product->unit == $ingridient->unit) {
                        $count = isset($count) ? $count + 1 :0;
                    }
                }

                $statuses[$recepy->recepy_id] = ($count == count($_ingridients)) ? 'bg-success':'bg-danger';
            }

            $ingridients[$recepy->recepy_id] = $_ingridients;
        }
        
        return view('pages.recepies', [
            'myProducts' => $myProducts,
            'recepies' => $recepies,
            'ingridients' => $ingridients,
            'statuses' => $statuses
        ]);
    }
}
