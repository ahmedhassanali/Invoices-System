<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    
// Route::get('invoice/destroy/{id}',[InvoicesController::class,'destroy']);
Route::get('/', function () {return view('auth.login');});

// Route::post('/', function () {return view('auth.login');})->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('invoices/export', [InvoicesController::class, 'export'])->name('export_invoices');
Route::get('invoice/edit/{id}',[InvoicesController::class,'edit']);
Route::get('invoice/print/{id}',[InvoicesController::class,'print']);
Route::get('invoice/edit_status/{id}',[InvoicesController::class,'editStatus']);
Route::get('section/{id}',[InvoicesController::class,'addProductes']);
Route::get('invoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('View_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);
Route::get('dowenload_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'dowenload_file']);
Route::get('invoice_paid',[InvoicesController::class,'invoice_paid']);
Route::get('invoice_unpaid',[InvoicesController::class,'invoice_unpaid']);
Route::get('invoice_partial',[InvoicesController::class,'invoice_partial']);
Route::get('invoice_archive',[InvoicesController::class,'invoice_archive'])->name('invoice_archive');
Route::get('reports',[InvoicesController::class,'reports'])->name('reports');
Route::get('invoice_report',[InvoicesController::class,'invoice_report'])->name('invoice_report');

Route::post('invoice/destroy_archive/{id}',[InvoicesController::class,'destroy_archive'])->name('destroy_archive');
Route::post('invoices/search_invoices',[InvoicesController::class,'search_invoices'])->name('search_invoices');
Route::post('invoice/status_update/{id}',[InvoicesController::class,'statusUpdate'])->name('status_update');
Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::post('invoice_report',[InvoicesController::class,'invoice_report']);

Route::post('archive',[InvoicesController::class,'archive'])->name('archive');
Route::post('invoice_cancel_archive',[InvoicesController::class,'invoice_cancel_archive'])->name('invoice_cancel_archive');

Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::resource('invoices', InvoicesController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('products', ProductsController::class);
Route::resource('attachment', InvoiceAttachmentsController::class);

Route::get('/{page}',[AdminController::class,'index']);

});




