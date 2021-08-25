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
     public function show_Stockdata_method(Request $request){
         $stock = DB::table('stock')->get();
         $items = DB::table('items')->get();
      
        return view('admin/modules/Stock/stock',['stocks'=>$stock,'items'=>$items]);
        
     }
     public function delete_stockdata_method($id){
         DB::table('stock')
             ->where('id', $id)
             ->delete();
             return redirect('/show_Stockdata');
     }
     public function edit_stockdata_method($id){
        $editdata =  DB::table('stock')
         ->where('id', $id)
         ->get();
         return view('/admin/modules/Stock/stockedit',['data'=>$editdata]);
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
}
