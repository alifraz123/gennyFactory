<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DispatchController extends Controller
{
    public function getCitiesOfSelectedAccountHead_method(Request $request)
    {
        return $Cities = DB::table('party')->where('AccountHead', $request->AccountHead)->distinct()->get('City');
    }
    public function getAreaOfSelectedCity_sale_method(Request $request)
    {
        return DB::table('party')->where('City', $request->City)->where('AccountHead',session('AH'))->distinct()->get('Area');
    }
    public function getPartiesOfSelectedArea_method(Request $request)
    {
        return DB::table('party')->where('Area', $request->Area)->where('AccountHead',session('AH'))->distinct()->get('PartyName');
    }
    public function getPartyNamesOfSelectedBooker_sale(Request $request)
    {
        return DB::table('party')->where('booker', $request->Booker)->distinct()->get('PartyName');
    }
    public function getDataOfSelectedPartyName_sale(Request $request)
    {
        $debit = 0;
        $credit = 0;
        $PartyNameLength = DB::table('salebook')->where('PartyName', $request->PartyName)->distinct()->get();
        for ($a = 0; $a < count($PartyNameLength); $a++) {
            $debit = $debit + $PartyNameLength[$a]->Debit;
            $credit = $credit + $PartyNameLength[$a]->Credit;
        }
        $partyData = DB::table('party')->where('PartyName', $request->PartyName)->first(['PartyPerson', 'Addres', 'PartyType', 'booker']);

        $AccountHeadQty = DB::table('salebook')->where('AccountHead', session('AH'))->count();
        $AccountHeadId = DB::table('party')->where('PartyName', session('AH'))->first('id');
        $abc = $AccountHeadQty + 1;
        return [
            'debit' => $debit, 'credit' => $credit, 'PartyPerson' => $partyData->PartyPerson,
            'Addres' => $partyData->Addres, 'PartyType' => $partyData->PartyType, 'PartyBooker' => $partyData->booker,
            'Invoice' => $AccountHeadId->id . "-" . $abc

        ];
    }
    public function getItemNames_Of_Selected_AccountHead_And_CompanyName(Request $request)
    {
        return DB::table('stock')->where('AccountHead', $request->AccountHead)->where('Company', $request->CompanyName)
            ->where('FreshStock', '>', 0)->get();
    }
    public function getPriceFromRateTable_sale_method(Request $request)
    {
        return DB::table('rate')->where('ItemName', $request->ItemName)->where('PartyType', $request->PartyType)
            ->where('AccountHead', $request->AccountHead)->where('Company', $request->CompanyName)->first('Rate');
    }
    public function getPriceFromItemsTable_sale(Request $request)
    {
        return DB::table('items')->where('ItemName', $request->ItemName)->where('CompanyName', $request->Company)->first('Rate');
    }
    public function getInvoicesForEdit_method(Request $request)
    {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['PartyName'];
        $data = DB::table('salebook')->whereBetween('Date', [$startDate, $endDate])
            ->where('PartyName', $partyName)->where('Ref', 'sb')->paginate(5);
        $data->appends($request->all());
        return view('admin/modules/SalesBook/showSaleInvoices', ['saleInvoices' => $data]);
    }
    public function edit_invoice_method($id)
    {
        $salebook = DB::table('salebook')->where('Invoice', $id)->get();
        $salebook_detail = DB::table('salebook_detail')->where('invoice', $id)->get();
        $cities = DB::table('party')->where('AccountHead', session('AH'))->get('City');
        $parties = DB::table('party')->get();
        $items = DB::table('items')->get();
        return view(
            'admin/modules/SalesBook/edit_invoice',
            ['salebook' => $salebook, 'salebook_detail' => $salebook_detail, 'parties' => $parties, 'items' => $items, 'cities' => $cities]
        );
    }
    public function delete_dispatch()
    {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $partyName = $_GET['PartyName'];
        $invoice = $_GET['Invoice'];
        $dispatch_detail =  DB::table('salebook_detail')
            ->where('Invoice', $invoice)
            ->delete();
        $dispatch =  DB::table('salebook')
            ->where('Invoice', $invoice)
            ->delete();
        if ($dispatch_detail && $dispatch) {
            return redirect('getInvoicesForEdit?startDate=' . $startDate . '&endDate=' . $endDate
                . '&PartyName=' . $partyName);
        }
    }

    public function update_dispatch(Request $request)
    {
        $dispatch = '';
        $dispatch_detail = '';
        $dispatch = DB::table('salebook')->where('invoice', $request->invoice_edit)->update([
            'PartyName' => $request->PartyName,
            'City' => $request->City,
            'Area' => $request->Area,
            'SalesOfficer' => $request->booker,
            'Total' => $request->Total,
            'TODiscount' => $request->TODiscount,
            'SchemeDiscount' => $request->SchemeDiscount,
            'PercentDiscount' => $request->PercentDiscount,
            'ExtraDiscount' => $request->ExtraDiscount,

            'FinalTotal' => $request->FinalTotal,
            'Debit' => $request->Debit,
            'Remarks' => $request->Remarks,

        ]);


        // $salebook_detail_data = DB::table('salebook_detail')->where('invoice', $request->invoice_edit)->get();

        // for ($a = 0; $a < count($salebook_detail_data); $a++) {

        //     $dispatach_detail_qty = DB::table('salebook_detail')->where('invoice', $request->invoice_edit)
        //     ->where('itemname', $salebook_detail_data[$a]->ItemName)
        //         ->where('varient', $salebook_detail_data[$a]->varient)->first('qty');

        //     $stock_qty = DB::table('stock')->where('itemname', $salebook_detail_data[$a]->ItemName)
        //         ->where('varient', $salebook_detail_data[$a]->varient)->first('finish');

        //     $remaining_finishProduct = $dispatach_detail_qty->qty + $stock_qty->finish;

        //     DB::table('stock')->where('itemname', $salebook_detail_data[$a]->ItemName)
        //         ->where('varient', $salebook_detail_data[$a]->varient)->update([
        //             'finish' => $remaining_finishProduct
        //         ]);
        // }


        $delete = DB::table('salebook_detail')->where('invoice', $request->invoice_edit)->delete();
        if ($delete) {
            $abc = [];
            foreach ($request->obj as $key => $value) {
                $abc = [
                    'Ref' => 'sb',
                    'Date' => $request->Date,
                    'Invoice' => $request->invoice_edit,
                    'ItemName' => $request->obj[$key]['ItemName'],
                    'Quantity' => $request->obj[$key]['Qty'],
                    'Price' => $request->obj[$key]['Price'],
                    'Total' => $request->obj[$key]['Total'],
                    'TOValue' => $request->obj[$key]['TO'],
                    'TODiscount' => $request->obj[$key]['TOA'],
                    'Scheme' => $request->obj[$key]['Sch'],
                    'SchemeDiscount' => $request->obj[$key]['SchA'],
                    'Percent' => $request->obj[$key]['Percent'],
                    'PercentDiscount' => $request->obj[$key]['PercentAmount'],
                    'FinalTotal' => $request->obj[$key]['FinalTotal'],
                ];
                $salebook_detail = DB::table('salebook_detail')->insert($abc);

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
        if ($dispatch || $salebook_detail) {
            echo "inserted";
        }
    }

    public function dispatch_method(Request $request)
    {
        // return "saaaa";
        $salebook = '';
        $salebook_detail = '';
        // $ab = DB::table('salebook')->get();
        // $invoice_r = 1;
        // // $final_total = $request->FinalTotal;
        // if ($ab->count() != 0) {
        //     $invoice_id = DB::table('salebook')->latest('invoice')->first();
        //     $invoice = $invoice_id->Invoice + 1;
        // } else {
        //     $invoice = $invoice_r;
        // }

        $salebook =  DB::insert("insert into salebook(Ref,Date,Invoice,PartyName,City,Area,SalesOfficer,CompanyName,AccountHead,Total,TODiscount,SchemeDiscount
        ,PercentDiscount,ExtraDiscount,FinalTotal,Cash,Debit,Credit,Remarks,Balance,Difference,InvoiceStatus,Username)
        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            "sb", $request->Date, $request->Invoice, $request->PartyName, $request->City, $request->Area, $request->booker, $request->CompanyName, $request->AccountHead,
            $request->Total, $request->TODiscount, $request->SchemeDiscount, $request->PercentDiscount, $request->ExtraDiscount, $request->FinalTotal,
            0, $request->Debit, 0, $request->Remarks, $request->Balance, $request->Difference, $request->InvoiceStatus, Auth::user()->name
        ]);

        $abc = [];
        foreach ($request->obj as $key => $value) {
            $abc = [
                'Ref' => 'sb',
                'Date' => $request->Date,
                'Invoice' => $request->Invoice,
                'ItemName' => $request->obj[$key]['ItemName'],
                'Quantity' => $request->obj[$key]['Qty'],
                'Price' => $request->obj[$key]['Price'],
                'Total' => $request->obj[$key]['Total'],
                'TOValue' => $request->obj[$key]['TO'],
                'TODiscount' => $request->obj[$key]['TOA'],
                'Scheme' => $request->obj[$key]['Sch'],
                'SchemeDiscount' => $request->obj[$key]['SchA'],
                'Percent' => $request->obj[$key]['Percent'],
                'PercentDiscount' => $request->obj[$key]['PercentAmount'],
                'FinalTotal' => $request->obj[$key]['FinalTotal'],
            ];
            $salebook_detail = DB::table('salebook_detail')->insert($abc);

            // $itemname = $request->obj[$key]['itemname'];
            // $varient = $request->obj[$key]['varient'];
            // $qty = $request->obj[$key]['quantity'];

            // $finishProduct = DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->first('finish');
            // $remaining_finishProduct = $finishProduct->finish - $qty;
            // DB::table('stock')->where('itemname', $itemname)->where('varient', $varient)->update([
            //     'finish' => $remaining_finishProduct
            // ]);
        }
        if ($salebook && $salebook_detail) {
            echo "inserted";
        }
    }

    // cashbook code starts from here
    public function dispatch_cash_method(Request $request)
    {
        $salebook = '';
        $salebook =  DB::insert("insert into salebook(Ref,Date,Invoice,PartyName,City,Area,SalesOfficer,CompanyName,AccountHead,Total,TODiscount,SchemeDiscount
        ,PercentDiscount,ExtraDiscount,FinalTotal,Cash,Debit,Credit,Remarks,Balance,Difference,InvoiceStatus,Username)
        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            "cb", $request->Date, $request->Invoice, $request->PartyName, $request->City, $request->Area, $request->booker, $request->CompanyName, $request->AccountHead,
            0, 0,0, 0, 0, 0,
            $request->Cash, 0, $request->Credit, $request->Remarks, $request->Balance, 0, $request->InvoiceStatus, Auth::user()->name
        ]);

        if ($salebook) {
            echo "inserted";
        }
    }
    public function dispatch_journalVoucher_method(Request $request)
    {
        $salebook = '';
        $salebook =  DB::insert("insert into salebook(Ref,Date,Invoice,PartyName,City,Area,SalesOfficer,CompanyName,AccountHead,Total,TODiscount,SchemeDiscount
        ,PercentDiscount,ExtraDiscount,FinalTotal,Cash,Debit,Credit,Remarks,Balance,Difference,InvoiceStatus,Username)
        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            "jv", $request->Date, $request->Invoice, $request->PartyName, $request->City, $request->Area, $request->booker, $request->CompanyName, $request->AccountHead,
            0, 0,0, 0, $request->ExtraDiscount, 0,
            0, $request->Debit, $request->Credit, $request->Remarks, $request->Balance, 0, $request->InvoiceStatus, Auth::user()->name
        ]);

        if ($salebook) {
            echo "inserted";
        }
    }
    
}
