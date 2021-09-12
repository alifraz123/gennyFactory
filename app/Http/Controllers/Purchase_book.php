<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Purchase_book extends Controller
{
    public $startDate = '';
    public $endDate = '';
    public $partyName = '';
    public function purchasebook_method(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $ab = DB::table('purchase_book')->get();
        $invoice_r = 1;
        // $final_total = $request->FinalTotal;
        if ($ab->count() != 0) {
            $invoice_id = DB::table('purchase_book')->latest('invoice')->first();
            $invoice = $invoice_id->invoice + 1;
        } else {
            $invoice = $invoice_r;
        }

        $dispatch =  DB::insert("insert into purchase_book(invoice,date,vender,builtyNo,via_transport
        ,zone,city,address 
        ,remarks,Username,dispatch_date,recieve_date)values(?,?,?,?,?,?,?,?,?,?,?,?)", [
             $invoice, $request->Date, $request->vender, $request->BuiltyNo,$request->via ,
             $request->zone, $request->City, $request->address,
           
              $request->Remarks, Auth::user()->name,
            $request->dispatchDate,$request->recieveDate
        ]);

        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                'invoice' => $invoice,
                'ItemName' => $request->obj[$key]['itemname'],
                'qty' => $request->obj[$key]['quantity'],
                'varient' => $request->obj[$key]['varient'],
                'carton_qty' => $request->obj[$key]['ctn_qty'],
                'category' => $request->obj[$key]['category'],
            ];
            $dispatch_detail = DB::table('purchase_book_detail')->insert($abc);

            // $itemname = $request->obj[$key]['itemname'];
            // $varient = $request->obj[$key]['varient'];
            // $qty = $request->obj[$key]['quantity'];

            // $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
            // $remaining_finishProduct = $finishProduct->finish - $qty;
            // DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
            //     'finish' => $remaining_finishProduct
            // ]);
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
        $data = DB::table('purchase_book')->whereBetween('date', [$startDate, $endDate])
            ->where('vender', $partyName)->get();

        for ($a = 0; $a < count($data); $a++) {
            $data[$a]->startDate = $startDate;
            $data[$a]->endDate = $endDate;
            $data[$a]->partyName = $partyName;
        }
        // return $data;
        return view('admin/modules/Purchase_book/showPurchaseInvoices', [
            'saleInvoices' => $data
        ]);
    }
    public function delete_purchasebook()
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
        $salebook = DB::table('purchase_book')->where('invoice', $id)->first();
        $salebook_detail = DB::table('purchase_book_detail')->where('invoice', $id)->get();
        $venders = DB::table('sup_and_ven')->where('type','Vender')->get();
        $parties = DB::table('stock')->get();
        $items = DB::table('items')->get();
        return view(
            'admin/modules/Purchase_book/edit_purchasebook',
            ['salebook_detail'=>$salebook_detail,'salebook' => $salebook, 'parties' => $parties, 'items' => $items, 'venders' => $venders]
        );
    }


    public function update_purchase(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $dispatch = DB::table('purchase_book')->where('invoice', $request->invoice_edit)->update([
            'vender' => $request->vender,
            'date' => $request->Date,
            'city' => $request->City,
            'address' => $request->address,
            'zone' => $request->zone,
            'via_transport' => $request->via,
            'builtyNo' => $request->BuiltyNo,
            'dispatch_date' => $request->dispatchDate,
            'recieve_date' => $request->recieveDate,
            'remarks' => $request->Remarks,

        ]);


        $dispatch_detail_data = DB::table('purchase_book_detail')->where('invoice', $request->invoice_edit)->get();

        // for ($a = 0; $a < count($dispatch_detail_data); $a++) {

        //     $dispatach_detail_qty = DB::table('dispatch_detail')->where('invoice', $request->invoice_edit)
        //     ->where('itemname', $dispatch_detail_data[$a]->ItemName)
        //         ->where('varient', $dispatch_detail_data[$a]->varient)->first('qty');

        //     $stock_qty = DB::table('stock')->where('itemname', $dispatch_detail_data[$a]->ItemName)
        //         ->where('varient', $dispatch_detail_data[$a]->varient)->first('finish');
                
        //     $remaining_finishProduct = $dispatach_detail_qty->qty + $stock_qty->finish;

        //     DB::table('stock')->where('itemname', $dispatch_detail_data[$a]->ItemName)
        //         ->where('varient', $dispatch_detail_data[$a]->varient)->update([
        //             'finish' => $remaining_finishProduct
        //         ]);
        // }

        $delete = DB::table('purchase_book_detail')->where('invoice', $request->invoice_edit)->delete();
        if ($delete) {
            $abc = [];
            foreach ($request->obj as $key => $value) {
                $abc = [
                   'invoice'=>$request->invoice_edit,
                    'ItemName' => $request->obj[$key]['itemname'],
                    'qty' => $request->obj[$key]['quantity'],
                    'varient' => $request->obj[$key]['varient'],
                    'carton_qty' => $request->obj[$key]['ctn_qty'],
                    'category' => $request->obj[$key]['category'],
                ];
                $dispatch_detail = DB::table('purchase_book_detail')->insert($abc);

                // $itemname = $request->obj[$key]['itemname'];
                // $varient = $request->obj[$key]['varient'];
                // $qty = $request->obj[$key]['quantity'];

                // $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
                // $remaining_finishProduct = $finishProduct->finish - $qty;
                // DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
                //     'finish' => $remaining_finishProduct
                // ]);
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
    public function getDateOfSelectedVender_method(Request $request)
    {
        return DB::table('sup_and_ven')->where('name', $request->vender)->first();
    }
}
