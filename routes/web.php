<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavecitydataController;
use App\Http\Controllers\SavePartydataController;
use App\Http\Controllers\SaveItemsdataController;
use App\Http\Controllers\SaveSalesBookdataController;
use App\Http\Controllers\SaveSalesBookDetaildataController;
use App\Http\Controllers\Cashbook;
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


Route::get('/parties', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('cities')->get();
        $count_result = DB::table('parties')->latest('PartyCode')->first();
        return view('admin/modules/Parties/company', ['data' => $parties, 'pc' => $count_result->PartyCode + 1]);
    }
});
Route::post('save_partydata', [App\Http\Controllers\SavePartydataController::class, 'save_partydata_method']);
Route::get('show_companydata', [App\Http\Controllers\SavePartydataController::class, 'show_companydata_method']);
Route::get('delete_partydata/{id}', [App\Http\Controllers\SavePartydataController::class, 'delete_companydata_method']);
Route::get('edit_partydata/{id}', [App\Http\Controllers\SavePartydataController::class, 'edit_companydata_method']);
Route::get('/partyeditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Parties/companyedit');
    }
});
Route::post('edit_companydata', [App\Http\Controllers\SavePartydataController::class, 'update_companydata_method']);
Route::get('enterPartyData', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('cities')->get();
        $count_result = DB::table('parties')->latest('PartyCode')->first();
        return view('admin/modules/Parties/enterPartyData', ['data' => $parties, 'pc' => $count_result->PartyCode + 1]);
    }
});



Route::get('/cities', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Cities/city');
    }
});
Route::post('save_citydata', [App\Http\Controllers\SavecitydataController::class, 'save_citydata_method']);
Route::get('show_citydata', [App\Http\Controllers\SavecitydataController::class, 'show_companydata_method']);
Route::get('delete_citydata/{id}', [App\Http\Controllers\SavecitydataController::class, 'delete_companydata_method']);
Route::get('edit_citydata/{id}', [App\Http\Controllers\SavecitydataController::class, 'edit_companydata_method']);
Route::get('/cityeditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Cities/cityedit');
    }
});
Route::post('edit_citydata', [App\Http\Controllers\SavecitydataController::class, 'update_companydata_method']);
Route::get('enterCityData', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
      
        return view('admin/modules/Cities/enterCityData');
    }
});

Route::get('/items', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Items/item');
    }
});
Route::post('save_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'save_citydata_method']);
Route::get('show_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'show_companydata_method']);
Route::get('delete_itemsdata/{id}', [App\Http\Controllers\SaveItemsdataController::class, 'delete_companydata_method']);
Route::get('edit_itemsdata/{id}', [App\Http\Controllers\SaveItemsdataController::class, 'edit_companydata_method']);
Route::get('/itemesditform', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/Items/item');
    }
});
Route::post('edit_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'update_companydata_method']);
Route::get('enterItemData', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
      
        return view('admin/modules/Items/enterItemData');
    }
});



Route::get('/salesbook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $cities = DB::table('cities')->get();
        $parties = DB::table('parties')->get();
        $items = DB::table('items')->get();
        $salebook = DB::table('salebook')->latest()->first();
        $productSaleId = 0;
        if (null || empty($salebook)) {
            $productSaleId = 1;
        } else {
            $productSaleId = $salebook->invoice + 1;
        }
        return view('admin/modules/SalesBook/salesbook', ['data' => $cities, 'parties' => $parties, 'productSaleId' => $productSaleId, 'items' => $items]);
    }
});
Route::post('getSelectedProductData', [App\Http\Controllers\SaveSalesBookdataController::class, 'getSelectedProductData_method']);
Route::post('getCityOfSelectedParty', [App\Http\Controllers\SaveSalesBookdataController::class, 'getCityOfSelectedParty_method']);

Route::post('getBalanceOfCurrentParty', [App\Http\Controllers\SavePartydataController::class, 
'getBalanceOfCurrentParty_method']);

Route::post('sendMultipleData', [App\Http\Controllers\SavePartydataController::class, 'sendMultipleData_method']);
Route::post('sendMultipleData_edit', [App\Http\Controllers\SavePartydataController::class, 'sendMultipleData_edit']);
Route::get('edit_salesbookinvoice', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('parties')->get();
        return view('admin/modules/SalesBook/salesbookedit', ['parties' => $parties]);
    }
});

Route::get('getInvoicesForEdit', [App\Http\Controllers\SaveSalesBookdataController::class, 'getInvoicesForEdit_method']);
Route::get('showSaleInvoices', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/SalesBook/showSaleInvoices');
    }
});
Route::get('edit_invoice/{id}', [App\Http\Controllers\SaveSalesBookdataController::class, 'edit_invoice_method']);
Route::get('edit_cashbook/{id}', [App\Http\Controllers\SaveSalesBookdataController::class, 'edit_cashbook_method']);
Route::get('cashbook', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $cities = DB::table('cities')->get();
        $parties = DB::table('parties')->get();
        $items = DB::table('items')->get();
        $salebook = DB::table('salebook')->latest()->first();
        $productSaleId = 0;
        if (null || empty($salebook)) {
            $productSaleId = 1;
        } else {
            $productSaleId = $salebook->invoice + 1;
        }
        return view('admin/modules/cashbook/cashbook', [
            'data' => $cities, 'parties' => $parties,
            'productSaleId' => $productSaleId, 'items' => $items
        ]);
    }
});
Route::get('edit_cashbookinvoice', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('parties')->get();
        return view('admin/modules/cashbook/edit_cashbookinvoice', ['parties' => $parties]);
    }
});
Route::get('getCashBookForEdit', [App\Http\Controllers\SaveSalesBookdataController::class, 'getCashBookForEdit_method']);
Route::post('getPartyData', [App\Http\Controllers\Cashbook::class, 'getPartyData_method']);
Route::post('sendCashbookData', [App\Http\Controllers\Cashbook::class, 'sendCashbookData_method']);
Route::post('updateCashbookData', [App\Http\Controllers\Cashbook::class, 'updateCashbookData_method']);
Route::post('getCompleteReport', [App\Http\Controllers\Cashbook::class, 'getCompleteReport_method']);
Route::post('getOpeningBalance', [App\Http\Controllers\Cashbook::class, 'getOpeningBalance_method']);


Route::get('Report', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        $parties = DB::table('parties')->get();
        return view('admin/modules/reports/Report', ['parties' => $parties]);
    }
});
Route::get('PartyLedger', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/reports/PartyLedger');
    }
});
Route::get('PartyDetailedLedger', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/reports/PartyDetailedLedger');
    }
});
Route::get('completeReport', function () {
    if (Auth::guest()) {
        return redirect('login');
    } else {
        return view('admin/modules/reports/completeReport');
    }
});
Route::post('getPartyNameForReport',function(Request $request){
return DB::table('parties')->where('PartyName',$request->PartyName)->get();
});
Route::post('getPartyLedger', function (Request $request) {

    return DB::table('salebook')->whereBetween('Date', [$request->startDate, $request->endDate])
        ->where('PartyName', $request->PartyName)->get();
});

Route::post('getDebitOfCurrentParty', [App\Http\Controllers\SavePartydataController::class, 
'getDebitOfCurrentParty_method']);

Route::post('getCreditOfCurrentParty', [App\Http\Controllers\SavePartydataController::class, 
'getCreditOfCurrentParty_method']);
Route::post('getDebit', [App\Http\Controllers\SavePartydataController::class, 
'getDebit_method']);

Route::post('getCredit', [App\Http\Controllers\SavePartydataController::class, 
'getCredit_method']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
