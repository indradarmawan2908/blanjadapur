<?php

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

Route::middleware('checkToko')->group(function () {
    Route::get('/','IndexController@index')->name('index');
    Route::get('cari','IndexController@cari')->name('index.cari');
	Route::get('produk/{id}/{slug}', 'ProdukController@show')->name('produk.show');
	Route::resource('ktg', 'KtgController');
	Route::resource('produk', 'ProdukController',['except' => [
	    'show'
	]]);
	Route::get('promo', 'KategoriController@promo')->name('kategori.promo');
	Route::get('diskon', 'KategoriController@diskon')->name('kategori.diskon');
	Route::get('terlaris', 'KategoriController@terlaris')->name('kategori.terlaris');
	Route::get('terbaru', 'KategoriController@terbaru')->name('kategori.terbaru');
	Route::get('kategori/{id}/{slug}', 'KategoriController@show')->name('kategori.show');
	Route::middleware('auth')->group(function(){
		Route::resource('order', 'OrderController');
		Route::post('keranjang/ubah/{id}', 'KeranjangController@ubah')->name('keranjang.ubah');
		Route::get('keranjang/antar', 'KeranjangController@antar')->name('keranjang.antar');
		Route::post('keranjang/kirim', 'KeranjangController@kirim')->name('keranjang.kirim');
		Route::post('keranjang/bayar', 'KeranjangController@bayar')->name('keranjang.bayar');
		Route::resource('keranjang', 'KeranjangController',['except' => [
		    'show'
		]]);
		Route::resource('newsToko', 'NewsController');
		Route::resource('member', 'MemberController',['except' => [
		    'show'
		]]);
		Route::get('member/profil', 'MemberController@profil')->name('member.profil');
		Route::get('member/toko', 'MemberController@toko')->name('member.toko');
		Route::post('member/profilUpdate', 'MemberController@profilUpdate')->name('member.profilUpdate');
		Route::post('member/password', 'MemberController@password')->name('member.password');
		Route::resource('tongkir', 'ROController');
	});

	Auth::routes();
});

// Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
Route::prefix('admin')->namespace('Admin')->group(function (){
	Route::get('login', 'AuthController@index')->name('admin.index');
	Route::post('login', 'AuthController@auth')->name('admin.index');
	Route::post('logout', 'AuthController@logout')->name('admin.logout');
	Route::middleware('admin')->group(function(){
		Route::get('/','IndexController@index');
		Route::resource('beranda','IndexController');
		Route::resource('orderToko','OrderController');
		Route::get('toko/login/{id}', 'AuthController@toko')->name('toko.login');
		Route::get('toko/perpanjang','TokoController@perpanjang')->name('toko.perpanjang');
		Route::put('toko/perpanjang/aktifkan/{id}','TokoController@aktifkan')->name('toko.aktifkan');
		Route::put('toko/perpanjang/batalkan/{id}','TokoController@batalkan')->name('toko.batalkan');
	    Route::resource('toko','TokoController');
	    Route::get('newsAdmin/tampil/{id}/{tampil}','NewsController@tampil')->name('newsAdmin.tampil');
	    Route::resource('newsAdmin','NewsController');
	    Route::resource('banks','BankController');
	    Route::resource('satuan','SatuanController');
	});
});

Route::prefix('tokoku')->namespace('AdminToko')->group(function (){
	Route::get('login', 'AuthController@index')->name('tokoku.index');
	Route::post('login', 'AuthController@auth')->name('tokoku.index');
	Route::get('reset-confirm', 'AuthController@reset2')->name('tokoku.reset2');
	Route::get('reset', 'AuthController@reset')->name('tokoku.reset');
	Route::post('reset', 'AuthController@resetact')->name('tokoku.reset');
	Route::post('lupa-password', 'AuthController@lupas')->name('tokoku.lupas');
	Route::post('logout', 'AuthController@logout')->name('tokoku.logout');

	Route::middleware('toko')->group(function(){
		Route::get('/','IndexController@index');
		Route::resource('dashboard','IndexController');
	    Route::resource('slide','SlideController');
	    Route::resource('cari','CariController');
	    Route::resource('kategori','KategoriController');
	    Route::resource('produk','ProdukController',['except' => [
		    'show'
		]]);
		Route::get('produk/gambar/{id}', 'ProdukController@gambar')->name('produk.gambar');
		Route::post('produk/gambarTambah/{id}', 'ProdukController@gambarTambah')->name('produk.storeGambar');
		Route::delete('produk/gambarHapus/{id}', 'ProdukController@gambarHapus')->name('produk.destroyGambar');
		
		Route::get('produk/stok/{id}', 'ProdukController@stok')->name('produk.stok');
		Route::post('produk/stokTambah/{id}', 'ProdukController@stokTambah')->name('produk.storeStok');
	    Route::resource('profil','ProfilController');
	    Route::resource('orderan','OrderanController');
	    Route::get('orderan/kembali/{id}', 'OrderanController@kembali')->name('orderan.kembali');
		Route::post('orderan/kembali/{id}', 'OrderanController@postKembali')->name('orderan.kembali');
	    Route::get('orderan/cetak/{id}','OrderanController@cetak')->name('orderan.cetak');
	    Route::get('orderan/cetak_besar/{id}','OrderanController@cetakbesar')->name('orderan.cetakbesar');
	    Route::resource('memberku','MemberkuController');
	    Route::get('orderan/status/{status}', 'OrderanController@status')->name('orderan.status');
	    Route::resource('laporan', 'LaporanController',['except' => [
		    'show'
		]]);
	    Route::get('laporan/perhari', 'LaporanController@perhari')->name('laporan.perhari');
	    Route::get('laporan/perbulan', 'LaporanController@perbulan')->name('laporan.perbulan');
	    Route::get('laporan/pertahun', 'LaporanController@pertahun')->name('laporan.pertahun');
	    Route::get('laporan/member', 'LaporanController@member')->name('laporan.member');
	    Route::get('news/tampil/{id}/{tampil}','NewsController@tampil')->name('news.tampil');
	    Route::resource('news','NewsController');
	    Route::resource('bank','BankController');
	    Route::resource('broadcast','BroadcastController');
	    Route::resource('rajaongkir', 'ROController');
	    Route::resource('rajaongkir', 'ROController');
	});
});

Route::get('/config-clear', function() { $status = Artisan::call('config:clear'); return '<h1>Configurations cleared</h1>'; });
Route::get('/cache-clear', function() { $status = Artisan::call('cache:clear'); return '<h1>Configurations cleared</h1>'; });
Route::get('/config-cache', function() { $status = Artisan::call('config:cache'); return '<h1>Configurations cleared</h1>'; });
Route::get('/db-migrate', function() { $status = Artisan::call('migrate'); return 'Migrate completed'; });
Route::get('/db-migrate-rollback', function() { $status = Artisan::call('migrate:rollback'); return 'Migrate rollback completed'; });
Route::get('/vendor/publish', function() { $status = Artisan::call('vendor:publish --tag=laravel-pagination'); return 'Migrate rollback completed'; });
