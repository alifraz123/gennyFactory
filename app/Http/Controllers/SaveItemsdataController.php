<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SaveItemsdataController extends Controller
{
    public function save_citydata_method(Request $party){
        $data =  DB::insert("insert into items(ItemName,Category,Rate,Quantity)
         values(?,?,?,?)",[$party->ItemName,$party->Category,$party->Rate,$party->Quantity]);
         if($data){
             return redirect('/show_itemsdata')->with('status','inserted successfuly');
         }
         else{
            return redirect('/show_itemsdata')->with('failed','Not inserted ');
         }
        
     }
     public function show_companydata_method(Request $request){
         $items = DB::table('items')->get();
       
        return view('admin/modules/Items/item',['items'=>$items]);
        
     }
     public function delete_companydata_method($id){
         DB::table('items')
             ->where('ItemName', $id)
             ->delete();
             return redirect('/show_itemsdata');
     }
     public function edit_companydata_method($id){
        $editdata =  DB::table('items')
         ->where('ItemName', $id)
         ->get();
         return view('/admin/modules/Items/itemedit',['data'=>$editdata]);
     }
     public function update_companydata_method(Request $updatecompany){
         $data = DB::table('items')
         ->where('ItemName', $updatecompany->id)
         ->update([
             'ItemName' => $updatecompany->ItemName,
             'Category' => $updatecompany->Category,
             'Rate' => $updatecompany->Rate,
             'Quantity' => $updatecompany->Quantity,
         ]);
         // return $data;
         if($data){
             return redirect('/show_itemsdata');
         }
     }
}
