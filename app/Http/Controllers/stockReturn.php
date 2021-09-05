<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stockReturn extends Controller
{
    public function addReturn_method(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $ab = DB::table('stockreturn')->get();
        $invoice_r = 1;
        // $final_total = $request->FinalTotal;
        if ($ab->count() != 0) {
            $invoice_id = DB::table('stockreturn')->latest('invoice')->first();
            $invoice = $invoice_id->invoice + 1;
        } else {
            $invoice = $invoice_r;
        }

        $dispatch =  DB::insert("insert into stockreturn(invoice,supplier,date,company,city,zone,address,remarks,Username)
        values(?,?,?,?,?,?,?,?,?)", [
            $invoice, $request->supplier, $request->Date, $request->company, $request->City,$request->zone, $request->address,
            $request->Remarks, Auth::user()->name
        ]);

        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                'invoice' => $invoice,
                'ItemName' => $request->obj[$key]['itemname'],
                'qty' => $request->obj[$key]['quantity'],
                'varient' => $request->obj[$key]['varient'],
            ];
            $dispatch_detail = DB::table('stockreturn_detail')->insert($abc);

            $itemname = $request->obj[$key]['itemname'];
            $varient = $request->obj[$key]['varient'];
            $qty = $request->obj[$key]['quantity'];

            $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
            $remaining_finishProduct = $finishProduct->finish + $qty;
            DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
                'finish' => $remaining_finishProduct
            ]);
        }
        if ($dispatch && $dispatch_detail) {
            echo "inserted";
        }
    }

    public function getReturnInvoicesForEdit_method(Request $request)
    {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['supplier'];
        $data = DB::table('stockreturn')->whereBetween('date', [$startDate, $endDate])->get();

        for ($a = 0; $a < count($data); $a++) {
            $data[$a]->startDate = $startDate;
            $data[$a]->endDate = $endDate;
            $data[$a]->partyName = $partyName;
        }
        // return $data;
        return view('admin/modules/Return/showReturnInvoices', [
            'saleInvoices' => $data
        ]);
    }


    public function delete_return_invoice()
    {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['partyName'];
        $invoice = $_GET['invoice'];
        $dispatch_detail =  DB::table('stockreturn_detail')
            ->where('invoice', $invoice)
            ->delete();
        $dispatch =  DB::table('stockreturn')
            ->where('invoice', $invoice)
            ->delete();
        if ($dispatch_detail && $dispatch) {
            return redirect('getReturnInvoicesForEdit?startDate=' . $startDate . '&endDate=' . $endDate
                . '&supplier=' . $partyName);
        }
    }
    public function edit_Returninvoice_method($id)
    {
        $salebook = DB::table('stockreturn')->where('invoice', $id)->get();
        $salebook_detail = DB::table('stockreturn_detail')->where('invoice', $id)->get();
        $cities = DB::table('sup_and_ven')->get();
        $parties = DB::table('stock')->get();
        $items = DB::table('items')->get();
        return view(
            'admin/modules/Return/edit_return_invoice',
            ['salebook' => $salebook, 'salebook_detail' => $salebook_detail, 'parties' => $parties, 'items' => $items, 'cities' => $cities]
        );
    }


    public function update_stockReturn(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $dispatch = DB::table('stockreturn')->where('invoice', $request->invoice_edit)->update([
            'supplier' => $request->supplier,
            'date' => $request->Date,
            'company' => $request->company,
            'city' => $request->City,
            'address' => $request->address,
            'zone' => $request->zone,
           
            'remarks' => $request->Remarks,

        ]);

        $delete = DB::table('stockreturn_detail')->where('invoice', $request->invoice_edit)->delete();
        if ($delete) {
            $abc = [];
            foreach ($request->obj as $key => $value) {
                $abc = [
                    'invoice' => $request->invoice_edit,
                    'ItemName' => $request->obj[$key]['itemname'],
                    'qty' => $request->obj[$key]['quantity'],
                    'varient' => $request->obj[$key]['varient'],
                   
                ];
                $dispatch_detail = DB::table('stockreturn_detail')->insert($abc);

                $itemname = $request->obj[$key]['itemname'];
                $varient = $request->obj[$key]['varient'];
                $qty = $request->obj[$key]['quantity'];
    
                $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
                $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
                $remaining_finishProduct = $finishProduct->finish + $qty;
                DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
                    'finish' => $remaining_finishProduct
                ]);

            }
        }
        if ($dispatch || $dispatch_detail) {
            echo "inserted";
        }
    }
}
