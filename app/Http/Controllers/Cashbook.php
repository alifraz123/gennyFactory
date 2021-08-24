<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Cashbook extends Controller
{
    public function getPartyData_method(Request $request)
    {
        return DB::table('parties')->where('PartyName', $request->PartyName)->first();
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
        return  $bb - $aa;
    }
    public function sendCashbookData_method(Request $request)
    {
        $data =  DB::insert("insert into salebook(Ref,Date,City,BuiltyNo,Sender,Reciever,Total
        ,Rent,FinalTotal,Balance,Cash,Debit,Credit,Username,PartyName,Remarks)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            "cb", $request->Date, "0", "0", "0", "0", "0", "0", "0", $request->Balance, $request->Cash, "0", $request->Cash, Auth::user()->name, $request->PartyName, $request->Remarks
        ]);
    }
    public function updateCashbookData_method(Request $request)
    {
        $update = DB::table('salebook')->where('invoice', $request->invoice)->update([
            'Cash' => $request->Cash,
            'Credit' => $request->Cash,
            'Remarks' => $request->Remarks
        ]);
    }
    public function getCompleteReport_method(Request $request)
    {
        $result_sum = [];
        $data = DB::select("select distinct PartyName from salebook");
        for($a=0;$a<count($data);$a++){
            
            $sum = DB::table('salebook')->select("PartyName",
            DB::raw("sum(Rent) as rent"),
            DB::raw("sum(Total) as total"),
          
            DB::raw("sum(Debit) as debit"),
            DB::raw("sum(Credit) as credit")
            )->whereBetween('Date', [$request->startDate, $request->endDate])
            ->where('PartyName',$data[$a]->PartyName)->groupBy("PartyName")->get()->first();
            if($sum==null){
                $empty_value_object = array("PartyName"=>$data[$a]->PartyName, "rent"=>0, "total"=>0,"debit"=>0,"credit"=>0,"balance"=>0);
                
                array_push($result_sum,$empty_value_object);
            }
            else{
                $balance = DB::table('salebook')->select(
                    DB::raw("sum(Debit) as debit"),
                    DB::raw("sum(Credit) as credit")
                    )->whereBetween('Date', ['0000-00-00', $request->endDate])
                    ->where('PartyName',$data[$a]->PartyName)->get()->first();
                    $sum->balance=$balance->debit - $balance->credit;
                        array_push($result_sum,$sum);
            }
           
        }
        return $result_sum;
    }
    public function getOpeningBalance_method(Request $request){
        $sum = DB::table('salebook')->select(
        DB::raw("sum(Debit) as debit"),
        DB::raw("sum(Credit) as credit")
        )->whereBetween('Date', ['0000-00-00', $request->startDate])->Where('Date','!=',$request->startDate)
        ->where('PartyName',$request->PartyName)->get()->first();
        return $sum;

    }
}
