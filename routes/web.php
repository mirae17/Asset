<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaraidController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware asset. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');

Auth::routes();


Route::get('/familyAsset/home', [App\Http\Controllers\FamilyHomeController::class, 'index'])->name('familyAsset.home');
Route::get('/userAsset/home', [App\Http\Controllers\UserHomeController::class, 'dashboard'])->name('userAsset.home');



Route::get('/userAsset', 'App\Http\Controllers\UserAssetController@index')->name('userAsset.index');
Route::get('/userAsset/create', 'App\Http\Controllers\UserAssetController@create')->name('userAsset.create');
Route::post('/userAsset', 'App\Http\Controllers\UserAssetController@store')->name('userAsset.store');
Route::get('/userAsset/{asset}', 'App\Http\Controllers\UserAssetController@show')->name('userAsset.show');
Route::get('/userAsset/{asset}/edit', 'App\Http\Controllers\UserAssetController@edit')->name('userAsset.edit');
Route::put('/userAsset/{asset}', 'App\Http\Controllers\UserAssetController@update')->name('userAsset.update');
Route::delete('/userAsset/{asset}', 'App\Http\Controllers\UserAssetController@destroy')->name('userAsset.destroy');

Route::get('/familyAsset', 'App\Http\Controllers\FamilyAssetController@index')->name('familyAsset.index');

Route::get('/adminView', 'App\Http\Controllers\AdmindetailsController@index')->name('adminView.index');
Route::get('/adminView/create', 'App\Http\Controllers\AdmindetailsController@create')->name('adminView.create');
Route::post('/adminView', 'App\Http\Controllers\AdmindetailsController@store')->name('adminView.store');
Route::get('/adminView/{admin}', 'App\Http\Controllers\AdmindetailsController@show')->name('adminView.show');
Route::get('/adminView/{admin}/edit', 'App\Http\Controllers\AdminDetailsController@edit')->name('adminView.edit');
Route::put('/adminView/{admin}', 'App\Http\Controllers\AdminDetailsController@update')->name('adminView.update');
Route::delete('/adminView/{admin}', 'App\Http\Controllers\AdminDetailsController@destroy')->name('adminView.destroy');

Route::post('/userFamily/request', 'App\Http\Controllers\UserFamilyController@request')->name('userFamily.request');
Route::get('/userFamily', 'App\Http\Controllers\UserFamilyController@index')->name('userFamily.index');
Route::get('/userFamily/table',  'App\Http\Controllers\UserFamilyController@table')->name('userFamily.table');
Route::get('/userFamily/create', 'App\Http\Controllers\UserFamilyController@create')->name('userFamily.create');
Route::post('/userFamily', 'App\Http\Controllers\UserFamilyController@store')->name('userFamily.store');
Route::get('/userFamily/{family}', 'App\Http\Controllers\UserFamilyController@show')->name('userFamily.show');
Route::get('/userFamily/{family}/edit', 'App\Http\Controllers\UserFamilyController@edit')->name('userFamily.edit');
Route::put('/userFamily/{family}', 'App\Http\Controllers\UserFamilyController@update')->name('userFamily.update');
Route::delete('/userFamily/{family}', 'App\Http\Controllers\UserFamilyController@destroy')->name('userFamily.destroy');

Route::get('/userProfile', 'App\Http\Controllers\UserProfileController@show')->name('userProfile.show');
Route::put('/userProfile', 'App\Http\Controllers\UserProfileController@update')->name('userProfile.update');

Route::get('/adminProfile', 'App\Http\Controllers\AdminProfileController@show')->name('adminProfile.show');
Route::put('/adminProfile', 'App\Http\Controllers\AdminProfileController@update')->name('adminProfile.update');

Route::get('/adminD', 'App\Http\Controllers\DashboardController@dashboard')->name('adminD.dashboard');
Route::get('/userD', 'App\Http\Controllers\UserDashboardController@dashboard')->name('userD.dashboard');

Route::get('/userApproval', 'App\Http\Controllers\UserApprovalController@index')->name('userApproval.index');
Route::patch('/userApproval/approve/{id}', 'App\Http\Controllers\UserApprovalController@approve')->name('userApproval.approve');
Route::patch('/userApproval/reject/{id}', 'App\Http\Controllers\UserApprovalController@reject')->name('userApproval.reject');
Route::patch('/userApproval/{id}/deactivate', 'App\Http\Controllers\UserApprovalController@deactivate')->name('userApproval.deactivate');

Route::get('/accountActive', 'App\Http\Controllers\AccountActiveController@index')->name('accountActive.index');
Route::get('/accountDeactived', 'App\Http\Controllers\AccountDeactivedController@index')->name('accountDeactived.index');

Route::get('/report', 'App\Http\Controllers\ReportController@generateReport')->name('report.assetReport');
Route::get('/report/download','App\Http\Controllers\ReportController@downloadPDF')->name('report.downloadPDF');


Route::middleware(['auth'])->group(function () {
    Route::get('/faraid/divide', 'App\Http\Controllers\FaraidController@divide')->name('faraid.index');
    
});


