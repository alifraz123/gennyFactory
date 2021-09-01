<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class report extends Controller
{
    public function MTN_CTN_Dispatch_method(Request $request)
    {
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->get(['supplier', 'date', 'invoice']);
        $cno = DB::table('dispatch_detail')->where('invoice', $dispatch[0]->invoice)->distinct()->get(['cno']);
        $dispatch_detail_array = [];
        for ($a = 0; $a < count($cno); $a++) {
            $bb = [];
            $ab = DB::table('dispatch_detail')->where('cno', $cno[$a]->cno)->distinct()->get(['ItemName']);
            for ($b = 0; $b < count($ab); $b++) {
                $total = 0;
                $for_total =  DB::table('dispatch_detail')->where('ItemName', $ab[$b]->ItemName)->distinct()->get(['qty']);
                for ($d = 0; $d < count($for_total); $d++) {
                    $total = $total + $for_total[$d]->qty;
                }
                $bb[$b] = array('items' => $ab[$b]->ItemName, 'qty_var' => DB::table('dispatch_detail')
                    ->where('ItemName', $ab[$b]->ItemName)->distinct()->get(['varient', 'qty']), 'total' => $total);
            }
            $dispatch_detail_array[$a] = array('cno' => $cno[$a]->cno, 'ItemName' => $bb);
        }
        $dispatch[0]->dispatch_detail = $dispatch_detail_array;
        return view('admin/modules/reports/MTN_CTN_Detail', ['dispatch' => $dispatch]);
    }

    public function MTN_Dispatch_method(Request $request){
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->get(['supplier', 'date', 'invoice','builtyNo','city']);
        $ItemNames = DB::table('dispatch_detail')->where('invoice', $dispatch[0]->invoice)->distinct()->get(['ItemName']);
        $dispatch_detail_array = [];
        for ($a = 0; $a < count($ItemNames); $a++) {
            $bb = [];
                $total = 0;
                $for_total =  DB::table('dispatch_detail')->where('ItemName', $ItemNames[$a]->ItemName)->distinct()->get(['qty']);
                for ($d = 0; $d < count($for_total); $d++) {
                    $total = $total + $for_total[$d]->qty;
                }
                $dispatch_detail_array[$a] = array('items' => $ItemNames[$a]->ItemName, 'qty_var' => DB::table('dispatch_detail')
                    ->where('ItemName', $ItemNames[$a]->ItemName)->distinct()->get(['varient', 'qty']), 'total' => $total);

             
        }
        $dispatch[0]->dispatch_detail = $dispatch_detail_array;
        return view('admin/modules/reports/MTN_Dispatch',['dispatch'=>$dispatch]);
    }
}
