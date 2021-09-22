<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class report extends Controller
{
    public function Dispatch_method(Request $request)
    {
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->where('company',$request->company)
        ->whereBetween('Date', [$request->startDate, $request->endDate])->get(['supplier', 'date', 'invoice']);
        for ($e = 0; $e < count($dispatch); $e++) {
            $cno = DB::table('dispatch_detail')->where('invoice', $dispatch[$e]->invoice)->distinct()->get(['cno']);
            $dispatch_detail_array = [];
            for ($a = 0; $a < count($cno); $a++) {
                $bb = [];
                $ab = DB::table('dispatch_detail')->where('cno', $cno[$a]->cno)->distinct()->get(['ItemName', 'cno']);
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

    public function DispatchDetail_method(Request $request)
    {
        $dispatch = DB::table('dispatch')->where('supplier', $request->supplier_name)->where('company',$request->company)
        ->whereBetween('Date', [$request->startDate, $request->endDate])->get(['supplier', 'date', 'invoice', 'builtyNo', 'city']);
        for ($e = 0; $e < count($dispatch); $e++) {
            $ItemNames = DB::table('dispatch_detail')->where('invoice', $dispatch[$e]->invoice)->distinct()->get(['ItemName', 'cno']);
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
        return view('admin/modules/reports/MTN_Dispatch', ['dispatch' => $dispatch]);
    }

    public function getPurchaseReport_method(Request $request)
    {
        // pdb means purchasebook data
        $pbd = DB::table('purchase_book')->where('vender', $request->vender_name)
            ->whereBetween('date', [$request->startDate, $request->endDate])
            ->get(['builtyNo', 'via_transport', 'dispatch_date', 'recieve_date', 'invoice', 'date', 'vender']);

        for ($a = 0; $a < count($pbd); $a++) {
            $pbd_detail = DB::table('purchase_book_detail')->where('invoice', $pbd[$a]->invoice)->distinct()->get('itemname');
            $pbd_array = [];
            for ($b = 0; $b < count($pbd_detail); $b++) {

                $itemname_detail = [];
                $pbd_data = DB::table('purchase_book_detail')->where('itemname', $pbd_detail[$b]->itemname)->where('invoice', $pbd[$a]->invoice)->get(['varient', 'qty', 'carton_qty']);
                for ($d = 0; $d < count($pbd_data); $d++) {
                    // $pbd_data2 = DB::table('purchase_book_detail')->where('itemname',$pbd_data[$d]->itemname)->where('invoice',$pbd[$a]->invoice)->get(['varient','qty','carton_qty']);

                    $itemname_detail[$d] = array(
                        'varient' => $pbd_data[$d]->varient, 'qty' => $pbd_data[$d]->qty, 'carton_qty' => $pbd_data[$d]->carton_qty, 'via' => $pbd[$a]->via_transport,
                        'DisDate' => $pbd[$a]->dispatch_date, 'builtyNo' => $pbd[$a]->builtyNo, 'recieveDate' => $pbd[$a]->recieve_date
                    );
                }

                $pbd_array[$b] = array('itemname' => $pbd_detail[$b]->itemname, 'varient' => $itemname_detail);
            }
            $pbd[$a]->item_detail = $pbd_array;

            for ($c = 0; $c < count($pbd_detail); $c++) {
                $itemname_detail2 = [];
                $total = 0;
                $pbd_data = DB::table('purchase_book_detail')->where('itemname', $pbd_detail[$c]->itemname)->where('invoice', $pbd[$a]->invoice)->get(['varient', 'qty']);
                for ($d = 0; $d < count($pbd_data); $d++) {

                    $itemname_detail2[$d] = array('varient' => $pbd_data[$d]->varient, 'qty' => $pbd_data[$d]->qty);
                    $total = $total + $pbd_data[$d]->qty;
                }


                $varient_total[$c] = array('itemname' => $pbd_detail[$c]->itemname, 'varient' => $itemname_detail2, 'total' => $total);
            }

            $pbd[$a]->item_total = $varient_total;
        }
        // return $pbd;


        return view('admin/modules/reports/PurchaseReport', ['purchase' => $pbd]);
    }

    public function getRawMaterialReport_method(Request $request)
    {
        $itemnames =  DB::table('material_detail')->where('date', $request->startDate)->where('category', 'Raw Material')->distinct()->get(['itemname', 'date']);
        for ($a = 0; $a < count($itemnames); $a++) {
            $varient_data_array = [];
            $itemVarient = DB::table('material_detail')->where('itemname', $itemnames[$a]->itemname)->get();
            for ($b = 0; $b < count($itemVarient); $b++) {
                $itemVarientDetail = DB::table('material_detail')->where('itemname', $itemVarient[$b]->itemname)
                    ->where('material', $itemVarient[$b]->material)->first(['material', 'ob', 'used', 'rejected']);

                $recieved = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');
                if ($recieved == '') {
                    return  $varient_data_array[$b] = array(
                        'date' => $request->startDate, 'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => 0, 'total' => 0 + $itemVarientDetail->ob, 'used' => $itemVarientDetail->used,
                        'cb' => 0 + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                } else {
                    $recieved_yes = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');

                    $recieved_yes_detail = DB::table('purchase_book_detail')->where('invoice', $recieved_yes->invoice)->where('itemname', $itemVarient[$b]->itemname)
                        ->where('varient', $itemVarient[$b]->material)->first('qty');

                    $varient_data_array[$b] = array(
                        'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => $recieved_yes_detail->qty, 'total' => $recieved_yes_detail->qty + $itemVarientDetail->ob,
                        'used' => $itemVarientDetail->used,
                        'cb' => $recieved_yes_detail->qty + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                }
            }
            $itemnames[$a]->varient_data  = $varient_data_array;
        }
        // return $itemnames;
        return view('admin/modules/reports/RawMaterialReport', ['rawMaterial' => $itemnames]);
    }
    public function getPackingMaterialReport_method(Request $request)
    {
        $itemnames =  DB::table('material_detail')->where('date', $request->startDate)->where('category', 'Packing Material')->distinct()->get(['itemname', 'date']);
        for ($a = 0; $a < count($itemnames); $a++) {
            $varient_data_array = [];
            $itemVarient = DB::table('material_detail')->where('itemname', $itemnames[$a]->itemname)->get();
            for ($b = 0; $b < count($itemVarient); $b++) {
                $itemVarientDetail = DB::table('material_detail')->where('itemname', $itemVarient[$b]->itemname)
                    ->where('material', $itemVarient[$b]->material)->first(['material', 'ob', 'used', 'rejected']);

                $recieved = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');
                if ($recieved == '') {
                    return  $varient_data_array[$b] = array(
                        'date' => $request->startDate, 'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => 0, 'total' => 0 + $itemVarientDetail->ob, 'used' => $itemVarientDetail->used,
                        'cb' => 0 + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                } else {
                    $recieved_yes = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');

                    $recieved_yes_detail = DB::table('purchase_book_detail')->where('invoice', $recieved_yes->invoice)->where('itemname', $itemVarient[$b]->itemname)
                        ->where('varient', $itemVarient[$b]->material)->first('qty');

                    $varient_data_array[$b] = array(
                        'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => $recieved_yes_detail->qty, 'total' => $recieved_yes_detail->qty + $itemVarientDetail->ob,
                        'used' => $itemVarientDetail->used,
                        'cb' => $recieved_yes_detail->qty + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                }
            }
            $itemnames[$a]->varient_data  = $varient_data_array;
        }
        // return $itemnames;
        return view('admin/modules/reports/PackingMaterialReport', ['rawMaterial' => $itemnames]);
    }
    public function getStickerReport_method(Request $request)
    {
        $itemnames =  DB::table('material_detail')->where('date', $request->startDate)->where('category', 'Stickers')->distinct()->get(['itemname', 'date']);
        for ($a = 0; $a < count($itemnames); $a++) {
            $varient_data_array = [];
            $itemVarient = DB::table('material_detail')->where('itemname', $itemnames[$a]->itemname)->get();
            for ($b = 0; $b < count($itemVarient); $b++) {
                $itemVarientDetail = DB::table('material_detail')->where('itemname', $itemVarient[$b]->itemname)
                    ->where('material', $itemVarient[$b]->material)->first(['material', 'ob', 'used', 'rejected']);

                $recieved = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');
                if ($recieved == '') {
                    return  $varient_data_array[$b] = array(
                        'date' => $request->startDate, 'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => 0, 'total' => 0 + $itemVarientDetail->ob, 'used' => $itemVarientDetail->used,
                        'cb' => 0 + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                } else {
                    $recieved_yes = DB::table('purchase_book')->where('date', $request->startDate)->first('invoice');

                    $recieved_yes_detail = DB::table('purchase_book_detail')->where('invoice', $recieved_yes->invoice)->where('itemname', $itemVarient[$b]->itemname)
                        ->where('varient', $itemVarient[$b]->material)->first('qty');

                    $varient_data_array[$b] = array(
                        'material' => $itemVarientDetail->material, 'ob' => $itemVarientDetail->ob,
                        'recieved' => $recieved_yes_detail->qty, 'total' => $recieved_yes_detail->qty + $itemVarientDetail->ob,
                        'used' => $itemVarientDetail->used,
                        'cb' => $recieved_yes_detail->qty + $itemVarientDetail->ob - $itemVarientDetail->used, 'rejected' => $itemVarientDetail->rejected
                    );
                }
            }
            $itemnames[$a]->varient_data  = $varient_data_array;
        }
        // return $itemnames;
        return view('admin/modules/reports/StickerReport', ['rawMaterial' => $itemnames]);
    }
    public function getDailyFinishedStockReport_method(Request $request)
    {
        $first =  DB::table('stock_detail')->where('date', $request->startDate)->distinct()->get(['date', 'itemname']);
        for ($a = 0; $a < count($first); $a++) {

            $second =  DB::table('stock_detail')->where('itemname', $first[$a]->itemname)->get(['varient', 'finish']);
            $varient_array = [];
            $total_value = 0;
            for ($b = 0; $b < count($second); $b++) {
                $varient_array[$b] = array('varient' => $second[$b]->varient, 'qty' => $second[$b]->finish);
                $total_value = $total_value + $second[$b]->finish;
            }
            $first[$a]->varient = $varient_array;

            $first[$a]->total = $total_value;
        }
        // return $first;
        return view('admin/modules/reports/DailyFinishedStockReport', ['finish' => $first]);
    }

    public function getDailySemiFinishedStockReport_method(Request $request)
    {

        $first =  DB::table('stock_detail')->where('date', $request->startDate)->distinct()->get(['date', 'itemname']);
        for ($a = 0; $a < count($first); $a++) {

            $second =  DB::table('stock_detail')->where('itemname', $first[$a]->itemname)->get(['varient', 'semiFinish']);
            $varient_array = [];
            $total_value = 0;
            for ($b = 0; $b < count($second); $b++) {
                $varient_array[$b] = array('varient' => $second[$b]->varient, 'qty' => $second[$b]->semiFinish);
                $total_value = $total_value + $second[$b]->semiFinish;
            }
            $first[$a]->varient = $varient_array;

            $first[$a]->total = $total_value;
        }
        // return $first;
        return view('admin/modules/reports/DailySemiFinishedStockReport', ['semifinish' => $first]);
    }

    public function getAnnualPartyWiseReport_method(Request $request)
    {
        $annualSaleReport =  DB::table('dispatch')->where('company',$request->company)
        ->whereBetween('date', [$request->startDate, $request->endDate])
            ->get(['invoice']);

        $invoiceArrayForWhereInQuery = [];
        for ($g = 0; $g < count($annualSaleReport); $g++) {
            $invoiceArrayForWhereInQuery[$g] = $annualSaleReport[$g]->invoice;
        }
        // return $invoiceArrayForWhereInQuery;
        //  $last =  count($annualSaleReport)-1;
        $itemnames =  DB::table('dispatch_detail')
            ->whereIn('invoice', $invoiceArrayForWhereInQuery)
            ->distinct()->get('ItemName');

        for ($d = 0; $d < count($itemnames); $d++) {
            $invoices_array = [];
            $total_value = 0;
            $itemnames_detail = DB::table('dispatch_detail')->where('ItemName', $itemnames[$d]->ItemName)->get();
            //    return $itemnames_detail." "; 
            for ($e = 0; $e < count($itemnames_detail); $e++) {

                if (count($invoices_array) == 0) {
                    $invoices_array[$e] = array(
                        'varient' => $itemnames_detail[$e]->varient,
                        'qty' => $itemnames_detail[$e]->qty
                    );
                    $total_value = $total_value + $itemnames_detail[$e]->qty;
                } else {
                    for ($a = 0; $a < count($invoices_array); $a++) {
                        if ($itemnames_detail[$e]->varient == $invoices_array[$a]['varient']) {
                            $invoices_array[$a]['qty'] = $invoices_array[$a]['qty'] + $itemnames_detail[$e]->qty;
                        } else {
                            $invoices_array[count($invoices_array)] = array(
                                'varient' => $itemnames_detail[$e]->varient,
                                'qty' => $itemnames_detail[$e]->qty
                            );
                            $total_value = $total_value + $itemnames_detail[$e]->qty;
                            break;
                        }
                    }
                }
            }
            $itemnames[$d]->varients = $invoices_array;
            $itemnames[$d]->total = $total_value;
        }
        // return $itemnames;

        return view('admin/modules/reports/AnnualPartyWiseSaleReport', ['annualSaleReport' => $itemnames, 'supplier' => $request->supplier_name, 'date' => $request->startDate]);
    }

    
}
