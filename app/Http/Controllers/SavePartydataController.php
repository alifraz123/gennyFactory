<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SavePartydataController extends Controller
{
    public function save_materialdata_method(Request $material)
    {
        $material =  DB::insert("insert into material(material,item,category)
        values(?,?,?)", [$material->material_name, $material->item, $material->Category]);
        if ($material) {
            return redirect('/show_material')->with('status','inserted successfuly');
        }
        else{
            return redirect('/show_material')->with('failed','Not inserted ');
        }
    }

    

    public function show_material_method(Request $request)
    {
         $material = DB::table('material')->get();
        //  $parties->appends($request->all());
        $items = DB::table('items')->get();
       
         return view('admin/modules/Material/material',['materials'=>$material,'items'=>$items]);
       
    }
    public function show_material_detail_method(Request $request)
    {
         $material = DB::table('material')->get();
        //  $parties->appends($request->all());
        $items = DB::table('items')->get();
       
         return view('admin/modules/Material/material_detail',['materials'=>$material,'items'=>$items]);
       
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
            ->where('material', $id)
            ->get();
            $items = DB::table('items')->get();
        // return $editdata;
        return ['data' => $editdata,'items'=>$items];
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
}
