<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SavePartydataController extends Controller
{
    public function save_materialdata_method(Request $material)
    {

        $material =  DB::insert("insert into material(material,item,category,qty,rejected)
        values(?,?,?,?,?)", [$material->material_name, $material->item, $material->Category, 0, 0]);
        if ($material) {
            return redirect('/show_material')->with('status', 'inserted successfuly');
        } else {
            return redirect('/show_material')->with('failed', 'Not inserted ');
        }
    }

    public function insertMaterialUsedDetail_method(Request $material)
    {
        
        $abc = [];
        foreach ($material->obj as $key => $value) {
            
           
            $ob =  DB::table('material')->where('material', $material->obj[$key]['material_name'])
                ->where('category', $material->obj[$key]['category'])->first(['qty', 'rejected']);

            $final_rejected = $ob->rejected + $material->obj[$key]['rejected'];
            $purchase_invoice = DB::table('purchase_book')->where('date', $material->obj[$key]['date'])->first('invoice');
            if ($purchase_invoice == '') {
                $final_qty = $ob->qty + 0 - $material->obj[$key]['used'];
                DB::table('material')->where('material', $material->obj[$key]['material_name'])
                    ->where('category', $material->obj[$key]['category'])->update([
                        'qty' => $final_qty,
                        'rejected' => $final_rejected
                    ]);
            } else {
                $purchase_detail_qty = DB::table('purchase_book_detail')->where('invoice', $purchase_invoice->invoice)
                    ->where('category', $material->obj[$key]['category'])->where('varient', $material->obj[$key]['material_name'])->first('qty');
                if ($purchase_detail_qty == '') {

                    $final_qty = $ob->qty + 0 - $material->obj[$key]['used'];
                } else {

                    $final_qty = $ob->qty + $purchase_detail_qty->qty - $material->obj[$key]['used'];
                }
                DB::table('material')->where('material', $material->obj[$key]['material_name'])
                    ->where('category', $material->obj[$key]['category'])->update([
                        'qty' => $final_qty,
                        'rejected' => $final_rejected
                    ]);
            }
            $abc = [
                'date' =>$material->obj[$key]['date'],
                'itemname'=>$material->obj[$key]['material_item_name'],
                'category'=>$material->obj[$key]['category'],
                'material'=>$material->obj[$key]['material_name'],
                'ob'=>$ob->qty,
                'used'=>$material->obj[$key]['used'],
                'rejected'=>$material->obj[$key]['rejected'],
            ];

            $material_items = DB::table('material_detail')->insert($abc);
        }
       
            echo "inserted";
        




        // $material =  DB::insert("insert into material_detail(date,itemname,category,material,ob,used,rejected)
        // values(?,?,?,?,?,?,?)", [
        //     $material->date, $material->itemname, $material->category, $material->material,$ob->qty, $material->used,
        //     $material->rejected
        // ]);

        // if ($material) {

        //     return redirect('/show_material_detail')->with('status', 'inserted successfuly');
        // } else {
        //     return redirect('/show_material_detail')->with('failed', 'Not inserted ');
        // }
    }
    public function getOpeningBalance_method(Request $request)
    {
        $lastData =  DB::table('material_detail')->where('category', $request->category)
            ->where('material', $request->material)->get('closing_balance');
        if (count($lastData) == 0) {
            return '0';
        } else {
            return DB::table('material_detail')->where('category', $request->category)
                ->where('material', $request->material)->latest('id')->first();
        }
    }

    public function getMaterialOfSelectedCategory_method(Request $request)
    {
        $varients = DB::table('material')->where('category', $request->category)->where('qty', '>', 0)->get('material');
        return $varients;
    }


    public function show_material_method(Request $request)
    {
        $material = DB::table('material')->get();
        //  $parties->appends($request->all());


        return view('admin/modules/Material/material', ['materials' => $material,]);
    }
    public function getMaterialItemNamesOfSelectedCategory_method(Request $request)
    {
        return DB::table('material_items')->where('category', $request->category)->get('material_item_name');
    }
    public function getMaterialNamesOfSelectedItem_method(Request $request)
    {
        return DB::table('material')->where('item', $request->itemName)->get('material');
    }
    public function show_material_detail_method(Request $request)
    {
        $material = DB::table('material_detail')->get();
        //  $parties->appends($request->all());
        $items = DB::table('items')->get();

        return view('admin/modules/Material/material_detail', ['materials' => $material, 'items' => $items]);
    }
    public function delete_materialdata_method($id)
    {
        DB::table('material')
            ->where('material', $id)
            ->delete();
        return redirect('/show_material');
    }
    public function edit_materialdata_method($id)
    {
        $editdata =  DB::table('material')
            ->where('id', $id)
            ->get();
        $items = DB::table('items')->get();
        // return $editdata;
        return ['data' => $editdata, 'items' => $items];
    }
    public function edit_materialdata_detail_method($id)
    {
        $editdata =  DB::table('material_detail')
            ->where('id', $id)
            ->get();
        $items = DB::table('items')->get();
        // return $editdata;
        return ['data' => $editdata, 'items' => $items];
    }
    public function update_materialdata_method(Request $updatecompany)
    {
        $data = DB::table('material')
            ->where('material', $updatecompany->id)
            ->update([
                'material' => $updatecompany->material_name,
                'item' => $updatecompany->item,
                'category' => $updatecompany->Category,

            ]);
        // return $data;
        if ($data) {
            return redirect('/show_material');
        }
    }

    public function update_materialdata_detail_method(Request $updatecompany)
    {
        $material_detail_used = DB::table('material_detail')->where('material', $updatecompany->modal_material)
            ->where('category', $updatecompany->modal_category)->where('id', $updatecompany->modal_id)
            ->first(['used', 'rejected']);

        $material_qty = DB::table('material')->where('material', $updatecompany->modal_material)
            ->where('category', $updatecompany->modal_category)->first(['qty', 'rejected']);

        $used_value = 0;
        $rejected_value = 0;
        $material_qty_value = 0;
        $material_rejected_value = 0;
        if ($material_detail_used->used > $updatecompany->modal_used) {
            $less = $material_detail_used->used - $updatecompany->modal_used;
            $used_value = $material_detail_used->used - $less;
            $material_qty_value = $material_qty->qty + $less;
        } else {
            $more = $updatecompany->modal_used - $material_detail_used->used;
            $used_value = $more + $material_detail_used->used;
            $material_qty_value = $material_qty->qty - $more;
        }
        // return $material_detail_used;
        if ($material_detail_used->rejected > $updatecompany->modal_rejected) {
            $less = $material_detail_used->rejected - $updatecompany->modal_rejected;
            $rejected_value = $material_detail_used->rejected - $less;
            $material_rejected_value = $material_qty->rejected - $less;
        } else {
            $more = $updatecompany->modal_rejected - $material_detail_used->rejected;
            $rejected_value = $more + $material_detail_used->rejected;
            $material_rejected_value = $material_qty->rejected + $more;
        }

        $data = DB::table('material_detail')->where('id', $updatecompany->modal_id)
            ->update([
                'date' => $updatecompany->modal_date,
                'category' => $updatecompany->modal_category,
                'itemname' => $updatecompany->modal_itemname,
                'material' => $updatecompany->modal_material,
                'ob' => $material_qty_value,
                'used' => $used_value,
                'rejected' => $rejected_value

            ]);
        // return $material_qty_value.$material_rejected_value;
        $material_update = DB::table('material')->where('material', $updatecompany->modal_material)
            ->where('category', $updatecompany->modal_category)
            ->update([

                'qty' => $material_qty_value,
                'rejected' => $material_rejected_value

            ]);

        // return $updatecompany->modal_id;
        if ($data) {
            return redirect('/show_material_detail');
        }
    }
}
