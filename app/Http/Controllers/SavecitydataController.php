<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SavecitydataController extends Controller
{
    public function save_svdata_method(Request $sv){
        $data =  DB::insert("insert into sup_and_ven(name,phoneNo,cnic,address,type) values(?,?,?,?,?)",
        [$sv->name,$sv->phoneNo,$sv->cnic,$sv->address,$sv->type,]);
         if($data){
             return redirect('/show_svdata')->with('status','Inserted Successfuly');
         }
         else{
            return redirect('/show_svdata')->with('failed','Not Inserted ');
         }
 
     }
     public function show_svdata_method(Request $request){
         $sup_and_ven = DB::table('sup_and_ven')->get();
         
         return view('admin/modules/Supplier_and_Vender/sv',['sup_and_ven'=>$sup_and_ven]);
        
     }
     public function delete_svdata_method($id){
         DB::table('sup_and_ven')
             ->where('phoneNo', $id)
             ->delete();
             return redirect('/show_svdata');
     }
     public function edit_svdata_method($id){
        $editdata =  DB::table('sup_and_ven')
         ->where('phoneNo', $id)
         ->get();
        //  return $editdata;
         return view('/admin/modules/Supplier_and_Vender/svedit',['data'=>$editdata]);
     }
     public function update_svdata_method(Request $updatecompany){
         $data = DB::table('sup_and_ven')
         ->where('phoneNo', $updatecompany->id)
         ->update([
             'name' => $updatecompany->name,
             'phoneNo' => $updatecompany->phoneNo,
             'cnic' => $updatecompany->cnic,
             'address' => $updatecompany->address,
             'type' => $updatecompany->type
         ]);
         // return $data;
         if($data){
             return redirect('/show_svdata');
         }
     }
}
