<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VarianController;
use App\Http\Controllers\LogstokController;
use App\Http\Controllers\MutasistokController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RiwayatBelanjaController;
use App\Http\Controllers\PenjualanController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
return view('landingpage.page.beranda');
});
Route::get('/tentang', function () {
    return view('landingpage.page.tentang');
});
Route::get('/cabang', function () {
    return view('landingpage.page.cabang');
});
Route::get('/contactus', [ContactUsController::class, 'contactUs'])->name('contact_us.contactUs');
Route::post('/contactus', [ContactUsController::class, 'store'])->name('contact_us.store');
Route::view('/faq', 'landingpage.page.faq');
Route::view('/shipping', 'landingpage.page.shipping');
Route::view('/privacy-policy', 'landingpage.page.privacy');
Route::view('/terms', 'landingpage.page.terms');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/admin/login', function () {
//     return view('admin.auth.login');
// })->name('admin.login');

Route::resource('admin/login', AdminLoginController::class)
    ->only(['index', 'store', 'destroy'])
    ->names('admin.login');
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])
    ->name('admin.logout');
Route::get('/semuaproduk', [FrontendController::class, 'index'])->name('semuaproduk');
Route::get('/semuaproduk', [FrontendController::class, 'semuaproduk'])->name('semuaproduk');
Route::get('/semuaproduk/search', [FrontendController::class, 'search'])->name('frontend.search');
Route::get('/produk/{id}', [FrontendController::class, 'detail'])
    ->name('produk.detail');
    Route::get('/auth/google', function () {
        return Socialite::driver('google')->redirect();
    });
    Route::get('/auth/google/callback', function () {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'     => $googleUser->getName(),
                    'phone'    => null,
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                    'role'     => 'pelanggan', // tambahkan ini
                ]
            );

            Auth::login($user);
            session([
                'name' => $user->name,
                'email' => $user->email,
            ]);
            return redirect('/');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    });
    Route::get('/cek', function () {
        dd(config('services.google'));
    });



// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard-pengguna', UserController::class);
    Route::get('/contact-us', [ContactusController::class, 'index'])->name('contactuses.index');
    Route::get('/contact-us/cetak/pdf', [ContactusController::class, 'cetakPDF'])->name('contactuses.cetak_pdf');
    Route::get('/contact-us/{id}/edit', [ContactusController::class, 'edit'])->name('contactuses.edit');
    Route::get('/contact-us/{id}', [ContactusController::class, 'show'])->name('contactuses.show');
    Route::put('/contact-us/{id}', [ContactusController::class, 'update'])->name('contactuses.update');
    Route::delete('/contact-us/{id}', [ContactusController::class, 'destroy'])->name('contactuses.destroy');
    Route::post('/stok/tambah/{id}',
        [VarianController::class, 'tambah']
    )->name('stok.tambah');
    Route::post('/stok/kurangi/{id}',
        [VarianController::class, 'kurangi']
    )->name('stok.kurangi');
    Route::delete('/produk-gambar/{id}',[ProdukController::class, 'hapusGambar'])->name('produk.gambar.delete');
    Route::resource('/dashboard-produk', ProdukController::class);
    Route::resource('/dashboard-varian', VarianController::class);
    Route::post('/stok/tambah/{varian}', [VarianController::class, 'tambah'])->name('stok.tambah');
    Route::post('/stok/kurangi/{varian}', [VarianController::class, 'kurangi'])->name('stok.kurangi');
    Route::get('/dashboard-log', [LogstokController::class, 'index'])->name('logstoks.index');
    Route::get('/dashboard-mutasi', [MutasistokController::class, 'index'])->name('mutasistoks.index');
    Route::get('/dashboard-mutasi/cetak', [MutasistokController::class, 'cetak'])->name('mutasistoks.cetak');
    Route::get('/dashboard-mutasi/{bulan}/{tahun}', [MutasistokController::class, 'show'])->name('mutasistoks.show');
    Route::get('/dashboard-pesanan', [CheckoutController::class, 'showPesanan'])->name('checkouts.pesanan');
    Route::get('/dashboard-pesanan/{id}', [CheckoutController::class, 'show'])->name('checkouts.show');
    Route::post('/dashboard-pesanan/{id}/confirm', [CheckoutController::class, 'confirm'])->name('checkouts.confirm');
    Route::put('/checkouts/{id}', [CheckoutController::class, 'updateStatus'])->name('checkouts.updateStatus');
    Route::put('/checkouts/{id}/update-pembayaran', [CheckoutController::class, 'updatePembayaran'])->name('checkouts.updatePembayaran');
    Route::resource('/dashboard-penjualan', PenjualanController::class);
    Route::get('/cetak-pdf/penjualan', [PenjualanController::class, 'cetakPdf'])->name('penjualan.cetak_pdf');
    Route::post('/input-resi/{id}', [CheckoutController::class, 'inputResi']);
    Route::get('/checkouts/{id}/detail-paket', [CheckoutController::class, 'detailPaket'])->name('checkouts.detailPaket');
    Route::post('/admin/checkout/batal/{id}', [CheckoutController::class, 'cancelAdmin']);
});

// PELANGGAN
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/detailpelanggan', function () {
        return view('landingpage.pelanggan.detailpelanggan');});
    Route::get('/editprofile', function () {
        return view('landingpage.pelanggan.editprofile');});
    Route::get('/edit-profile', [UserController::class, 'editUser'])->name('edit-profile');
    Route::put('/edit-profile', [UserController::class, 'updateUser'])->name('update-profile');
    Route::resource('keranjangs', KeranjangController::class);
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah']);
    Route::get('/keranjang', [KeranjangController::class, 'show'])->name('keranjang.show');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{id}/detail', [CheckoutController::class, 'detail'])->name('checkout.detail');
    Route::post('/riwayat-belanja/{id}/ulasan', [RiwayatBelanjaController::class, 'simpanUlasan'])->name('riwayatBelanja.simpanUlasan');
    Route::get('/riwayat-belanja', [RiwayatBelanjaController::class, 'index'])->name('riwayat-belanja');
    Route::post('/upload-bukti/{id}', [RiwayatBelanjaController::class, 'uploadBukti'])->name('upload.bukti');
    Route::post('/checkout/terima/{id}', [RiwayatBelanjaController::class, 'terimaPesanan']);
    Route::post('/checkout/batal/{id}', [RiwayatBelanjaController::class, 'batalkanPesanan']);
});