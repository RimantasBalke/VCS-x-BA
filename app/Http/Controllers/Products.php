<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Products extends Controller
{
    public function show(){
        $products = DB::table('products', 'p')
            ->join('products_categories as pc', 'p.category_id', '=', 'pc.product_category_id')
            ->join('storages as s', 's.storage_id', '=', 'p.storage_id')
            ->join('category_units as cu', 'cu.category_id', '=', 'pc.product_category_id')
            ->join('units as u', 'u.unit_id', '=', 'cu.unit_id')
            ->select('pc.name as category_name',
                'p.name',
                'p.category_id',
                'p.product_id as id',
                's.alias as storage_alias',
                'u.short_name as unit',
                'u.unit_id as unit_id'
            )
            ->get();

        $groupedProducts = [];

        if($products){
            foreach ($products as $product){
                $groupedProducts[$product->storage_alias][$product->id]['data'] = $product;
                $groupedProducts[$product->storage_alias][$product->id]['units'][$product->unit_id] = $product->unit;
            }
        }

        return view('pages.start', [
            'products' => $groupedProducts
        ]);
    }

    public function add(Request $request)
    {
        DB::table('products_units','pu')
            ->join('products as p', 'p.product_id', '=', 'pu.product_id')
            ->join('storages as s', 's.storage_id', '=', 'p.storage_id')
            ->where('s.alias','=', $request->type)
            ->select('pu.product_unit_id')
            ->delete();
        
        if(!empty($request->selected)){
            foreach ($request->selected as $key =>  $selectedProduct){
    
                DB::table('products_units')->insert([
                    'product_id' => $key,
                    'unit_id' => $request->units[$key],
                    'quantity' => $request->quantity[$key],
                ]);
            }
        }


        return redirect()->route('recepies');
    }
}
