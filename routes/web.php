<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavecitydataController;
use App\Http\Controllers\SavePartydataController;
use App\Http\Controllers\SaveItemsdataController;
use App\Http\Controllers\SaveSalesBookdataController;
use App\Http\Controllers\SaveSalesBookDetaildataController;
use App\Http\Controllers\Cashbook;
use App\Http\Controllers\Stock;
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

Route::post('save_itemsdata', [App\Http\Controllers\SaveItemsdataController::class, 'save_itemsdata_method']);
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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
