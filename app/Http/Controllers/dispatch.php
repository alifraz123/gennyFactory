<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class dispatch extends Controller
{
    public $startDate = '';
    public $endDate = '';
    public $partyName = '';
    public function dispatch_method(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $ab = DB::table('dispatch')->get();
        $invoice_r = 1;
        // $final_total = $request->FinalTotal;
        if ($ab->count() != 0) {
            $invoice_id = DB::table('dispatch')->latest('invoice')->first();
            $invoice = $invoice_id->invoice + 1;
        } else {
            $invoice = $invoice_r;
        }

        $dispatch =  DB::insert("insert into dispatch(Ref,invoice,supplier,date,company,city,address,zone 
        ,gatePass,builtyNo,remarks,Username)values(?,?,?,?,?,?,?,?,?,?,?,?)", [
            "sb", $invoice, $request->supplier, $request->Date, $request->company, $request->City, $request->address,
            $request->zone,
            $request->gatePass, $request->BuiltyNo, $request->Remarks, Auth::user()->name
        ]);

        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                'invoice' => $invoice,
                'ItemName' => $request->obj[$key]['itemname'],
                'qty' => $request->obj[$key]['quantity'],
                'varient' => $request->obj[$key]['varient'],
                'cno' => $request->obj[$key]['cno'],
            ];
            $dispatch_detail = DB::table('dispatch_detail')->insert($abc);

            $itemname = $request->obj[$key]['itemname'];
            $varient = $request->obj[$key]['varient'];
            $qty = $request->obj[$key]['quantity'];

            $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
            $remaining_finishProduct = $finishProduct->finish - $qty;
            DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
                'finish' => $remaining_finishProduct
            ]);
        }
        if ($dispatch && $dispatch_detail) {
            echo "inserted";
        }
    }

    
    public function getInvoicesForEdit_method(Request $request)
    {

        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['supplier'];
        $data = DB::table('dispatch')->whereBetween('date', [$startDate, $endDate])
            ->where('supplier', $partyName)->where('Ref', 'sb')->get();

        for ($a = 0; $a < count($data); $a++) {
            $data[$a]->startDate = $startDate;
            $data[$a]->endDate = $endDate;
            $data[$a]->partyName = $partyName;
        }
        // return $data;
        return view('admin/modules/SalesBook/showSaleInvoices', [
            'saleInvoices' => $data
        ]);
    }
    public function delete_dispatch()
    {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['partyName'];
        $invoice = $_GET['invoice'];
        $dispatch_detail =  DB::table('dispatch_detail')
            ->where('invoice', $invoice)
            ->delete();
        $dispatch =  DB::table('dispatch')
            ->where('invoice', $invoice)
            ->delete();
        if ($dispatch_detail && $dispatch) {
            return redirect('getInvoicesForEdit?startDate=' . $startDate . '&endDate=' . $endDate
                . '&supplier=' . $partyName);
        }
    }
    public function edit_invoice_method($id)
    {
        $salebook = DB::table('dispatch')->where('invoice', $id)->get();
        $salebook_detail = DB::table('dispatch_detail')->where('invoice', $id)->get();
        $cities = DB::table('sup_and_ven')->get();
        $parties = DB::table('stock')->get();
        $items = DB::table('items')->get();
        return view(
            'admin/modules/SalesBook/edit_invoice',
            ['salebook' => $salebook, 'salebook_detail' => $salebook_detail, 'parties' => $parties, 'items' => $items, 'cities' => $cities]
        );
    }


    public function update_dispatch(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $dispatch = DB::table('dispatch')->where('invoice', $request->invoice_edit)->update([
            'supplier' => $request->supplier,
            'date' => $request->Date,
            'company' => $request->company,
            'city' => $request->City,
            'address' => $request->address,
            'zone' => $request->zone,
            'gatePass' => $request->gatePass,
            'builtyNo' => $request->BuiltyNo,
            'remarks' => $request->Remarks,

        ]);


        $dispatch_detail_data = DB::table('dispatch_detail')->where('invoice', $request->invoice_edit)->get();

        for ($a = 0; $a < count($dispatch_detail_data); $a++) {

            $dispatach_detail_qty = DB::table('dispatch_detail')->where('invoice', $request->invoice_edit)
            ->where('itemname', $dispatch_detail_data[$a]->ItemName)
                ->where('varient', $dispatch_detail_data[$a]->varient)->first('qty');

            $stock_qty = DB::table('stock')->where('itemname', $dispatch_detail_data[$a]->ItemName)
                ->where('varient', $dispatch_detail_data[$a]->varient)->first('finish');
                
            $remaining_finishProduct = $dispatach_detail_qty->qty + $stock_qty->finish;

            DB::table('stock')->where('itemname', $dispatch_detail_data[$a]->ItemName)
                ->where('varient', $dispatch_detail_data[$a]->varient)->update([
                    'finish' => $remaining_finishProduct
                ]);
        }

        $delete = DB::table('dispatch_detail')->where('invoice', $request->invoice_edit)->delete();
        if ($delete) {
            $abc = [];
            foreach ($request->obj as $key => $value) {
                $abc = [
                    'invoice' => $request->invoice_edit,
                    'ItemName' => $request->obj[$key]['itemname'],
                    'qty' => $request->obj[$key]['quantity'],
                    'varient' => $request->obj[$key]['varient'],
                    'cno' => $request->obj[$key]['cno'],
                ];
                $dispatch_detail = DB::table('dispatch_detail')->insert($abc);

                $itemname = $request->obj[$key]['itemname'];
                $varient = $request->obj[$key]['varient'];
                $qty = $request->obj[$key]['quantity'];

                $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
                $remaining_finishProduct = $finishProduct->finish - $qty;
                DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
                    'finish' => $remaining_finishProduct
                ]);
            }
        }
        if ($dispatch || $dispatch_detail) {
            echo "inserted";
        }
    }



    public function getDateOfSelectedSupplier_method(Request $request)
    {
        return DB::table('sup_and_ven')->where('name', $request->supplier)->get()->first();
    }
}
