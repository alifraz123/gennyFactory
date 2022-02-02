<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartyController extends Controller
{
    public function zone_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $zones = DB::table('zones')->get();
            return view('admin/modules/Party/zone', ['zones' => $zones]);
        }
    }

    public function insertZone_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('zones')->where('ZoneName', $request->ZoneName)->orWhere('ZoneCode', $request->ZoneCode)->first();
        if ($checkDuplicateRecord) {

            return redirect('zone')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert("insert into zones(ZoneName,ZoneCode)values(?,?)", [$request->ZoneName, $request->ZoneCode]);
            if ($insertRole) {
                return redirect('zone');
            }
        }
    }


    public function zoneEdit_method(Request $request)
    {
        $roleData = DB::table('zones')->where('ZoneName', $request->ZoneName)->first();
        return $roleData;
    }

    public function  updateZone_method(Request $request)
    {
        if ($request->id == $request->ZoneName && $request->code == $request->ZoneCode) {
            return redirect('zone');
            return "Ff";
        } else {
            $updatedRole = DB::table('zones')->where('ZoneName', $request->id)->update([
                'ZoneName' => $request->ZoneName,
                'ZoneCode' => $request->ZoneCode,
            ]);
            if ($request->id != $request->ZoneName) {
                $areaUpdated =  DB::table('area')->where('ZoneName', $request->id)->update([
                    'ZoneName' => $request->ZoneName
                ]);
                $cityUpdated = DB::table('city')->where('ZoneName', $request->id)->update([
                    'ZoneName' => $request->ZoneName
                ]);
                $partyUpdated = DB::table('party')->where('Zone', $request->id)->update([
                    'Zone' => $request->ZoneName
                ]);
            }
            if ($updatedRole) {
                return redirect('zone');
            }
        }
    }

    public function zoneDelete_method($id)
    {

        $deleted =  DB::table('zones')
            ->where('ZoneName', $id)
            ->delete();
        if ($deleted) {
            return redirect('zone');
        }
    }


    // City code starts from here
    public function city_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $cities = DB::table('city')->get();
            $zones = DB::table('zones')->get();
            return view('admin/modules/Party/city', ['cities' => $cities, 'zones' => $zones]);
        }
    }

    public function insertCity_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('city')->where('CityName', $request->CitName)->orWhere('CityCode', $request->CityCode)->first();
        if ($checkDuplicateRecord) {

            return redirect('city')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert(
                "insert into city(CityName,CityCode,ZoneName)values(?,?,?)",
                [$request->CityName, $request->CityCode, $request->ZoneName]
            );
            if ($insertRole) {
                return redirect('city');
            }
        }
    }

    public function getZoneNameForEdit_method(Request $request)
    {
        $cityZoneName = DB::table('city')->where('CityName', $request->CityName)->first('ZoneName');
        $ZoneName = DB::table('zones')->get('ZoneName');
        return ['cityZoneName' => $cityZoneName, 'ZoneName' => $ZoneName];
    }

    public function cityEdit_method(Request $request)
    {
        $roleData = DB::table('city')->where('CityName', $request->CityName)->first();
        return $roleData;
    }

    public function  updateCity_method(Request $request)
    {
        // return $request->code.$request->CityCode;
        if ($request->id == $request->CityName && $request->code == $request->CityCode) {
            return redirect('city');
        } else {
            $updatedRole = DB::table('city')->where('CityName', $request->id)->update([
                'CityName' => $request->CityName,
                'CityCode' => $request->CityCode,
                'ZoneName' => $request->ZoneName,
            ]);
            if ($request->id != $request->CityName) {
                $areaUpdated = DB::table('area')->where('CityName', $request->id)->update([
                    'CityName' => $request->CityName
                ]);
                $partyUpdated = DB::table('party')->where('City', $request->id)->update([
                    'City' => $request->CityName
                ]);
                // return "second";
            }
            if ($updatedRole) {
                return redirect('city');
            }
        }
    }

    public function cityDelete_method($id)
    {

        $deleted =  DB::table('city')
            ->where('CityName', $id)
            ->delete();
        if ($deleted) {
            return redirect('city');
        }
    }


    // Area code starts from here
    public function area_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $cities = DB::table('city')->get();
            $zones = DB::table('zones')->get();
            $areas = DB::table('area')->get();
            return view('admin/modules/Party/area', ['cities' => $cities, 'zones' => $zones, 'areas' => $areas]);
        }
    }

    public function insertArea_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('area')->where('Area', $request->Area)->first();
        if ($checkDuplicateRecord) {

            return redirect('area')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert(
                "insert into area(Area,CityName,ZoneName)values(?,?,?)",
                [$request->Area, $request->CityName, $request->ZoneName]
            );
            if ($insertRole) {
                return redirect('area');
            }
        }
    }

    public function getZoneNameCityNameForEdit_method(Request $request)
    {
        $area = DB::table('area')->where('Area', $request->Area)->first(['CityName', 'ZoneName']);
        $areaCityName = DB::table('city')->where('CityName', $area->CityName)->first('CityName');
        $areaZoneName = DB::table('zones')->where('ZoneName', $area->ZoneName)->first('ZoneName');
        $zones = DB::table('zones')->get('ZoneName');
        $cities = DB::table('city')->get('CityName');
        return ['areaCityName' => $areaCityName, 'areaZoneName' => $areaZoneName, 'zones' => $zones, 'cities' => $cities];
    }

    public function areaEdit_method(Request $request)
    {
        $roleData = DB::table('area')->where('Area', $request->Area)->first();
        return $roleData;
    }

    public function  updateArea_method(Request $request)
    {

        if ($request->id == $request->Area) {
            return redirect('area');
        } else {
            $updatedRole = DB::table('area')->where('Area', $request->id)->update([
                'Area' => $request->Area,
                'CityName' => $request->CityName,
                'ZoneName' => $request->ZoneName,
            ]);
            if ($request->id != $request->Area) {
                $partyUpdated = DB::table('party')->where('Area', $request->id)->update([
                    'Area' => $request->Area
                ]);
            }
            if ($updatedRole) {
                return redirect('area');
            }
        }
    }

    public function areaDelete_method($id)
    {

        $deleted =  DB::table('area')
            ->where('Area', $id)
            ->delete();
        if ($deleted) {
            return redirect('area');
        }
    }


    //  company code starts from here
    public function company_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $companies = DB::table('companies')->get();
            return view('admin/modules/Party/company', ['companies' => $companies]);
        }
    }

    public function insertCompany_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('companies')->where('CompanyName', $request->company)->first();
        if ($checkDuplicateRecord) {

            return redirect('company')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert("insert into companies(CompanyName)values(?)", [$request->company]);
            if ($insertRole) {
                return redirect('company');
            }
        }
    }

    public function companyEdit_method(Request $request)
    {
        $roleData = DB::table('companies')->where('CompanyName', $request->company)->first();
        return $roleData;
    }

    public function  updateCompany_method(Request $request)
    {
        if ($request->id == $request->company) {
            return redirect('company');
        } else {
            $updatedRole = DB::table('companies')->where('CompanyName', $request->id)->update([
                'CompanyName' => $request->company,
            ]);
            if ($request->id != $request->company) {
                $itemsUpdated = DB::table('items')->where('CompanyName', $request->id)->update([
                    'CompanyName' => $request->company
                ]);
                $partyUpdated = DB::table('party')->where('AccountHead', $request->id)->update([
                    'AccountHead' => $request->company
                ]);
                $accountsCompanyUpdate = DB::table('accountscompany')->where('CompanyName', $request->id)->update([
                    'CompanyName' => $request->company
                ]);
            }
            if ($updatedRole) {
                return redirect('company');
            }
        }
        $updatedRole = DB::table('companies')->where('CompanyName', $request->id)->update([
            'CompanyName' => $request->company,
        ]);
        if ($request->id != $request->company) {
            $itemsUpdated = DB::table('items')->where('CompanyName', $request->id)->update([
                'CompanyName' => $request->company
            ]);
            $partyUpdated = DB::table('party')->where('AccountHead', $request->id)->update([
                'AccountHead' => $request->company
            ]);
            $accountsCompanyUpdate = DB::table('accountscompany')->where('CompanyName', $request->id)->update([
                'CompanyName' => $request->company
            ]);
        }
        if ($updatedRole) {
            return redirect('company');
        }
    }

    public function companyDelete_method($id)
    {

        $deleted =  DB::table('companies')
            ->where('CompanyName', $id)
            ->delete();
        if ($deleted) {
            return redirect('company');
        }
    }

    //  items category code starts from here
    public function itemsCategory_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $categories = DB::table('category')->get();
            return view('admin/modules/Party/itemsCategory', ['categories' => $categories]);
        }
    }

    public function insertItemsCategory_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('category')->where('CategoryName', $request->CategoryName)->first();
        if ($checkDuplicateRecord) {

            return redirect('itemsCategory')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert("insert into category(CategoryName)values(?)", [$request->CategoryName]);
            if ($insertRole) {
                return redirect('itemsCategory');
            }
        }
    }

    public function itemsCategoryEdit_method(Request $request)
    {
        $roleData = DB::table('category')->where('CategoryName', $request->CategoryName)->first();
        return $roleData;
    }

    public function  updateItemsCategory_method(Request $request)
    {

        if ($request->id == $request->CategoryName) {
            return redirect('itemsCategory');
        } else {
            $updatedRole = DB::table('category')->where('CategoryName', $request->id)->update([
                'CategoryName' => $request->CategoryName,

            ]);
            if ($updatedRole) {
                return redirect('itemsCategory');
            }
        }
    }

    public function itemsCategoryDelete_method($id)
    {

        $deleted =  DB::table('category')
            ->where('CategoryName', $id)
            ->delete();
        if ($deleted) {
            return redirect('itemsCategory');
        }
    }


    // items code starts from here
    public function items_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $items = DB::table('items')->get();
            $companies = DB::table('companies')->get();
            $categories = DB::table('category')->get();
            $sesstionCompanyName = session('CompanyName');
            return view('admin/modules/Party/items', [
                'companies' => $companies,
                'items' => $items, 'categories' => $categories, 'sesstionCompanyName' => $sesstionCompanyName
            ]);
        }
    }

    public function insertItems_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('items')->where('ItemName', $request->ItemName)->first();
        if ($checkDuplicateRecord) {
            return redirect('items')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert(
                "insert into items(ItemName,Rate,CompanyName,CategoryName)values(?,?,?,?)",
                [$request->ItemName,$request->Rate,  $request->CompanyName, $request->CategoryName]
            );
            if ($insertRole) {
                return redirect('items');
            }
        }
    }



    public function getCompanyNameForEdit_method(Request $request)
    {
        $itemsCompanyName = DB::table('items')->where('ItemName', $request->itemName)->first(['CompanyName', 'CategoryName']);
        $companies = DB::table('companies')->get('CompanyName');
        $categories = DB::table('category')->get();
        return ['itemsCompanyName' => $itemsCompanyName, 'companies' => $companies, 'categories' => $categories];
    }

    public function itemsEdit_method(Request $request)
    {
        $roleData = DB::table('items')->where('ItemName', $request->itemName)->first();
        return $roleData;
    }

    public function  updateItems_method(Request $request)
    {
        if ($request->id == $request->ItemName) {
            return redirect('items');
        } else {
            $updatedRole = DB::table('items')->where('ItemName', $request->id)->update([
                'ItemName' => $request->ItemName,
                'CompanyName' => $request->CompanyName,
                'CategoryName' => $request->CategoryName,
            ]);
            if ($updatedRole) {
                return redirect('items');
            }
        }
    }

    public function itemsDelete_method($id)
    {

        $deleted =  DB::table('items')
            ->where('ItemName', $id)
            ->delete();
        if ($deleted) {
            return redirect('items');
        }
    }


    //  partyType code starts from here
    public function partyType_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $partyTypes = DB::table('partytype')->get();
            return view('admin/modules/Party/partyType', ['partyTypes' => $partyTypes]);
        }
    }

    public function insertPartyType_method(Request $request)
    {

        $checkDuplicateRecord = DB::table('partytype')->where('partyType', $request->partyType)->first();
        if ($checkDuplicateRecord) {

            return redirect('partyType')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert("insert into partytype(partyType)values(?)", [$request->partyType]);
            if ($insertRole) {
                return redirect('partyType');
            }
        }
    }

    public function partyTypeEdit_method(Request $request)
    {
        $roleData = DB::table('partytype')->where('partyType', $request->partyType)->first();
        return $roleData;
    }

    public function  updatePartyType_method(Request $request)
    {
        if ($request->id == $request->partyType) {
            return redirect('partyType');
        } else {
            $updatedRole = DB::table('partytype')->where('partyType', $request->id)->update([
                'partyType' => $request->partyType,
            ]);
            if ($request->id != $request->partyType) {
                $partyUpdated = DB::table('party')->where('PartyType', $request->id)->update([
                    'PartyType' => $request->partyType
                ]);
            }
            if ($updatedRole) {
                return redirect('partyType');
            }
        }
    }

    public function partyTypeDelete_method($id)
    {

        $deleted =  DB::table('partytype')
            ->where('partyType', $id)
            ->delete();
        if ($deleted) {
            return redirect('partyType');
        }
    }


    //  party code starts from here
    public function party_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $parties = DB::table('party')->where('AccountHead', session('AH'))->get();
            $partyTypes = DB::table('partytype')->get();
            $companies = DB::table('companies')->get();

            $areas = DB::table('area')->get();
            $cities = DB::table('city')->get();
            $zones = DB::table('zones')->get();
            $accountHead = session('AH');
            $companyName = session('CompanyName');
            $bookers = DB::table('accountsemployee')->where('AccountHead', $accountHead)->get('EmployeeName');
            return view(
                'admin/modules/Party/party',
                [
                    'parties' => $parties, 'partyTypes' => $partyTypes, 'companies' => $companies, 'areas' => $areas, 'cities' => $cities,
                    'zones' => $zones, 'accountHead' => $accountHead, 'companyName'=>$companyName, 'bookers' => $bookers
                ]
            );
        }
    }

    public function insertParty_method(Request $request)
    {
        $insertRole = DB::insert("insert into party(AccountHead,PartyName,PartyType,PartyPerson,booker,Cell,CNIC,NTN,SalesTax,
        Percent,Addres,Status,Area,City,Zone)
        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [
            $request->AccountHead, $request->PartyName, $request->partyType, $request->PartyPerson, $request->booker,
            $request->Cell, $request->cnic, $request->ntn, $request->st, $request->percent, $request->addres, 'Enable',
            $request->area, $request->city, $request->zone
        ]);
        if ($insertRole) {
            return redirect('party');
        }
    }

    public function getPartyCodeForEdit_method(Request $request)
    {
        $partyData = DB::table('party')->where('PartyName', $request->PartyName)->first();
        $companies = DB::table('companies')->get();
        $partyTypes = DB::table('partyType')->get();
        $areas = DB::table('area')->get();
        $cities = DB::table('city')->get();
        $zones = DB::table('zones')->get();
        $accountHead = session('AH');
        $bookers = DB::table('accountsemployee')->where('AccountHead', $accountHead)->get('EmployeeName');
        return [
            'AccountHead' => $partyData->AccountHead, 'companies' => $companies, 'partyPartyType' => $partyData->PartyType,
            'partyTypes' => $partyTypes, 'area' => $partyData->Area, 'areas' => $areas, 'city' => $partyData->City, 'cities' => $cities,
            'zone' => $partyData->Zone, 'zones' => $zones, 'bookers' => $bookers, 'bookerData' => $partyData->booker
        ];
    }
    public function partyEdit_method(Request $request)
    {
        $roleData = DB::table('party')->where('PartyName', $request->PartyName)->first();
        return $roleData;
    }

    public function  updateParty_method(Request $request)
    {
        
            $updatedRole = DB::table('party')->where('PartyName', $request->id)->update([
                'PartyName' => $request->PartyName,
                'PartyType' => $request->PartyType,
                'PartyPerson' => $request->PartyPerson,
                'booker' => $request->booker,
                'Cell' => $request->Cell,
                'CNIC' => $request->CNIC,
                'NTN' => $request->NTN,
                'SalesTax' => $request->SalesTax,
                'Percent' => $request->Percent,
                'Addres' => $request->Addres,
                'Status' => $request->Status,
                'Area' => $request->Area,
                'City' => $request->City,
                'Zone' => $request->Zone,
                'AccountHead' => $request->AccountHead,

            ]);
            if ($request->id_PartyName != $request->PartyName) {
                $useraccountUpdated = DB::table('useraccount')->where('AccountHead', $request->id_PartyName)->update([
                    'AccountHead' => $request->PartyName
                ]);
                $accountsCompanyUpdate = DB::table('accountscompany')->where('AccountHead', $request->id_PartyName)->update([
                    'AccountHead' => $request->PartyName
                ]);
                $accountsemployeeUpdate = DB::table('accountsemployee')->where('AccountHead', $request->id_PartyName)->update([
                    'AccountHead' => $request->PartyName
                ]);
                // return $request->PartyName;
                $partyAccountHeadUpdate = DB::table('party')->where('AccountHead', $request->id_PartyName)->update([
                    'AccountHead' => $request->PartyName,

                ]);
                if ($updatedRole) {

                    return redirect('party');
                }
            } else {
                return redirect('party');
            }
        
    }

    public function partyDelete_method($id)
    {

        $deleted =  DB::table('party')
            ->where('partyCode', $id)
            ->delete();
        if ($deleted) {
            return redirect('party');
        }
    }

    public function getCitiesOfSelectedZone_method(Request $request)
    {
        return DB::table('city')->where('ZoneName', $request->ZoneName)->get('CityName');
    }
    public function getCityNameOfSelectedZone2_method(Request $request)
    {
        return DB::table('city')->where('ZoneName', $request->ZoneName)->get('CityName');
    }
    public function getAreaOfSelectedCity2_method(Request $request)
    {
        return DB::table('area')->where('CityName', $request->CityName)->get('Area');
    }

    public function getCitiesOfSelectedZone2_method(Request $request)
    {
        // return $request->ZoneName;
        return DB::table('city')->where('ZoneName', $request->ZoneName)->get('CityName');
    }


    //  userAccount code starts from here
    public function useraccount_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {

            $loginUserName = Auth::user()->name;
            $useraccounts =  DB::table('party')->get('PartyName');
            $CompanyNames = DB::table('companies')->get('CompanyName');
            // return $useraccounts.$CompanyNames;
            $outpurArray1 = [];
            $outpurArray2 = [];
            for ($a = 0; $a < count($useraccounts); $a++) {
                $outpurArray1[$a] = $useraccounts[$a]->PartyName;
            }
            for ($b = 0; $b < count($CompanyNames); $b++) {
                $outpurArray2[$b] = $CompanyNames[$b]->CompanyName;
            }
            $parties = array_merge($outpurArray1, $outpurArray2);

            $usernames = DB::table('users')->distinct()->get('name');
            // $parties = DB::table('party')->get('PartyName');
            $useraccounts = DB::table('useraccount')->get();
            return view('admin/modules/Party/UserAccount', [
                'usernames' => $usernames,
                'parties' => $parties, 'useraccounts' => $useraccounts
            ]);
        }
    }

    public function insertUserAccount_method(Request $request)
    {
        $insertRole = DB::insert(
            "insert into useraccount(UserName,AccountHead)values(?,?)",
            [$request->UserName, $request->AccountHead]
        );
        if ($insertRole) {
            return redirect('useraccount');
        }
    }

    public function userAccountEdit_method(Request $request)
    {
        $useraccount = DB::table('useraccount')->where('id', $request->id)->first();
        $usernames = DB::table('users')->distinct()->get('name');
        $parties = DB::table('party')->distinct()->get('PartyName');
        return [
            'id' => $useraccount->id, 'UserName' => $useraccount->UserName, 'usernames' => $usernames, 'AccountHead' => $useraccount->AccountHead,
            'parties' => $parties
        ];
    }

    public function  updateUserAccount_method(Request $request)
    {
        $updatedRole = DB::table('useraccount')->where('id', $request->id)->update([
            'UserName' => $request->UserName,
            'AccountHead' => $request->AccountHead,
        ]);

        return redirect('useraccount');
    }

    public function userAccountDelete_method($id)
    {

        $deleted =  DB::table('useraccount')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('useraccount');
        }
    }


    //  Account Company code starts from here
    public function accountcompany_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $parties = DB::table('useraccount')->distinct()->get('AccountHead');
            $companies = DB::table('companies')->distinct()->get('CompanyName');
            $accountscompanies = DB::table('accountscompany')->get();
            return view('admin/modules/Party/AccountCompany', [
                'companies' => $companies,
                'parties' => $parties, 'accountscompanies' => $accountscompanies
            ]);
        }
    }

    public function insertAccountCompany_method(Request $request)
    {
        $insertRole = DB::insert(
            "insert into accountscompany(AccountHead,CompanyName)values(?,?)",
            [$request->AccountHead, $request->CompanyName]
        );
        if ($insertRole) {
            return redirect('accountcompany');
        }
    }

    public function accountCompanyEdit_method(Request $request)
    {
        $accountscompany = DB::table('accountscompany')->where('id', $request->id)->first();
        $accountHead = DB::table('useraccount')->distinct()->get('AccountHead');
        $companies = DB::table('companies')->distinct()->get('CompanyName');
        return [
            'id' => $accountscompany->id, 'AccountHead' => $accountscompany->AccountHead, 'parties' => $accountHead,
            'CompanyName' => $accountscompany->CompanyName, 'companies' => $companies,
        ];
    }

    public function  updateAccountCompany_method(Request $request)
    {
        $updatedRole = DB::table('accountscompany')->where('id', $request->id)->update([
            'AccountHead' => $request->AccountHead,
            'CompanyName' => $request->CompanyName,
        ]);
        return redirect('accountcompany');
    }

    public function accountCompanyDelete_method($id)
    {

        $deleted =  DB::table('accountscompany')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('accountcompany');
        }
    }

    //  Account Employee code starts from here
    public function accountemployee_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $userAccount_AccountHead = DB::table('useraccount')->distinct()->get('AccountHead');
            $names = DB::table('users')->distinct()->get('name');
            $accountemployees = DB::table('accountsemployee')->get();
            return view('admin/modules/Party/accountemployee', [
                'userAccount_AccountHeads' => $userAccount_AccountHead,
                'names' => $names,
                'accountemployees' => $accountemployees
            ]);
        }
    }

    public function insertAccountEmployee_method(Request $request)
    {
        $insertRole = DB::insert(
            "insert into accountsemployee(AccountHead,EmployeeName)values(?,?)",
            [$request->AccountHead, $request->EmployeeName]
        );
        if ($insertRole) {
            return redirect('accountemployee');
        }
    }

    public function accountEmployeeEdit_method(Request $request)
    {
        $accountscompany = DB::table('accountsemployee')->where('id', $request->id)->first();
        $accountHeads = DB::table('useraccount')->distinct()->get('AccountHead');
        $employees = DB::table('users')->distinct()->get('name');
        return [
            'id' => $accountscompany->id, 'AccountHead' => $accountscompany->AccountHead, 'AccountHeads' => $accountHeads,
            'EmployeeName' => $accountscompany->EmployeeName, 'employees' => $employees,
        ];
    }

    public function  updateAccountEmployee_method(Request $request)
    {
        $updatedRole = DB::table('accountsemployee')->where('id', $request->id)->update([
            'AccountHead' => $request->AccountHead,
            'EmployeeName' => $request->EmployeeName,
        ]);
        return redirect('accountemployee');
    }

    public function accountEmployeeDelete_method($id)
    {

        $deleted =  DB::table('accountsemployee')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('accountemployee');
        }
    }
}
