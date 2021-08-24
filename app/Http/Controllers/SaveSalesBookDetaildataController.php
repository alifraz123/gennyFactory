<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SaveSalesBookDetaildataController extends Controller
{
    public function save_partydata_method(Request $party){
        $data =  DB::insert("insert into parties(PartyCode,PartyName,CNIC,NTN,SalesTex,Cell,Adress,City)
         values(?,?,?,?,?,?,?,?)",[$party->PartyCode,$party->PartyName,$party->CNIC,$party->NTN,$party->SalesTex,$party->Cell,$party->Adress,$party->City]);
        
         if($data){
             return redirect('/parties');
         }
 
     }
     public function show_companydata_method(){
       return  $parties = DB::table('salebook_detail')->get();
        
     }

     

     public function delete_companydata_method($id){
         DB::table('parties')
             ->where('PartyCode', $id)
             ->delete();
             return redirect('/parties');
     }
     public function edit_companydata_method($id){
        $editdata =  DB::table('company')
         ->where('CompanyName', $id)
         ->get();
         // return $editdata;
         return view('/admin/modules/company/companyedit',['data'=>$editdata]);
     }
     public function update_companydata_method(Request $updatecompany){
         $data = DB::table('company')
         ->where('CompanyName', $updatecompany->id)
         ->update([
             'CompanyName' => $updatecompany->CompanyName,
             'CompanyCode' => $updatecompany->CompanyCode
         ]);
         // return $data;
         if($data){
             return redirect('/company');
         }
     }
}
