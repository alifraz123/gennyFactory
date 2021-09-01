<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavecitydataController;
use App\Http\Controllers\SavePartydataController;
use App\Http\Controllers\SaveItemsdataController;
use App\Http\Controllers\SaveSalesBookdataController;
use App\Http\Controllers\SaveSalesBookDetaildataController;
use App\Http\Controllers\Cashbook;
use App\Http\Controllers\Stock;
use App\Http\Controllers\Dispatch;
use App\Http\Controllers\report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

// Material code start
Route::post('save_materialdata', [App\Http\Controllers\SavePartydataController::class, 'save_materialdata_method']);
Route::get('show_material', [App\Http\Controllers\SavePartydataController::class, 'show_material_method']);
Route::get('delete_materialdata/{id}', [App\Http\Controllers\SavePartydataController::class, 'delete_materialdata_method']);
Route::get('edit_materialdata/{id}', [App\Http\Controllers\SavePartydataController::class, 'edit_materialdata_method']);
Route::get('/materialeditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Material/materialedit');
    }
});
Route::post('edit_materialdata', [App\Http\Controllers\SavePartydataController::class, 'update_materialdata_method']);



Route::get('/sv', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Supplier_and_Vender/sv');
    }
});
Route::post('save_svdata', [App\Http\Controllers\SavecitydataController::class, 'save_svdata_method']);
Route::get('show_svdata', [App\Http\Controllers\SavecitydataController::class, 'show_svdata_method']);
Route::get('delete_svdata/{id}', [App\Http\Controllers\SavecitydataController::class, 'delete_svdata_method']);
Route::get('edit_svdata/{id}', [App\Http\Controllers\SavecitydataController::class, 'edit_svdata_method']);
Route::get('/sveditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Supplier_and_Vender/svedit');
    }
});
Route::post('edit_svdata', [App\Http\Controllers\SavecitydataController::class, 'update_svdata_method']);
Route::get('/items', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Items/item');
    }
});

Route::get('show_zone', [App\Http\Controllers\SavecitydataController::class, 'show_zone_method']);
Route::post('save_zone', [App\Http\Controllers\SavecitydataController::class, 'save_zone_method']);
Route::get('delete_zone/{id}', [App\Http\Controllers\SavecitydataController::class, 'delete_zone_method']);
Route::get('edit_zone/{id}', [App\Http\Controllers\SavecitydataController::class, 'edit_zone_method']);
Route::post('update_zone', [App\Http\Controllers\SavecitydataController::class, 'update_zone_method']);



Route::get('show_city', [App\Http\Controllers\SavecitydataController::class, 'show_city_method']);
Route::post('save_city', [App\Http\Controllers\SavecitydataController::class, 'save_city_method']);
Route::get('delete_city/{id}', [App\Http\Controllers\SavecitydataController::class, 'delete_city_method']);
Route::get('edit_city/{id}', [App\Http\Controllers\SavecitydataController::class, 'edit_city_method']);
Route::post('update_city', [App\Http\Controllers\SavecitydataController::class, 'update_city_method']);



// items code
Route::post('save_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'save_itemsdata_method']);
Route::get('show_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'show_itemsdata_method']);
Route::get('delete_itemsdata/{id}', [App\Http\Controllers\SaveItemsdataController::class, 'delete_itemsdata_method']);
Route::get('edit_itemsdata/{id}', [App\Http\Controllers\SaveItemsdataController::class, 'edit_itemsdata_method']);
Route::get('/itemesditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Items/item');
    }
});
Route::post('edit_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'update_itemsdata_method']);


// company code
Route::post('save_company', [App\Http\Controllers\SavecitydataController::class, 'save_company_method']);
Route::get('show_company', [App\Http\Controllers\SavecitydataController::class, 'show_company_method']);
Route::get('delete_company/{id}', [App\Http\Controllers\SavecitydataController::class, 'delete_company_method']);
Route::get('edit_company/{id}', [App\Http\Controllers\SavecitydataController::class, 'edit_company_method']);
Route::post('edit_company', [App\Http\Controllers\SavecitydataController::class, 'update_company_method']);


// Stock code
Route::post('save_stockdata', [App\Http\Controllers\Stock::class, 'save_stockdata_method']);
Route::get('show_Stockdata', [App\Http\Controllers\Stock::class, 'show_Stockdata_method']);
Route::get('delete_stockdata/{id}', [App\Http\Controllers\Stock::class, 'delete_stockdata_method']);
Route::get('edit_stockdata/{id}', [App\Http\Controllers\Stock::class, 'edit_stockdata_method']);
Route::get('/stockditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Items/item');
    }
});
Route::post('edit_stockdata', [App\Http\Controllers\Stock::class, 'update_Stockdata_method']);
Route::post('getItemsOfSelectedCompany', [App\Http\Controllers\Stock::class, 'getItemsOfSelectedCompany_method']);
Route::post('getItemsOfSelectedCompany_For_dispatch', [App\Http\Controllers\Stock::class,
'getItemsOfSelectedCompany_For_dispatch_method']);


// Dispatch code
Route::get('/salesbook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $sup_and_ven = DB::table('sup_and_ven')->get();
        $items = DB::table('items')->get();
        $stock = DB::table('stock')->get();
        $zones = DB::table('zone')->get();
        $companies = DB::table('company')->get();
        return view('admin/modules/SalesBook/salesbook', ['parties' => $sup_and_ven,'zones'=>$zones,
         'items' => $items, 'stocks' => $stock,'companies'=>$companies]);
    }
});
Route::post('getDateOfSelectedSupplier', [App\Http\Controllers\Dispatch::class, 'getDateOfSelectedSupplier_method']);
Route::post('dispatch', [App\Http\Controllers\Dispatch::class, 'dispatch_method']);
Route::get('edit_salesbookinvoice', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('sup_and_ven')->get();
        return view('admin/modules/SalesBook/salesbookedit', ['parties' => $parties]);
    }
});
Route::get('getInvoicesForEdit', [App\Http\Controllers\Dispatch::class, 'getInvoicesForEdit_method']);
Route::get('edit_invoice/{id}', [App\Http\Controllers\Dispatch::class, 'edit_invoice_method']);
Route::post('update_dispatch', [App\Http\Controllers\Dispatch::class, 'update_dispatch']);
Route::get('delete_dispatch', [App\Http\Controllers\Dispatch::class, 'delete_dispatch']);


// Reports code start from here
Route::get('Report', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $sup_ven = DB::table('sup_and_ven')->get();
        return view('admin/modules/reports/Report', ['sup_ven' => $sup_ven]);
    }
});

Route::get('MTN_CTN_Dispatch', [App\Http\Controllers\report::class, 'MTN_CTN_Dispatch_method']);

Route::post('getOrderDetailOfSelectedSupplier', [App\Http\Controllers\report::class, 'getOrderDetailOfSelectedSupplier_method']);

Route::get('MTN_Dispatch', [App\Http\Controllers\report::class, 'MTN_Dispatch_method']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
