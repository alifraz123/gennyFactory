<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // items rate code starts from here
    public function itemRate_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $items = DB::table('items')->get();
            $PartyType = DB::table('partyType')->get();
            $AccountHead = session('AH');
            $companies = session('CompanyName');
            $rates = DB::table('rate')->get();
            return view('admin/modules/Stock/itemRate', [
                'Items' => $items, 'PartyTypes' => $PartyType, 'AccountHead' => $AccountHead,
                'Companies' => $companies, 'Rates' => $rates
            ]);
        }
    }

    public function checkDuplicationOfItemRateData_method(Request $request)
    {
        //  return $request->ItemName.$request->PartyType.$request->Rate.$request->AccountHead.$request->Company;
        $checkDupplication = DB::table('rate')->where('ItemName', $request->ItemName)->where('PartyType', $request->PartyType)
            ->where('Rate', $request->Rate)->where('AccountHead', $request->AccountHead)->where('Company', $request->Company)
            ->first();
        if ($checkDupplication) {
            return "Exist";
        } else {
            return "Not";
        }
    }

    public function insertItemRate_method(Request $request)
    {
        $insertRole = DB::insert(
            "insert into rate(ItemName,PartyType,Rate,AccountHead,Company)values(?,?,?,?,?)",
            [$request->ItemName,  $request->PartyType, $request->Rate, $request->AccountHead, $request->CompanyName]
        );
        if ($insertRole) {
            return redirect('itemRate');
        }
    }


    public function getItemNameOfItemRate_method(Request $request)
    {
        return DB::table('items')->get();
    }
    public function getPartyTypeOfItemRate_method(Request $request)
    {
        return DB::table('partyType')->get();
    }

    public function itemRateEdit_method(Request $request)
    {
        $itemRate = DB::table('rate')->where('id', $request->id)->first();

        return [
            'id' => $itemRate->id, 'ItemName' => $itemRate->ItemName, 'PartyType' => $itemRate->PartyType,
            'Rate' => $itemRate->Rate, 'AccountHead' => $itemRate->AccountHead, 'Company' => $itemRate->Company,

        ];
    }

    public function  updateItemRate_method(Request $request)
    {

        $updatedRole = DB::table('rate')->where('id', $request->id)->update([
            'ItemName' => $request->modal_ItemName,
            'PartyType' => $request->modal_PartyType,
            'Rate' => $request->modal_Rate,
            'AccountHead' => $request->modal_AccountHead,
            'Company' => $request->modal_Company,
        ]);
        // if ($updatedRole) {
        return redirect('itemRate');
        // }
        //  if ($request->id == $request->ItemName) {
        //      return redirect('items');
        //  } else {
        //      $updatedRole = DB::table('items')->where('ItemName', $request->id)->update([
        //          'ItemName' => $request->ItemName,
        //          'CompanyName' => $request->CompanyName,
        //          'CategoryName' => $request->CategoryName,
        //      ]);
        //      if ($updatedRole) {
        //          return redirect('items');
        //      }
        //  }
    }

    public function itemRateDelete_method($id)
    {

        $deleted =  DB::table('rate')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('itemRate');
        }
    }


    // stock code starts from here
    public function stock_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $items = DB::table('items')->get();
            $AccountHead = session('AH');
            $companies = session('CompanyName');
            $stock = DB::table('stock')->get();
            return view('admin/modules/Stock/stock', [
                'Items' => $items, 'AccountHead' => $AccountHead,
                'Companies' => $companies, 'stocks' => $stock
            ]);
        }
    }

    public function checkDuplicationOfStockData_method(Request $request){
        //  return $request->ItemName.$request->PartyType.$request->Rate.$request->AccountHead.$request->Company;
        $checkDupplication = DB::table('stock')->where('ItemName', $request->ItemName)->where('FreshStock', $request->FreshStock)
            ->where('DamageStock', $request->DamageStock)->where('AccountHead', $request->AccountHead)->where('Company', $request->Company)
            ->first();
        if ($checkDupplication) {
            return "Exist";
        } else {
            return "Not";
        }
    }

    

    public function insertStock_method(Request $request)
    {

        //  $checkDuplicateRecord = DB::table('items')->where('ItemName', $request->ItemName)->first();
        //  if ($checkDuplicateRecord) {
        //      return redirect('items')->with('status', 'Duplicate value trying to insert');
        //  } else {
        $insertRole = DB::insert(
            "insert into stock(ItemName,FreshStock,DamageStock,AccountHead,Company)values(?,?,?,?,?)",
            [
                $request->ItemName,  $request->FreshStock, $request->DamageStock,
                $request->AccountHead, $request->Company
            ]
        );
        if ($insertRole) {
            return redirect('stock');
        }
        //  }
    }



    public function getItemNameOfStock_method(Request $request)
    {
        return DB::table('items')->get();
    }

    public function stockEdit_method(Request $request)
    {
        $stocks = DB::table('stock')->where('id', $request->id)->first();

        return [
            'id' => $stocks->id, 'ItemName' => $stocks->ItemName, 'FreshStock' => $stocks->FreshStock,
            'DamageStock' => $stocks->DamageStock, 'AccountHead' => $stocks->AccountHead, 'Company' => $stocks->Company,

        ];
    }

    public function  updateStock_method(Request $request)
    {
        // if ($request->id == $request->ItemName) {
        //     return redirect('items');
        // } else {
            
            $updatedRole = DB::table('stock')->where('id', $request->id)->update([
                'ItemName' => $request->modal_ItemName,
                'FreshStock' => $request->modal_FreshStock,
                'DamageStock' => $request->modal_DamageStock,
                'AccountHead' => $request->modal_AccountHead,
                'Company' => $request->modal_Company
            ]);
        //     if ($updatedRole) {
                return redirect('stock');
        //     }
        // }
    }

    public function stockDelete_method($id)
    {

        $deleted =  DB::table('stock')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('stock');
        }
    }
}
