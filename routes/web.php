<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoicesdetailController;
use App\Http\Controllers\InvoicesattachmentController;
use App\Http\Controllers\InvoiceArchiveController;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;




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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('invoices',InvoiceController::class);

Route::resource('sections',SectionController::class);

Route::resource('products',ProductController::class);

//Route::resource('products',InvoicesdetailController::class);

Route::get('/section/{id}',[InvoiceController::class,'getproducts']);

Route::get('/InvoicesDetails/{id}',[InvoicesdetailController::class,'edit']);

Route::get('download/{invoice_number}/{file_name}',[InvoicesdetailController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}',[InvoicesdetailController::class,'open_file']);

Route::post('delete_file',[InvoicesdetailController::class,'destroy'])->name('delete_file');

Route::resource('InvoiceAttachments',InvoicesattachmentController::class);

Route::get('/Invoice_Paid',[InvoiceController::class,'Invoice_Paid']);

Route::get('/Invoice_UnPaid',[InvoiceController::class,'Invoice_UnPaid']);

Route::get('/Invoice_Partial',[InvoiceController::class,'Invoice_Partial']);


Route::get('/edit_invoice/{id}',[InvoiceController::class,'edit']);

Route::get('/Status_show/{id}',[InvoiceController::class,'show'])->name('Status_show');

Route::post('/Status_Update/{id}',[InvoiceController::class,'Status_Update'])->name('Status_Update');

Route::resource('Archive',InvoiceArchiveController::class);

Route::get('/Print_invoice/{id}',[InvoiceController::class,'Print_invoice']);

//Route::get();
// Route::get('/emaill',function(){

//     Mail::to('roqa57533@gmail.com')->send(new InvoiceMail());

//     return response('sending');

// });

Route::get('export_invoices',[InvoiceController::class,'export']);


//Route::group(['middleware' => ['auth']], function() {
    Route::middleware(['auth'])->group(function () {

    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    });


Route::get('/{page}',[AdminController::class,'index']);