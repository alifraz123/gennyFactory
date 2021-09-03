<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SaveItemsdataController extends Controller
{
    public function save_itemsdata_method(Request $items){
        $items =  DB::insert("insert into items(itemname,company)
         values(?,?)",[$items->ItemName,$items->Company]);
         if($items){
             return redirect('/show_itemsdata')->with('status','inserted successfuly');
         }
         else{
            return redirect('/show_itemsdata')->with('failed','Not inserted ');
         }
        
     }

     public function show_itemsdata_method(Request $request){
         $items = DB::table('items')->get();
         $companies = DB::table('company')->get();
        return view('admin/modules/Items/item',['items'=>$items,'companies'=>$companies]);
        
     }
     public function delete_itemsdata_method($id){
         DB::table('items')
             ->where('ItemName', $id)
             ->delete();
             return redirect('/show_itemsdata');
     }
     public function edit_itemsdata_method($id){
        $editdata =  DB::table('items')
         ->where('itemname', $id)
         ->get();
         $companies = DB::table('company')->get();
         return ['data'=>$editdata,'companies'=>$companies];
     }
     public function update_itemsdata_method(Request $updatecompany){
         $data = DB::table('items')
         ->where('itemname', $updatecompany->id)
         ->update([
             'itemname' => $updatecompany->ItemName,
             'company' => $updatecompany->Company
         ]);
         // return $data;
         if($data){
             return redirect('/show_itemsdata');
         }
     }
}
