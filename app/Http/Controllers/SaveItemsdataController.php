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

     public function MaterialItems_method(Request $items){
          $items =  DB::insert("insert into material_items(material_item_name,category)
         values(?,?)",[$items->material_item_name,$items->category]);
         if($items){
             return redirect('/MaterialItems')->with('status','inserted successfuly');
         }
         else{
            return redirect('/MaterialItems')->with('failed','Not inserted ');
         }
     }


     public function insertMaterialItemNames_method(Request $request)
    {

        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                
                'material_item_name' => $request->obj[$key]['material_item_name'],
                'category' => $request->obj[$key]['category'],
                
            ];
            $material_items = DB::table('material_items')->insert($abc);

        }
        if ($material_items) {
            echo "inserted";
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
