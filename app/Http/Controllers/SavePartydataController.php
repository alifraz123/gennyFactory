<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SavePartydataController extends Controller
{
    public function save_partydata_method(Request $party)
    {
        $data =  DB::insert("insert into parties(PartyCode,PartyName,CNIC,NTN,SalesTex,Cell,Adress,City)
        values(?,?,?,?,?,?,?,?)", [$party->PartyCode, $party->PartyName, $party->CNIC, $party->NTN, $party->SalesTex, $party->Cell, $party->Adress, $party->City]);
        if ($data) {
            return redirect('/show_companydata')->with('status','inserted successfuly');
        }
        else{
            return redirect('/show_companydata')->with('failed','Not inserted ');
        }
    }

    public function sendMultipleData_method(Request $request)
    {
        $ab = DB::table('salebook')->get();
        $invoice_r = 1;
        $final_total = $request->FinalTotal;
        if ($ab->count() != 0) {
            $invoice_id = DB::table('salebook')->latest('invoice')->first();
            $invoice = $invoice_id->invoice + 1;
        } else {
            $invoice = $invoice_r;
        }

        $data =  DB::insert("insert into salebook(Ref,invoice,Date,City,BuiltyNo,Sender,Reciever,Total
        ,Rent,FinalTotal,Balance,Debit,Username,PartyName,Remarks)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            "sb", $invoice, $request->Date, $request->City, $request->BuiltyNo, $request->Sender, $request->Reciever,
             $request->Total, $request->Rent, $final_total, $request->Balance, $final_total, Auth::user()->name, $request->PartyName, $request->Remarks
        ]);


        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                'invoice' => $invoice,
                'ItemName' => $request->obj[$key]['ItemName'],
                'Rate' => $request->obj[$key]['Rate'],
                'Category' => $request->obj[$key]['Category'],
                'Quantity' => $request->obj[$key]['Quantity'],
                'Total' => $request->obj[$key]['Total']

            ];
            DB::table('salebook_detail')->insert($abc);
        }
    }

    public function sendMultipleData_edit(Request $request)
    {
        $update = DB::table('salebook')->where('invoice', $request->invoice_edit)->update([
            'Date' => $request->Date,
            'City' => $request->City,
            'BuiltyNo' => $request->BuiltyNo,
            'Sender' => $request->Sender,
            'Reciever' => $request->Reciever,
            'Total' => $request->Total,
            'Rent' => $request->Rent,
            'FinalTotal' => $request->FinalTotal,
            'Balance' => $request->Balance,
            'Debit' => $request->FinalTotal,
            'PartyName' => $request->PartyName,
            'Remarks' => $request->Remarks,
        ]);

        $delete = DB::table('salebook_detail')->where('invoice', $request->invoice_edit)->delete();
        if ($delete) {
            $abc = [];
            foreach ($request->obj as $key => $value) {
                $abc = [
                    'invoice' => $request->invoice_edit,
                    'ItemName' => $request->obj[$key]['ItemName'],
                    'Rate' => $request->obj[$key]['Rate'],
                    'Category' => $request->obj[$key]['Category'],
                    'Quantity' => $request->obj[$key]['Quantity'],
                    'Total' => $request->obj[$key]['Total']

                ];
               DB::table('salebook_detail')->insert($abc);
               
            }
           
        }
       
    }

    public function getBalanceOfCurrentParty_method(Request $request)
    {
        $debit = DB::table('salebook')->where('PartyName', $request->PartyName)->get('Debit');
        $aa = 0;
        $bb = 0;
        for ($a = 0; $a < count($debit); $a++) {
            $aa = $aa + $debit[$a]->Debit;
        }
        $credit = DB::table('salebook')->where('PartyName', $request->PartyName)->get('Credit');
        for ($b = 0; $b < count($credit); $b++) {
            $bb = $bb + $credit[$b]->Credit;
        }
        return  $aa - $bb;
    }
    public function getDebitOfCurrentParty_method(Request $request)
    {
        $debit = DB::table('salebook')->where('PartyName', $request->PartyName)
        ->whereBetween('Date',[$request->startDate,$request->endDate])->get('Debit');
        $aa = 0;
        for ($a = 0; $a < count($debit); $a++) {
            $aa = $aa + $debit[$a]->Debit;
        }
       
        return $aa;
    }
    public function getCreditOfCurrentParty_method(Request $request)
    {
       
        $bb = 0;   
        $credit = DB::table('salebook')->where('PartyName', $request->PartyName)
        ->whereBetween('Date',[$request->startDate,$request->endDate])->get('Credit');
        for ($b = 0; $b < count($credit); $b++) {
            $bb = $bb + $credit[$b]->Credit;
        }
        return $bb;
    }

    public function getDebit_method(Request $request)
    {
        $debit = DB::table('salebook')->whereBetween('Date',[$request->startDate,$request->endDate])->get('Debit');
        $aa = 0;
        for ($a = 0; $a < count($debit); $a++) {
            $aa = $aa + $debit[$a]->Debit;
        }
       
        return $aa;
    }
    public function getCredit_method(Request $request)
    {
      
        $bb = 0;
        
        $credit = DB::table('salebook')->whereBetween('Date',[$request->startDate,$request->endDate])->get('Credit');
        for ($b = 0; $b < count($credit); $b++) {
            $bb = $bb + $credit[$b]->Credit;
        }
        return $bb;
    }

    public function show_companydata_method(Request $request)
    {
         $parties = DB::table('parties')->get();
        //  $parties->appends($request->all());
         return view('admin/modules/Parties/company',['parties'=>$parties]);
    }
    public function delete_companydata_method($id)
    {
        DB::table('parties')
            ->where('PartyCode', $id)
            ->delete();
        return redirect('/show_companydata');
    }
    public function edit_companydata_method($id)
    {
        $editdata =  DB::table('parties')
            ->where('PartyCode', $id)
            ->get();
        // return $editdata;
        return view('/admin/modules/Parties/companyedit', ['data' => $editdata]);
    }
    public function update_companydata_method(Request $updatecompany)
    {
        $data = DB::table('parties')
            ->where('PartyCode', $updatecompany->id)
            ->update([
                'PartyCode' => $updatecompany->PartyCode,
                'PartyName' => $updatecompany->PartyName,
                'CNIC' => $updatecompany->CNIC,
                'NTN' => $updatecompany->NTN,
                'SalesTex' => $updatecompany->SalesTex,
                'Cell' => $updatecompany->Cell,
                'Adress' => $updatecompany->Adress,
                'City' => $updatecompany->City,
            ]);
        // return $data;
        if ($data) {
            return redirect('/show_companydata');
        }
    }
}
