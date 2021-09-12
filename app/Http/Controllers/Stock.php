<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Stock extends Controller
{
    public function save_stockdata_method(Request $stock){
        $stock =  DB::insert("insert into stock(varient,itemname,company,semiFinish,finish,damage)
         values(?,?,?,?,?,?)",[$stock->Varient,$stock->itemname,$stock->company
         ,$stock->finish,$stock->semi_finish,$stock->damage]);
         if($stock){
             return redirect('/show_Stockdata')->with('status','inserted successfuly');
         }
         else{
            return redirect('/show_Stockdata')->with('failed','Not inserted ');
         }
        
     }
     public function save_stockdata_detail_method(Request $stock){
        $stock =  DB::insert("insert into stock_detail(date,company,itemname,finish,semiFinish)
         values(?,?,?,?,?)",[$stock->date,$stock->company,$stock->itemname
         ,$stock->finish,$stock->semi_finish]);
         if($stock){
             return redirect('/show_Stockdata_detail')->with('status','inserted successfuly');
         }
         else{
            return redirect('/show_Stockdata_detail')->with('failed','Not inserted ');
         }
        
     }
     
     public function show_Stockdata_method(Request $request){
         $stock = DB::table('stock')->get();
         $companies = DB::table('company')->get();
      
        return view('admin/modules/Stock/stock',['stocks'=>$stock,'companies'=>$companies]);
        
     }
     public function show_Stockdata_detail_method(Request $request){
        $stock = DB::table('stock_detail')->get();
        $companies = DB::table('company')->get();
     
       return view('admin/modules/Stock/stock_detail',['stocks'=>$stock,'companies'=>$companies]);
       
    }
     public function delete_stockdata_method($id){
         DB::table('stock')
             ->where('id', $id)
             ->delete();
             return redirect('/show_Stockdata');
     }
     public function delete_stockdata_detail_method($id){
        DB::table('stock_detail')
            ->where('id', $id)
            ->delete();
            return redirect('/show_Stockdata_detail');
    }
     public function edit_stockdata_method($id){
        $editdata =  DB::table('stock')->where('id', $id)->get();
         return ['data'=>$editdata];
     }
     public function edit_stockdata_detail_method($id){
        $editdata =  DB::table('stock_detail')->where('id', $id)->get();
         return ['data'=>$editdata];
     }
     public function update_Stockdata_method(Request $updatecompany){
         $data = DB::table('stock')
         ->where('id', $updatecompany->id)
         ->update([
             'varient' => $updatecompany->Varient,
             'itemname' => $updatecompany->itemname,
             'company' => $updatecompany->company,
             'semiFinish' => $updatecompany->finish,
             'finish' => $updatecompany->semi_finish,
             'damage' => $updatecompany->damage,
         ]);
         // return $data;
         if($data){
             return redirect('/show_Stockdata');
         }
     }

     public function update_Stockdata_detail_method(Request $updatecompany){
        $data = DB::table('stock_detail')
        ->where('id', $updatecompany->id)
        ->update([
            'date' => $updatecompany->date,
            'itemname' => $updatecompany->itemname,
            'company' => $updatecompany->company,
            'semiFinish' => $updatecompany->semi_finish,
            'finish' => $updatecompany->finish,
            
        ]);
        // return $data;
        if($data){
            return redirect('/show_Stockdata_detail');
        }
    }

     public function getItemsOfSelectedCompany_method(Request $getItems){
        $items = DB::table('items')->where('company',$getItems->company)->get();
        return $items;
     }
     public function getItemsOfSelectedCompany_For_dispatch_method(Request $getItems){
        $items = DB::table('stock')->where('company',$getItems->company)->where('finish','>',0)->distinct()->get('itemname');
        return $items;
     }
     public function getVarientsOfSelectedItem_For_dispatch_method(Request $request){
        $varients = DB::table('stock')->where('itemname',$request->ItemName)->where('finish','>',0)->distinct()->get('varient');
        return $varients;
     }
     
     public function getVarientsOfSelectedItem_For_purchase_method(Request $request){
        $varients = DB::table('material')->where('category',$request->material_type)
        ->distinct()->get('material');
        return $varients;
     }
}
