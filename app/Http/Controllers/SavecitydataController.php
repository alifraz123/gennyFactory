<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SavecitydataController extends Controller
{
    public function save_citydata_method(Request $party){
        $data =  DB::insert("insert into cities(CityName) values(?)",[$party->CityName]);
         if($data){
             return redirect('/show_citydata')->with('status','Inserted Successfuly');
         }
         else{
            return redirect('/show_citydata')->with('failed','Not Inserted ');
         }
 
     }
     public function show_companydata_method(Request $request){
         $cities = DB::table('cities')->get();
         
         return view('admin/modules/Cities/city',['cities'=>$cities]);
        
     }
     public function delete_companydata_method($id){
         DB::table('cities')
             ->where('CityName', $id)
             ->delete();
             return redirect('/show_citydata');
     }
     public function edit_companydata_method($id){
        $editdata =  DB::table('cities')
         ->where('CityName', $id)
         ->get();
        //  return $editdata;
         return view('/admin/modules/Cities/cityedit',['data'=>$editdata]);
     }
     public function update_companydata_method(Request $updatecompany){
         $data = DB::table('cities')
         ->where('CityName', $updatecompany->id)
         ->update([
             'CityName' => $updatecompany->CityName
         ]);
         // return $data;
         if($data){
             return redirect('/show_citydata');
         }
     }
}
