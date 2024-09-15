<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CekPesananController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SupervisorController;

// Route::get('/', function () {
//     return view('welcome');
// });


//Landing Page
Route::get('/checkout', function () {
    return view('LandingPage.checkout');
});
Route::get('/orders', function () {
    return view('LandingPage.orders');
});
Route::get('/error', function () {
    return view('LandingPage.errorPage');
});

//Beranda
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/filter-km-home', [HomeController::class, 'filterHome'])->name('filter.km-home');
Route::post('/filter-transmisi-home', [HomeController::class, 'filterTransmisiHome'])->name('filter.transmisi-home');
Route::post('/filter-tahun-home', [HomeController::class, 'filterTahunHome'])->name('filter.tahun-home');
Route::get('/filter/{type}', [HomeController::class, 'filterType'])->name('filterType');
Route::get('/filterTahun/{type}', [HomeController::class, 'filterTypeTahun'])->name('filterTypeTahun');
Route::post('/filter-merk-home', [HomeController::class, 'filterMerkHome'])->name('filterMerk-home');
Route::get('/filterMerk/{type}', [HomeController::class, 'filterMerkType'])->name('filterMerk');

//tantang
Route::get('/tentang', [AboutController::class, 'index'])->name('tentang.index');
//Mobil
Route::get('/mobil', [CarController::class, 'index'])->name('mobil.index');
Route::get('/filter-km', [CarController::class, 'filter'])->name('filter.km');
Route::post('/filter-transmisi', [CarController::class, 'filterTransmisi'])->name('filter.transmisi');
Route::post('/filter-tahun', [CarController::class, 'filterTahun'])->name('filter.tahun');

//Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
//Cek Pesanan
Route::get('/cekPesanan', [CekPesananController::class, 'index'])->name('cekPesanan.index');
//Chat
Route::get('/chat/{id}', [ChatController::class, 'index'])->name('chat.index');
//Layout Master
Route::get('/master', [MasterController::class, 'index'])->name('master.index');

//auth
Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/postRegister', [AuthController::class, 'postRegister'])->name('auth.postRegister');
    Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('auth.postlogin');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/customer/edit-profile', [ProfileController::class, 'index'])->name('customer_profile');
    Route::post('/customer/edit-profile-submit', [ProfileController::class, 'profile_submit'])->name('customer_profile_submit');
});

//Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});

//Pengguna
Route::prefix('pengguna')->group(function () {
    Route::get('/', [PenggunaController::class, 'tablePengguna'])->name('pengguna.tablePengguna');
    Route::post('/store', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::post('/update', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});

Route::get('/ahay', [InvoiceController::class, 'showPayment'])->name('midtrans.show');


//Produk
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

    Route::get('/invoice/{checkout}', [InvoiceController::class, 'invoice'])->name('produk.invoice');
    Route::get('/invoice', [InvoiceController::class, 'invoiceCheckout'])->name('produk.invoiceCheckout');
    Route::post('/upload-invoice', [InvoiceController::class, 'create'])->name('produk.upload-invoice');

    Route::get('/payment', [InvoiceController::class, 'payment'])->name('produk.payment');
    Route::get('/checkout', [InvoiceController::class, 'checkout'])->name('produk.checkout');
});

Route::get('/keranjang', [PesananController::class, 'keranjang'])->name('keranjang');
Route::post('/cart', [PesananController::class, 'create'])->name('pemesananuser.create');
Route::post('/keranjang/update', [PesananController::class, 'update'])->name('keranjang.update');
Route::get('/keranjang/{checkout}', [PesananController::class, 'invoiceKeranjang'])->name('keranjang.invoiceKeranjang');


Route::prefix('keranjang')->group(function () {
    Route::delete('/{id}', [PesananController::class, 'destroy'])->name('keranjang.destroy');
});

Route::prefix('invoiceBack')->group(function () {
    Route::delete('/{id}', [InvoiceController::class, 'destroy'])->name('invoiceBack.destroy');
});

Route::post('/booking/submit', [BookingController::class, 'cart_submit'])->name('cart_submit');

Route::prefix('pesanan')->group(function () {
    Route::get('/', [MarketingController::class, 'pesanan'])->name('pesanan.pesanan');
    Route::get('/transaksi', [MarketingController::class, 'transaksi'])->name('pesanan.transaksi');
    Route::post('/store', [MarketingController::class, 'store'])->name('pesanan.store');
    Route::get('/edit/{id}', [MarketingController::class, 'edit'])->name('pesanan.edit');
    Route::post('/update', [MarketingController::class, 'update'])->name('pesanan.update');
    Route::delete('/{id}', [MarketingController::class, 'destroy'])->name('pesanan.destroy');
    Route::get('/print-invoice/{id}', [MarketingController::class, 'exportPDF'])->name('print-invoice');
    Route::post('/approval', [MarketingController::class, 'approval'])->name('pesanan.approval');
    Route::post('/approval-kredit', [MarketingController::class, 'approvalKredit'])->name('pesanan.approvalKredit');
    Route::get('download-surat/{id}', [MarketingController::class, 'downloadPDF'])->name('download-surat');
    Route::get('print-invoice-pdf/{id}', [MarketingController::class, 'exportPDF1'])->name('print-invoice-pdf');
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('penjualan.index');
    Route::post('/store', [OwnerController::class, 'store'])->name('penjualan.store');
    Route::get('/edit/{id}', [OwnerController::class, 'edit'])->name('penjualan.edit');
    Route::post('/update', [OwnerController::class, 'update'])->name('penjualan.update');
    Route::delete('/{id}', [OwnerController::class, 'destroy'])->name('penjualan.destroy');
    Route::post('/filter-penjualan', [OwnerController::class, 'filter'])->name('filter.penjualan');
    Route::get('/export-penjualan/{tanggal_mulai}/{status}', [OwnerController::class, 'exportlaporan'])->name('export.penjualan');

   
});

Route::prefix('kredit')->group(function () {
    Route::get('/', [KreditController::class, 'index'])->name('kredit.index');
    Route::post('/store', [KreditController::class, 'store'])->name('kredit.store');
    Route::get('/edit/{id}', [KreditController::class, 'edit'])->name('kredit.edit');
    Route::post('/update', [KreditController::class, 'update'])->name('kredit.update');
    Route::delete('/{id}', [KreditController::class, 'destroy'])->name('kredit.destroy');
    Route::post('/butitf/{id}', [KreditController::class, 'buktitf'])->name('kredit.buktitf');
});


Route::get('/invoice', function () {
    return view('Admin.Marketing.invoice');
});


Route::get('/alert', function () {
    return view('Admin.alert');
});

Route::get('/auth-login', function () {
    return view('auth-login');
});
Route::get('/auth-register', function () {
    return view('auth-register');
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
