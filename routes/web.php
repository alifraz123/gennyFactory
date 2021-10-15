<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DispatchController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/admin', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/dashboard/index');
    }
});

Route::get('roles', [App\Http\Controllers\UserController::class, 'roles_method']);
Route::post('insertRole', [App\Http\Controllers\UserController::class, 'insertRole_method']);
Route::get('roleEdit', [App\Http\Controllers\UserController::class, 'roleEdit_method']);
Route::post('updateRole', [App\Http\Controllers\UserController::class, 'updateRole_method']);
Route::get('roleDelete/{id}', [App\Http\Controllers\UserController::class, 'roleDelete_method']);


Route::get('userType', [App\Http\Controllers\UserController::class, 'userType_method']);
Route::post('insertUserType', [App\Http\Controllers\UserController::class, 'insertUserType_method']);
Route::get('userTypeEdit', [App\Http\Controllers\UserController::class, 'userTypeEdit_method']);
Route::post('updateUserType', [App\Http\Controllers\UserController::class, 'updateUserType_method']);
Route::get('userTypeDelete/{id}', [App\Http\Controllers\UserController::class, 'userTypeDelete_method']);

Route::get('createUser', [App\Http\Controllers\UserController::class, 'createUser_method']);
Route::post('insertCreatedUser', [App\Http\Controllers\UserController::class, 'insertCreatedUser_method']);
Route::get('createdUserEdit', [App\Http\Controllers\UserController::class, 'createdUserEdit_method']);
Route::get('createdUserDelete/{id}', [App\Http\Controllers\UserController::class, 'createdUserDelete_method']);
Route::post('updateCreatedUser', [App\Http\Controllers\UserController::class, 'updateCreatedUser_method']);
Route::post('getUserTypeAndRoleFromDB', [App\Http\Controllers\UserController::class, 'getUserTypeAndRoleFromDB_method']);

Route::get('zone', [App\Http\Controllers\PartyController::class, 'zone_method']);
Route::post('insertZone', [App\Http\Controllers\PartyController::class, 'insertZone_method']);
Route::get('zoneEdit', [App\Http\Controllers\PartyController::class, 'zoneEdit_method']);
Route::post('updateZone', [App\Http\Controllers\PartyController::class, 'updateZone_method']);
Route::get('zoneDelete/{id}', [App\Http\Controllers\PartyController::class, 'zoneDelete_method']);

Route::get('city', [App\Http\Controllers\PartyController::class, 'city_method']);
Route::post('insertCity', [App\Http\Controllers\PartyController::class, 'insertCity_method']);
Route::get('cityEdit', [App\Http\Controllers\PartyController::class, 'cityEdit_method']);
Route::post('updateCity', [App\Http\Controllers\PartyController::class, 'updateCity_method']);
Route::get('cityDelete/{id}', [App\Http\Controllers\PartyController::class, 'cityDelete_method']);
Route::post('getZoneNameForEdit', [App\Http\Controllers\PartyController::class, 'getZoneNameForEdit_method']);



Route::get('area', [App\Http\Controllers\PartyController::class, 'area_method']);
Route::post('insertArea', [App\Http\Controllers\PartyController::class, 'insertArea_method']);
Route::get('areaEdit', [App\Http\Controllers\PartyController::class, 'areaEdit_method']);
Route::post('updateArea', [App\Http\Controllers\PartyController::class, 'updateArea_method']);
Route::get('areaDelete/{id}', [App\Http\Controllers\PartyController::class, 'areaDelete_method']);
Route::post('getZoneNameCityNameForEdit', [App\Http\Controllers\PartyController::class, 'getZoneNameCityNameForEdit_method']);



Route::get('company', [App\Http\Controllers\PartyController::class, 'company_method']);
Route::post('insertCompany', [App\Http\Controllers\PartyController::class, 'insertCompany_method']);
Route::get('companyEdit', [App\Http\Controllers\PartyController::class, 'companyEdit_method']);
Route::post('updateCompany', [App\Http\Controllers\PartyController::class, 'updateCompany_method']);
Route::get('companyDelete/{id}', [App\Http\Controllers\PartyController::class, 'companyDelete_method']);

Route::get('itemsCategory', [App\Http\Controllers\PartyController::class, 'itemsCategory_method']);
Route::post('insertItemsCategory', [App\Http\Controllers\PartyController::class, 'insertItemsCategory_method']);
Route::get('itemsCategoryEdit', [App\Http\Controllers\PartyController::class, 'itemsCategoryEdit_method']);
Route::post('updateItemsCategory', [App\Http\Controllers\PartyController::class, 'updateItemsCategory_method']);
Route::get('itemsCategoryDelete/{id}', [App\Http\Controllers\PartyController::class, 'itemsCategoryDelete_method']);


Route::get('items', [App\Http\Controllers\PartyController::class, 'items_method']);
Route::post('insertItems', [App\Http\Controllers\PartyController::class, 'insertItems_method']);
Route::get('itemsEdit', [App\Http\Controllers\PartyController::class, 'itemsEdit_method']);
Route::post('updateItems', [App\Http\Controllers\PartyController::class, 'updateItems_method']);
Route::get('itemsDelete/{id}', [App\Http\Controllers\PartyController::class, 'itemsDelete_method']);
Route::post('getCompanyNameForEdit', [App\Http\Controllers\PartyController::class, 'getCompanyNameForEdit_method']);

Route::get('partyType', [App\Http\Controllers\PartyController::class, 'partyType_method']);
Route::post('insertPartyType', [App\Http\Controllers\PartyController::class, 'insertPartyType_method']);
Route::get('partyTypeEdit', [App\Http\Controllers\PartyController::class, 'partyTypeEdit_method']);
Route::post('updatePartyType', [App\Http\Controllers\PartyController::class, 'updatePartyType_method']);
Route::get('partyTypeDelete/{id}', [App\Http\Controllers\PartyController::class, 'partyTypeDelete_method']);


Route::get('party', [App\Http\Controllers\PartyController::class, 'party_method']);
Route::post('insertParty', [App\Http\Controllers\PartyController::class, 'insertParty_method']);
Route::get('partyEdit', [App\Http\Controllers\PartyController::class, 'partyEdit_method']);
Route::post('updateParty', [App\Http\Controllers\PartyController::class, 'updateParty_method']);
Route::post('getPartyCodeForEdit', [App\Http\Controllers\PartyController::class, 'getPartyCodeForEdit_method']);

Route::get('useraccount', [App\Http\Controllers\PartyController::class, 'useraccount_method']);
Route::post('insertUserAccount', [App\Http\Controllers\PartyController::class, 'insertUserAccount_method']);
Route::get('userAccountEdit', [App\Http\Controllers\PartyController::class, 'userAccountEdit_method']);
Route::post('updateUserAccount', [App\Http\Controllers\PartyController::class, 'updateUserAccount_method']);
Route::get('userAccountDelete/{id}', [App\Http\Controllers\PartyController::class, 'userAccountDelete_method']);

Route::get('accountcompany', [App\Http\Controllers\PartyController::class, 'accountcompany_method']);
Route::post('insertAccountCompany', [App\Http\Controllers\PartyController::class, 'insertAccountCompany_method']);
Route::get('accountCompanyEdit', [App\Http\Controllers\PartyController::class, 'accountCompanyEdit_method']);
Route::post('updateAccountCompany', [App\Http\Controllers\PartyController::class, 'updateAccountCompany_method']);
Route::get('accountCompanyDelete/{id}', [App\Http\Controllers\PartyController::class, 'accountCompanyDelete_method']);

Route::get('accountemployee', [App\Http\Controllers\PartyController::class, 'accountemployee_method']);
Route::post('insertAccountEmployee', [App\Http\Controllers\PartyController::class, 'insertAccountEmployee_method']);
Route::get('accountEmployeeEdit', [App\Http\Controllers\PartyController::class, 'accountEmployeeEdit_method']);
Route::post('updateAccountEmployee', [App\Http\Controllers\PartyController::class, 'updateAccountEmployee_method']);
Route::get('accountEmployeeDelete/{id}', [App\Http\Controllers\PartyController::class, 'accountEmployeeDelete_method']);


// Dashboar code starts from here
Route::get('getAccountHeadFromUserAccountTable', [App\Http\Controllers\UserController::class, 
'getAccountHeadFromUserAccountTable_method']);

Route::get('setSessionAH', [App\Http\Controllers\UserController::class, 
'setSessionAH_method']);
Route::get('getCompaniesFromAccountsCompany', [App\Http\Controllers\UserController::class, 
'getCompaniesFromAccountsCompany_method']);
Route::get('setSessionCompany', [App\Http\Controllers\UserController::class, 
'setSessionCompany_method']);
Route::get('getCityNameForMakingPartyCode', [App\Http\Controllers\UserController::class, 
'getCityNameForMakingPartyCode_method']);

Route::get('getCityNameForMakingPartyCode2', [App\Http\Controllers\UserController::class, 
'getCityNameForMakingPartyCode2_method']);

Route::get('getCitiesOfSelectedZone', [App\Http\Controllers\PartyController::class, 
'getCitiesOfSelectedZone_method']);

Route::get('getCityNameOfSelectedZone2', [App\Http\Controllers\PartyController::class, 
'getCityNameOfSelectedZone2_method']);

Route::get('getAreasOfSelectedCity', [App\Http\Controllers\PartyController::class, 
'getAreasOfSelectedCity_method']);

Route::get('getAreaOfSelectedCity2', [App\Http\Controllers\PartyController::class, 
'getAreasOfSelectedCity_method']);


Route::get('getCitiesOfSelectedZone2', [App\Http\Controllers\PartyController::class, 
'getCitiesOfSelectedZone2_method']);

Route::post('checkDuplicationOfPartyName', [App\Http\Controllers\PartyController::class, 'checkDuplicationOfPartyName_method']);

Route::get('checkDuplication', [App\Http\Controllers\UserController::class, 
'checkDuplication_method']);

// itemsRate code starts from here
Route::get('itemRate', [App\Http\Controllers\StockController::class, 'itemRate_method']);
Route::post('insertItemRate', [App\Http\Controllers\StockController::class, 'insertItemRate_method']);
Route::get('itemRateEdit', [App\Http\Controllers\StockController::class, 'itemRateEdit_method']);
Route::post('updateItemRate', [App\Http\Controllers\StockController::class, 'updateItemRate_method']);
Route::get('itemRateDelete/{id}', [App\Http\Controllers\StockController::class, 'itemRateDelete_method']);
Route::get('getItemNameOfItemRate', [App\Http\Controllers\StockController::class, 'getItemNameOfItemRate_method']);
Route::get('getPartyTypeOfItemRate', [App\Http\Controllers\StockController::class, 'getPartyTypeOfItemRate_method']);
Route::get('checkDuplicationOfItemRateData', [App\Http\Controllers\StockController::class, 'checkDuplicationOfItemRateData_method']);


// stock code starts from here
Route::get('stock', [App\Http\Controllers\StockController::class, 'stock_method']);
Route::post('insertStock', [App\Http\Controllers\StockController::class, 'insertStock_method']);
Route::get('stockEdit', [App\Http\Controllers\StockController::class, 'stockEdit_method']);
Route::post('updateStock', [App\Http\Controllers\StockController::class, 'updateStock_method']);
Route::get('stockDelete/{id}', [App\Http\Controllers\StockController::class, 'stockDelete_method']);
Route::get('getItemNameOfStock', [App\Http\Controllers\StockController::class, 'getItemNameOfStock_method']);
Route::get('checkDuplicationOfStockData', [App\Http\Controllers\StockController::class, 'checkDuplicationOfStockData_method']);

// Salebook code starts from here
Route::get('/salebook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
     
        return view('admin/modules/SalesBook/salesbook');
    }
});
Route::post('getDateOfSelectedSupplier', [App\Http\Controllers\DispatchController::class, 'getDateOfSelectedSupplier_method']);
Route::post('dispatch', [App\Http\Controllers\DispatchController::class, 'dispatch_method']);
Route::get('edit_salesbook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('salebook')->where('AccountHead',session('AH'))->distinct()->get('PartyName');
        return view('admin/modules/SalesBook/salesbookedit', ['parties' => $parties]);
    }
});
Route::get('getInvoicesForEdit', [App\Http\Controllers\DispatchController::class, 'getInvoicesForEdit_method']);
Route::get('edit_invoice/{id}', [App\Http\Controllers\DispatchController::class, 'edit_invoice_method']);
Route::post('update_dispatch', [App\Http\Controllers\DispatchController::class, 'update_dispatch']);
Route::get('delete_dispatch', [App\Http\Controllers\DispatchController::class, 'delete_dispatch']);
Route::get('getCitiesOfSelectedAccountHead', [App\Http\Controllers\DispatchController::class, 'getCitiesOfSelectedAccountHead_method']);
Route::get('getAreaOfSelectedCity_sale', [App\Http\Controllers\DispatchController::class, 'getAreaOfSelectedCity_sale_method']);
Route::get('getPartiesOfSelectedArea', [App\Http\Controllers\DispatchController::class, 'getPartiesOfSelectedArea_method']);
Route::get('getPartyNamesOfSelectedBooker_sale', [App\Http\Controllers\DispatchController::class, 'getPartyNamesOfSelectedBooker_sale']);
Route::get('getDataOfSelectedPartyName_sale', [App\Http\Controllers\DispatchController::class, 'getDataOfSelectedPartyName_sale']);
Route::get('getItemNames_Of_Selected_AccountHead_And_CompanyName', [App\Http\Controllers\DispatchController::class,
 'getItemNames_Of_Selected_AccountHead_And_CompanyName']);
 Route::get('getPriceFromRateTable_sale', [App\Http\Controllers\DispatchController::class,
  'getPriceFromRateTable_sale_method']);
  Route::get('getPriceFromItemsTable_sale', [App\Http\Controllers\DispatchController::class, 'getPriceFromItemsTable_sale']);


//   Cashbook code starts from here
Route::get('/cashBook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
     
        return view('admin/modules/SalesBook/CashBook/cashBook');
    }
});
Route::post('dispatch_cash', [App\Http\Controllers\DispatchController::class, 'dispatch_cash_method']);
  

//   JournalVoucher code starts from here
Route::get('/journalVoucher', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
     
        return view('admin/modules/SalesBook/JournalVoucher/journalVoucher');
    }
});
Route::post('dispatch_journalVoucher', [App\Http\Controllers\DispatchController::class, 'dispatch_journalVoucher_method']);

//   SaleReturn code starts from here
Route::get('/saleReturn', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
     
        return view('admin/modules/SalesBook/SaleReturn/saleReturn');
    }
});
Route::post('dispatch_journalVoucher', [App\Http\Controllers\DispatchController::class, 'dispatch_journalVoucher_method']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
