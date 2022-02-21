<?php

use Illuminate\Support\Facades\Route;

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
    return view('sysmex');
});

//HEMATOLOGI ROUTING PAGES
Route::get('hematologi','HematologiController@index');
Route::get('hematologi/instrument','HematologiController@instrument');
Route::get('hematologi/profile','HematologiController@myprofile');
Route::get('hematologi/input/qc/{instrument_id}','HematologiController@inputqc');
Route::get('hematologi/input/equas/{instrument_id}','HematologiController@inputequas');
Route::get('hematologi/report/{periode}/{instrument_id}','HematologiController@report');

//COAGULATION ROUTING PAGES
Route::post('equas/koagulasi/login','KoagulasiController@login')->name('koagulasi.login');
Route::get('equas/koagulasi/logout','KoagulasiController@logout')->name('koagulasi.logout');
Route::get('equas/koagulasi/','KoagulasiController@index')->name('koagulasi.index');
Route::get('equas/koagulasi/home','KoagulasiController@home')->name('koagulasi.home');
Route::get('equas/koagulasi/instrument','KoagulasiController@instrument')->name('koagulasi.instrument');
Route::get('equas/koagulasi/profile','KoagulasiController@myprofile')->name('koagulasi.profile');
Route::post('equas/koagulasi/profilesave','KoagulasiController@profile_store')->name('koagulasi.profilesave');
Route::get('equas/koagulasi/sampleinfo/{instrument_type}/{instrument_id}','KoagulasiController@sampleinfo')->name('koagulasi.sampleinfo');
Route::post('equas/koagulasi/sampleinfo/save','KoagulasiController@sampleinfo_store')->name('koagulasi.sampleinfosave');
Route::get('equas/koagulasi/{test}/qc/{instrument_type}/{instrument_id}','KoagulasiController@qc')->name('koagulasi.qc');
Route::post('equas/koagulasi/qc/save','KoagulasiController@qc_store')->name('koagulasi.qcsave');
Route::get('equas/koagulasi/{test}/input/{instrument_type}/{instrument_id}','KoagulasiController@input')->name('koagulasi.input');
Route::post('equas/koagulasi/input/save','KoagulasiController@input_store')->name('koagulasi.inputsave');
Route::get('equas/koagulasi/success','KoagulasiController@success')->name('koagulasi.success');
Route::get('equas/koagulasi/report/{periode}/{instrument_type}/{instrument_id}','KoagulasiController@report')->name('koagulasi.report');
Route::get('equas/koagulasi/view/{instrument_type}/{instrument_id}','KoagulasiController@view')->name('koagulasi.view');

//URIN ROUTING PAGES
Route::post('equas/urin/login','UrinController@login')->name('urin.login');
Route::get('equas/urin/logout','UrinController@logout')->name('urin.logout');
Route::get('equas/urin','UrinController@index')->name('urin.index');
Route::get('equas/urin/home','UrinController@home')->name('urin.home');
Route::get('equas/urin/profile','UrinController@myprofile')->name('urin.profile');
Route::post('equas/urin/profilesave','UrinController@profile_store')->name('urin.profilesave');
Route::get('equas/urin/instrument','UrinController@instrument')->name('urin.instrument');
Route::get('equas/urin/sampleinfo/{instrument_type}/{instrument_id}','UrinController@sampleinfo')->name('urin.sampleinfo');
Route::post('equas/urin/sampleinfo/save','UrinController@sampleinfo_store')->name('urin.sampleinfosave');
Route::get('equas/urin/qc/{instrument_type}/{instrument_id}','UrinController@qc')->name('urin.qc');
Route::post('equas/urin/qc/save','UrinController@qc_store')->name('urin.qcsave');
Route::get('equas/urin/input/{instrument_type}/{instrument_id}/{page}','UrinController@input')->name('urin.input');
Route::post('equas/urin/input/save','UrinController@input_store')->name('urin.inputsave');
Route::get('equas/urin/success','UrinController@success')->name('urin.success');
Route::get('equas/urin/report/{periode}/{instrument_id}','UrinController@report');

//ADMIN ROUTING PAGES
Route::post('equas/admin/login','AdminController@login')->name('admin.login');
Route::get('equas/admin/logout','AdminController@logout')->name('admin.logout');
Route::get('equas/admin','AdminController@index')->name('admin.index');
Route::get('equas/admin/home','AdminController@home')->name('admin.home');
Route::get('equas/admin/koagulasi','AdminController@dashboard')->name('admin.koagulasi');
Route::get('equas/admin/urin','AdminController@dashboard')->name('admin.urin');
Route::get('equas/admin/koagulasi/pending','AdminController@pending')->name('admin.koag_pending');
Route::get('equas/admin/urin/pending','AdminController@pending')->name('admin.urin_pending');
Route::get('equas/admin/manage','AdminController@manage')->name('admin.manage');

Route::get('equas/admin/manage/periode','AdminController@manage_periode')->name('admin.periode');
Route::get('equas/admin/manage/periode/create','AdminController@manage_periode')->name('admin.periode_create');
Route::get('equas/admin/manage/periode/close/{step}','AdminController@manage_periode')->name('admin.periode_close');
Route::get('equas/admin/manage/periode/groupresult','AdminController@manage_groupresult')->name('admin.groupresult');
Route::post('equas/admin/manage/periode/groupresult/update','AdminController@update_groupresult')->name('admin.update_groupresult');



Route::get('/home', 'HomeController@index')->name('home');
