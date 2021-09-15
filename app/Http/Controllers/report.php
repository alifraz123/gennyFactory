<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class report extends Controller
{
    public function MTN_CTN_Dispatch_method(Request $request)
    {
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->whereBetween('Date',[$request->startDate, $request->endDate])->get(['supplier', 'date', 'invoice']);
       for($e=0; $e < count($dispatch); $e++){
        $cno = DB::table('dispatch_detail')->where('invoice', $dispatch[$e]->invoice)->distinct()->get(['cno']);
        $dispatch_detail_array = [];
        for ($a = 0; $a < count($cno); $a++) {
            $bb = [];
            $ab = DB::table('dispatch_detail')->where('cno', $cno[$a]->cno)->distinct()->get(['ItemName','cno']);
            for ($b = 0; $b < count($ab); $b++) {
                $total = 0;
                $for_total =  DB::table('dispatch_detail')->where('cno', $cno[$a]->cno)->where('ItemName', $ab[$b]->ItemName)->distinct()->get(['qty']);
                for ($d = 0; $d < count($for_total); $d++) {
                    $total = $total + $for_total[$d]->qty;
                }
                $bb[$b] = array('items' => $ab[$b]->ItemName, 'qty_var' => DB::table('dispatch_detail')
                    ->where('cno', $ab[$b]->cno)->where('ItemName', $ab[$b]->ItemName)->distinct()->get(['varient', 'qty']), 'total' => $total);
            }
            $dispatch_detail_array[$a] = array('cno' => $cno[$a]->cno, 'ItemName' => $bb);
        }
        $dispatch[$e]->dispatch_detail = $dispatch_detail_array;
       }
       
        
        return view('admin/modules/reports/MTN_CTN_Detail', ['dispatch' => $dispatch]);
    }

    public function getPurchaseReport_method(Request $request){
        // pdb means purchasebook data
        $pbd = DB::table('purchase_book')->where('vender',$request->vender_name)
        ->whereBetween('date',[$request->startDate,$request->endDate])
        ->get(['builtyNo','via_transport','dispatch_date','recieve_date','invoice']);
        for($a=0;$a < count($pbd); $a++){
            
        }



        // return view('admin/modules/reports/PurchaseReport');
    }

    public function MTN_Dispatch_method(Request $request){
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->whereBetween('Date',[$request->startDate, $request->endDate])->get(['supplier', 'date', 'invoice','builtyNo','city']);
        for($e=0; $e < count($dispatch); $e++){
            $ItemNames = DB::table('dispatch_detail')->where('invoice', $dispatch[$e]->invoice)->distinct()->get(['ItemName','cno']);
        $dispatch_detail_array = [];
        for ($a = 0; $a < count($ItemNames); $a++) {
            $bb = [];
                $total = 0;
                $for_total =  DB::table('dispatch_detail')->where('invoice', $dispatch[$e]->invoice)->where('ItemName', $ItemNames[$a]->ItemName)->distinct()->get(['qty']);
                for ($d = 0; $d < count($for_total); $d++) {
                    $total = $total + $for_total[$d]->qty;
                }
                $dispatch_detail_array[$a] = array('items' => $ItemNames[$a]->ItemName, 'qty_var' => DB::table('dispatch_detail')
                ->where('cno', $ItemNames[$a]->cno)->where('ItemName', $ItemNames[$a]->ItemName)->distinct()->get(['varient', 'qty']), 'total' => $total);

             
        }
        $dispatch[$e]->dispatch_detail = $dispatch_detail_array;
        }
        // return $dispatch;
        return view('admin/modules/reports/MTN_Dispatch',['dispatch'=>$dispatch]);
    }
}
