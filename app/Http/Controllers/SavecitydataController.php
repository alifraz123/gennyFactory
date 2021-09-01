<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavecitydataController extends Controller
{
    public function save_svdata_method(Request $sv)
    {
        $data =  DB::insert(
            "insert into sup_and_ven(name,phoneNo,cnic,city,zone,address,type) values(?,?,?,?,?,?,?)",
            [$sv->name, $sv->phoneNo, $sv->cnic, $sv->city, $sv->zone, $sv->address, $sv->type,]
        );
        if ($data) {
            return redirect('/show_svdata')->with('status', 'Inserted Successfuly');
        } else {
            return redirect('/show_svdata')->with('failed', 'Not Inserted ');
        }
    }
    public function show_svdata_method(Request $request)
    {
        $sup_and_ven = DB::table('sup_and_ven')->get();
        $zones = DB::table('zone')->get();
        $cities = DB::table('city')->get();

        return view('admin/modules/Supplier_and_Vender/sv', ['sup_and_ven' => $sup_and_ven,'zones'=>$zones,'cities'=>$cities]);
    }
    public function delete_svdata_method($id)
    {
        DB::table('sup_and_ven')
            ->where('phoneNo', $id)
            ->delete();
        return redirect('/show_svdata');
    }
    public function edit_svdata_method($id)
    {
        $editdata =  DB::table('sup_and_ven')
            ->where('phoneNo', $id)
            ->get();
            $zones = DB::table('zone')->get();
            $cities = DB::table('city')->get();
        return view('/admin/modules/Supplier_and_Vender/svedit', ['data' => $editdata,'zones'=>$zones,'cities'=>$cities]);
    }
    public function update_svdata_method(Request $updatecompany)
    {
        $data = DB::table('sup_and_ven')
            ->where('phoneNo', $updatecompany->id)
            ->update([
                'name' => $updatecompany->name,
                'phoneNo' => $updatecompany->phoneNo,
                'cnic' => $updatecompany->cnic,
                'address' => $updatecompany->address,
                'type' => $updatecompany->type
            ]);
        if ($data) {
            return redirect('/show_svdata');
        }
    }
    public function save_zone_method(Request $zone)
    {
        $zone =  DB::insert("insert into zone(zoneName) values(?)", [$zone->zone]);
        if ($zone) {
            return redirect('/show_zone')->with('status', 'Inserted Successfuly');
        } else {
            return redirect('/show_zone')->with('failed', 'Not Inserted ');
        }
    }
    public function show_zone_method()
    {
        $zone = DB::table('zone')->get();

        return view('admin/modules/zone/zone', ['zones' => $zone]);
    }
    public function delete_zone_method($id)
    {
        DB::table('zone')->where('zoneName', $id)->delete();
        return redirect('/show_zone');
    }
    public function edit_zone_method($id){
        $editzone =  DB::table('zone')
            ->where('zoneName', $id)
            ->get();
        return view('/admin/modules/zone/zone_edit', ['zone' => $editzone]);
    }
    public function update_zone_method(Request $updateZone){
        $data = DB::table('zone')
            ->where('zoneName', $updateZone->zone_hidden_id)
            ->update([
                'zoneName' => $updateZone->zone,
            ]);
            
        if ($data) {
            return redirect('/show_zone');
        }
    }



    // city code
    public function save_city_method(Request $zone)
    {
        $zone =  DB::insert("insert into city(cityName,zoneName) values(?,?)", [$zone->city,$zone->zone]);
        if ($zone) {
            return redirect('/show_city')->with('status', 'Inserted Successfuly');
        } else {
            return redirect('/show_city')->with('failed', 'Not Inserted ');
        }
    }
    public function show_city_method()
    {
        $zone = DB::table('zone')->get();
        $cities = DB::table('city')->get();

        return view('admin/modules/city/city', ['cities'=>$cities,'zones' => $zone]);
    }
    public function delete_city_method($id)
    {
        DB::table('city')->where('cityName', $id)->delete();
        return redirect('/show_city');
    }
    public function edit_city_method($id){
        $editcity =  DB::table('city')
            ->where('cityName', $id)
            ->get();
            $zones = DB::table('zone')->get();
        return view('/admin/modules/city/city_edit', ['city' => $editcity,'zones'=>$zones]);
    }
    public function update_city_method(Request $updateZone){
        $data = DB::table('city')
            ->where('cityName', $updateZone->id)
            ->update([
                'cityName' => $updateZone->city,
                'zoneName' => $updateZone->zone,
            ]);
            
        if ($data) {
            return redirect('/show_city');
        }
    }


    // company code
    public function save_company_method(Request $zone)
    {
        $zone =  DB::insert("insert into company(companyName) values(?)", [$zone->company]);
        if ($zone) {
            return redirect('/show_company')->with('status', 'Inserted Successfuly');
        } else {
            return redirect('/show_company')->with('failed', 'Not Inserted ');
        }
    }
    public function show_company_method()
    {
        $companies = DB::table('company')->get();

        return view('admin/modules/Company/company', ['companies'=>$companies]);
    }
    public function delete_company_method($id)
    {
        DB::table('company')->where('companyName', $id)->delete();
        return redirect('/show_company');
    }
    public function edit_company_method($id){
        $editcity =  DB::table('company')
            ->where('companyName', $id)
            ->get();
            
        return view('/admin/modules/Company/companyedit', ['company' => $editcity]);
    }
    public function update_company_method(Request $updateZone){
        $data = DB::table('company')
            ->where('companyName', $updateZone->id)
            ->update([
                'companyName' => $updateZone->Company,
            ]);
            
        if ($data) {
            return redirect('/show_company');
        }
    }

}
