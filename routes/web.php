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

Route::group(['midlleware' => 'web'], function() {

    // Auth
    Auth::routes();
    // Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('/login', 'Auth\LoginController@login');
    // Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    // Index
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');
    // Route::get('/dashboard', 'HomeController@getDataDashboard')->name('dashboard.data');

    Route::get('pesanan/buatpesanan', 'PesananController@view')->name('pesanan.buat');
    Route::get('pesanan/viewindex', 'PesananController@viewindex')->name('pesanan.viewindex');
    Route::post('pesanan/getdatapesanan', 'PesananController@getDataPesanan')->name('pesanan.datapesanan');
    Route::post('pesanan/daftar', 'PesananController@index') -> name('pesanan.daftar');
    Route::post('pesanan/delete', 'PesananController@deletePesanan') -> name('pesanan.deletepesanan');
    Route::resource('pesanan', 'PesananController');

    Route::get('lampiranorder/getUpdate', 'LampiranOrderController@getUpdate')->name('lampiranorder.getUpdate');
    Route::get('lampiranorder/delUpdate', 'LampiranOrderController@delUpdate')->name('lampiranorder.delUpdate');
    Route::resource('lampiranorder', 'LampiranOrderController');
    // Route::post('lampiranorder/store', 'LampiranOrderController@store')->name('lampiranorder.store');
    Route::get('lampiranorder/create', 'LampiranOrderController@view')->name('lampiranorder.create');
    Route::post('lampiranorder/update', 'LampiranOrderController@update')->name('lampiranorder.update');
    Route::post('lampiranorder/saverow', 'LampiranOrderController@saveNewRow')->name('lampiranorder.saverow');
    Route::post('lampiranorder/deleterow', 'LampiranOrderController@saveDeleteRow')->name('lampiranorder.deleterow');
    Route::get('lampiranorder/view/{idpesanan}/{no_lampiran}/{pecahan}/{ta}', 'LampiranOrderController@view')->name('lampiranorder.view');
    
    
    Route::get('lampirankerja/viewindex', 'PerintahKerjaController@viewindex')->name('lampirankerja.viewindex');
    Route::post('lampirankerja/daftar', 'PerintahKerjaController@index') -> name('lampirankerja.daftar'); 
    Route::get('lampirankerja/lapor', 'PerintahKerjaController@laporlpk')->name('lampirankerja.laporlpk'); 
    Route::get('lampirankerja/cetak/{id}/{idpesanan}/{no_lampiran}/{nomor_order}/{pecahan}/{ta}', 'PerintahKerjaController@cetakupdate_pdf')->name('lampirankerja.cetak'); 
    Route::get('lampirankerja/cetakonly/{id}/{idpesanan}/{no_lampiran}/{nomor_order}/{pecahan}/{ta}', 'PerintahKerjaController@cetak_pdf')->name('lampirankerja.cetakonly'); 
    Route::post('lampirankerja/store', 'PerintahKerjaController@store')->name('lampirankerja.store');
    Route::post('lampirankerja/daftarlpk', 'PerintahKerjaController@indexLapor')->name('lampirankerja.daftarall');
    Route::post('lampirankerja/selesai', 'PerintahKerjaController@updateSelesai')->name('lampirankerja.selesai');
    
    Route::resource('lampirankerja', 'PerintahKerjaController'); 
    
    Route::get('revisi/viewindex', 'RevisiController@viewindex')->name('revisi.viewindex');
    Route::post('revisi/daftar', 'RevisiController@index') -> name('revisi.daftar'); 


    Route::get('mdpecahan/listview', 'MDPecahanController@view')->name('pecahan.buat'); 
    Route::post('mdpecahan/daftar', 'MDPecahanController@index') -> name('pecahan.daftar');
    Route::post('mdpecahan/buat', 'MDPecahanController@create') -> name('pecahan.save');
    Route::post('mdpecahan/update_data', 'MDPecahanController@update') -> name('pecahan.updatedata');
    Route::post('pesanan/delete', 'MDPecahanController@deletePesanan') -> name('pecahan.deletepesanan');
    Route::resource('mdpecahan', 'MDPecahanController');

    Route::get('mduser/listview', 'MDUserController@view')->name('mduser.view'); 
    Route::post('mduser/daftar', 'MDUserController@index') -> name('mduser.daftar');
    Route::post('mduser/buat', 'MDUserController@store') -> name('mduser.save');
    Route::post('mduser/update_data', 'MDUserController@update') -> name('mduser.updatedata');
    Route::get('mduser/destroy/{id}', 'MDUserController@destroy');
    // Route::post('mduser/delete', 'MDUserController@delete') -> name('mduser.deletepesanan');
    Route::resource('mduser', 'MDUserController');


    // Profile
    Route::get('settings/profile', 'SettingsController@profile');

    // Edit Profile
    Route::get('settings/profile/edit', 'SettingsController@editProfile');

    // Update Profile
    Route::post('settings/profile', 'SettingsController@updateProfile');

    // Ubah password
    Route::get('settings/password', 'SettingsController@editPassword');
    Route::post('settings/password', 'SettingsController@updatePassword');

    //
    // Aktiviasi & Verifikasi Email
    //


    // Kirim Ulang email Verifikasi
    Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');

    // Admin
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {

    //     Route::resource('authors', 'AuthorsController');
        

    //     Route::resource('members', 'MembersController', [
    //         'only' => ['index', 'show', 'destroy']
    //     ]);

    //     //MD kantor
    //     Route::resource('mdkantor', 'MDKantorController');
    //     Route::post('mdkantor/update', 'MDKantorController@update')->name('mdkantor.update');
    //     Route::get('mdkantor/destroy/{id}', 'MDKantorController@destroy');

    //     Route::post('import/kantor', [
    //         'as' => 'import.kantor',
    //         'uses' => 'MDKantorController@importExcel'

    //     ]);
    //     Route::resource('user', 'MDUserController');
    //     Route::post('user/update', 'MDUserController@update')->name('user.update');
    //     Route::get('user/destroy/{id}', 'MDUserController@destroy');
    //    //MD petugas 
    //    Route::resource('mdpetugas', 'MDPetugasController');
    //    Route::post('mdpetugas/update', 'MDPetugasController@update')->name('mdpetugas.update');
    //    Route::get('mdpetugas/destroy/{id}', 'MDPetugasController@destroy');

    //    Route::get('template/petugas', [
    //     'as' => 'template.petugas',
    //     'uses' => 'MDPetugasController@generateExcelTemplate'
    // ]);
    // Route::post('import/petugas', [
    //     'as' => 'import.petugas',
    //     'uses' => 'MDPetugasController@importExcel'
    // ]);
    

    // Route::resource('mdjenispita', 'MDJenisPitaController');
    // Route::post('mdjenispita/update', 'MDJenisPitaController@update')->name('mdjenispita.update');
    // Route::get('mdjenispita/destroy/{id}', 'MDJenisPitaController@destroy');

    // Route::resource('mdtipepita', 'MDTipePikaiController');
    // Route::post('mdtipepita/update', 'MDTipePikaiController@update')->name('mdjenisbkc.update');
    // Route::get('mdtipepita/destroy/{id}', 'MDTipePikaiController@destroy');

    // Route::resource('mdseripikai', 'MDSeriPikaiController');
    // Route::post('mdseripikai/update', 'MDSeriPikaiController@update')->name('mdseripikai.update');
    // Route::get('mdseripikai/destroy/{id}', 'MDSeriPikaiController@destroy');
     
        
    

    //    Route::resource('mdstatus', 'MDPetugasController');
    //    Route::post('mdpetugas/update', 'MDPetugasController@update')->name('mdpetugas.update');
    //    Route::get('mdpetugas/destroy/{id}', 'MDPetugasController@destroy');
      

 

         
    });
}); 
