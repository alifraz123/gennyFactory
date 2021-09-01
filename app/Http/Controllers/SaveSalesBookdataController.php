<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SaveSalesBookdataController extends Controller
{
    public function save_partydata_method(Request $party){
        
        $salebook =  DB::insert("insert into salebook(Ref,invoice,Date,BuiltyNo,Sender,Reciever,Total,Rent,FinalTotal,Cash,Debit,Credit,Balance
        ,Username,PartyName,City,Remarks)
         values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",['sb',$party->invoice,$party->Date,$party->BuiltyNo,$party->Sender,$party->Reciever,
         $party->Total,$party->Rent,$party->FinalTotal,$party->Cash,"debit",0,$party->Balance,Auth::user()->name,$party->PartyName,$party->City,$party->Remarks]);
         
        //  $salebook_detail =  DB::insert("insert into salebook_detail(invoice,ItemName,Rate,Category,Quantity)
        //  values(?,?,?,?,?)",[$random_invoice_number,$party->ItemName,$party->Rate,$party->Category,$party->Quantity]);
        
         if($salebook){
             return redirect('/salesbook');
         }
        
 
     }

     public function addProductDetail_method(Request $party){
        $random_invoice_number = 66;
        $salebook_detail =  DB::insert("insert into salebook_detail(invoice,ItemName,Rate,Category,Quantity)
        values(?,?,?,?,?)",[$party->invoice,$party->ItemName,$party->Rate,$party->Category,$party->Quantity]);
        if($salebook_detail){

            return redirect('/salesbook');
        }
     }

     public function getInvoicesForEdit_method(Request $request){
         $startDate = $_GET['startDate'];
         $endDate = $_GET['endDate'];
         $partyName = $_GET['PartyName'];
         $data = DB::table('salebook')->whereBetween('Date',[$startDate,$endDate])
         ->where('PartyName',$partyName)->where('Ref','sb')->paginate(5);
         $data->appends($request->all());
        return view('admin/modules/SalesBook/showSaleInvoices',['saleInvoices'=>$data]);
     }

     public function getCashBookForEdit_method(Request $request){
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['PartyName'];
        $data = DB::table('salebook')->whereBetween('Date',[$startDate,$endDate])
        ->where('PartyName',$partyName)->where('Ref','cb')->paginate(5);
        $data->appends($request->all());
       return view('admin/modules/cashbook/showCashbook',['saleInvoices'=>$data]);
    }
     public function edit_invoice_method($id){
         $salebook = DB::table('salebook')->where('invoice',$id)->get()->first();
         $salebook_detail = DB::table('salebook_detail')->where('invoice',$id)->get();
         $cities = DB::table('cities')->get();
         $parties = DB::table('parties')->get();
         $items = DB::table('items')->get();
         return view('admin/modules/SalesBook/edit_invoice',
         ['salebook'=>$salebook,'salebook_detail'=>$salebook_detail,'parties'=>$parties,'items'=>$items,'cities'=>$cities]);
     }
     public function edit_cashbook_method($id){
        $cashbook = DB::table('salebook')->where('invoice',$id)->get()->first();
        
        $partyCode_and_partyAddress = DB::table('parties')->where('PartyName',$cashbook->PartyName)->get()->first();
        $parties = DB::table('parties')->get();
        return view('admin/modules/cashbook/edit_cashbook',
        ['cashbook'=>$cashbook,'parties'=>$parties,'partyCode_and_partyAddress'=>$partyCode_and_partyAddress]);
    }

     public function show_companydata_method(){
       return  $parties = DB::table('salebook')->get();
         
     }

     public function show_salesbookdetaildata_withrespect_last_id(Request $request){
        $aa =   DB::table('salebook_detail')->where('invoice',$request->getDataOfCurrentInvoice)->get();
        return $aa;
     }

     public function getSelectedProductData_method(Request $request){
       return DB::table('items')->where('ItemName',$request->id)->get();
        
     }
     public function getCityOfSelectedParty_method(Request $request){
        return DB::table('parties')->where('PartyName',$request->id)->get()->first();
         
      }
     public function getSelectedProductData_total_method(Request $request){
      return DB::table('salebook_detail')->where('invoice',$request->id)->get();
       
     }
     public function getItemNamesForSaleDetail(){
        return DB::table('items')->get();
     }

     public function delete_salesbook_product_data($id){
        DB::table('salebook_detail')
        ->where('id', $id)
        ->delete();
        return redirect('/salesbook');
     }
     public function deleteProduct_method(Request $request){
        DB::table('salebook_detail')
        ->where('id', $request->product_id)
        ->delete();
        return redirect('/salesbook');
     }


     public function delete_companydata_method($id){
         DB::table('salebook')
             ->where('invoice', $id)
             ->delete();
             return redirect('/salesbook');
     }
     public function edit_companydata_method($id){
        $editdata =  DB::table('salebook')
         ->where('invoice', $id)
         ->get();

         $salebook_detail =  DB::table('salebook_detail')
         ->where('invoice', $id)
         ->get();
         // return $editdata;
         return view('/admin/modules/Salesbook/salesbookedit',['data'=>$editdata,'salebook_detail'=>$salebook_detail]);
     }
     public function update_companydata_method(Request $updatecompany){
         $data = DB::table('salebook')
         ->where('invoice', $updatecompany->id)
         ->update([
             'Ref' => $updatecompany->Ref,
             'Date' => $updatecompany->Date,
             'BuiltyNo' => $updatecompany->BuiltyNo,
             'Sender' => $updatecompany->Sender,
             'Reciever' => $updatecompany->Reciever,
             'Total' => $updatecompany->Total,
             'Rent' => $updatecompany->Rent,
             'FinalTotal' => $updatecompany->FinalTotal,
             'Cash' => $updatecompany->Cash,
             'Debit' => $updatecompany->Debit,
             'Credit' => $updatecompany->Credit,
             'Balance' => $updatecompany->Balance,
             'Username' => Auth::user()->name,
             'PartyName' => $updatecompany->PartyName,
             'City' => $updatecompany->City,
             'Remarks' => $updatecompany->Remarks
         ]);

         $salebook_detail = DB::table('salebook_detail')
         ->where('invoice', $updatecompany->id)
         ->update([
             'ItemName' => $updatecompany->ItemName,
             'Rate' => $updatecompany->Rate,
             'Category' => $updatecompany->Category,
             'Quantity' => $updatecompany->Quantity,
             
         ]);
         // return $data;
         if($data&&$salebook_detail){
             return redirect('/salesbook');
         }
     }
}
