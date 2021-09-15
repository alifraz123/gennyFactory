<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Stock extends Controller
{
    public function save_stockdata_method(Request $stock)
    {


        $abc = [];
        foreach ($stock->obj as $key => $value) {
            $abc = [

                'company' => $stock->obj[$key]['company'],
                'itemname' => $stock->obj[$key]['itemname'],
                'varient' => $stock->obj[$key]['varient'],
                'semiFinish' => 0,
                'finish' => 0,
                'damage' => 0,

            ];
            $material_items = DB::table('stock')->insert($abc);
        }
        if ($material_items) {
            echo "inserted";
        }
    }
    public function save_stockdata_detail_method(Request $stock)
    {
        $abc = [];
        foreach ($stock->obj as $key => $value) {

            $stock_data = DB::table('stock')->where('itemname', $stock->obj[$key]['itemname'])
                ->where('varient', $stock->obj[$key]['varient'])->first(['finish', 'semiFinish']);

            $finish = $stock_data->finish + $stock->obj[$key]['finish'];
            $semiFinish = $stock_data->semiFinish + $stock->obj[$key]['semi_finish'];

            DB::table('stock')->where('itemname', $stock->obj[$key]['itemname'])
                ->where('varient', $stock->obj[$key]['varient'])->update([
                    'finish' => $finish,
                    'semiFinish' => $semiFinish
                ]);

            $abc = [
                'date' => $stock->obj[$key]['date'],
                'company' => $stock->obj[$key]['company'],
                'itemname' => $stock->obj[$key]['itemname'],
                'varient' => $stock->obj[$key]['varient'],
                'semiFinish' => $stock->obj[$key]['semi_finish'],
                'finish' => $stock->obj[$key]['finish'],


            ];
            $material_items = DB::table('stock_detail')->insert($abc);
        }
        if ($material_items) {
            echo "inserted";
        }
    }

    public function show_Stockdata_method(Request $request)
    {
        $stock = DB::table('stock')->get();
        $companies = DB::table('company')->get();

        return view('admin/modules/Stock/stock', ['stocks' => $stock, 'companies' => $companies]);
    }
    public function show_Stockdata_detail_method(Request $request)
    {
        $stock = DB::table('stock_detail')->get();
        $companies = DB::table('company')->get();

        return view('admin/modules/Stock/stock_detail', ['stocks' => $stock, 'companies' => $companies]);
    }
    public function delete_stockdata_method($id)
    {
        DB::table('stock')
            ->where('id', $id)
            ->delete();
        return redirect('/show_Stockdata');
    }
    public function delete_stockdata_detail_method($id)
    {
        DB::table('stock_detail')
            ->where('id', $id)
            ->delete();
        return redirect('/show_Stockdata_detail');
    }
    public function edit_stockdata_method($id)
    {
        $editdata =  DB::table('stock')->where('id', $id)->get();
        return ['data' => $editdata];
    }
    public function edit_stockdata_detail_method($id)
    {
        $editdata =  DB::table('stock_detail')->where('id', $id)->get();
        return ['data' => $editdata];
    }
    public function update_Stockdata_method(Request $updatecompany)
    {
        $data = DB::table('stock')
            ->where('id', $updatecompany->id)
            ->update([
                'varient' => $updatecompany->Varient,
                'itemname' => $updatecompany->itemname,
                'company' => $updatecompany->company,
                'semiFinish' => 0,
                'finish' => 0,
                'damage' => 0,
            ]);
        // return $data;
        if ($data) {
            return redirect('/show_Stockdata');
        }
    }

    public function update_Stockdata_detail_method(Request $updatecompany)
    {
        $stock_detail_data = DB::table('stock_detail')->where('itemname', $updatecompany->itemname)
            ->where('varient', $updatecompany->varient)->where('id', $updatecompany->id)
            ->first(['finish', 'semiFinish']);

        $stock_data = DB::table('stock')->where('itemname', $updatecompany->itemname)
            ->where('varient', $updatecompany->varient)->first(['finish', 'semiFinish']);

        $finish_value = 0;
        $semiFinish_value = 0;
        if ($stock_detail_data->finish > $updatecompany->finish) {
            $less = $stock_detail_data->finish - $updatecompany->finish;
            $finish_value = $stock_data->finish - $less;
        } else {
            $more = $updatecompany->finish - $stock_detail_data->finish;
            $finish_value = $stock_data->finish + $more;
        }
        // return $stock_detail_data->semiFinish;
        if ($stock_detail_data->semiFinish > $updatecompany->semi_finish) {
            //  return $stock_data->semiFinish;
            $less = $stock_detail_data->semiFinish - $updatecompany->semi_finish;
            $semiFinish_value = $stock_data->semiFinish - $less;
        } else {
            $more = $updatecompany->semi_finish - $stock_detail_data->semiFinish;
            $semiFinish_value = $stock_data->semiFinish + $more;
        }

        // return  $semiFinish_value;
        $stock_data_update = DB::table('stock')->where('itemname', $updatecompany->itemname)
            ->where('varient', $updatecompany->varient)
            ->update([

                'semiFinish' => $semiFinish_value,
                'finish' => $finish_value,

            ]);
        if ($stock_data_update) {

            $data = DB::table('stock_detail')
                ->where('id', $updatecompany->id)
                ->update([
                    'date' => $updatecompany->date,
                    'itemname' => $updatecompany->itemname,
                    'varient' => $updatecompany->varient,
                    'company' => $updatecompany->company,
                    'semiFinish' => $updatecompany->semi_finish,
                    'finish' => $updatecompany->finish,

                ]);
            // return $data;
            if ($data) {
                return redirect('/show_Stockdata_detail');
            }
        }
    }

    public function getItemsOfSelectedCompany_method(Request $getItems)
    {
        $items = DB::table('items')->where('company', $getItems->company)->get();
        return $items;
    }
    public function getItemsOfSelectedCompany_For_dispatch_method(Request $getItems)
    {
        $items = DB::table('stock')->where('company', $getItems->company)->where('finish', '>', 0)->distinct()->get('itemname');
        return $items;
    }
    public function getVarientsOfSelectedItem_For_dispatch_method(Request $request)
    {
        $varients = DB::table('stock')->where('itemname', $request->ItemName)->where('finish', '>', 0)->get('varient');
        return $varients;
    }

    public function getVarientsOfSelectedItem_For_purchase_method(Request $request)
    {
        $varients = DB::table('material')->where('category', $request->material_type)
            ->distinct()->get('material');
        return $varients;
    }

    public function getVarientOfSelectedItem_method(Request $request)
    {
        $varients = DB::table('stock')->where('itemname', $request->itemname)->get('varient');
        return $varients;
    }
}
