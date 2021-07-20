<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
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
/*user profile*/
Route::middleware(['auth'])->group(function(){
    Route::get('/welcome', [UserController::class,'index'])->name('welcome');
    Route::get('/setting', [UserController::class,'setting'])->name('user.setting');
    Route::get('/Wishlist', [UserController::class,'wishlist'])->name('user.wishlist');
    Route::get('/Reviews', [UserController::class,'reviews'])->name('user.reviews');
    Route::get('/Credits', [UserController::class,'credits'])->name('user.credits');
    Route::post('/Upload/avatar', [UserController::class,'upload_avatar'])->name('upload.avatar');
    Route::get('/user/account/edit', [UserController::class,'edit_accout'])->name('user.account.edit');
    Route::post('/user/profile/save', [UserController::class,'save_profile'])->name('user.profile.save');
    Route::post('/user/change/password', [UserController::class,'chanage_password'])->name('user.chanage.password');
    Route::post('/user/add/cart', [UserController::class,'add_cart'])->name('user.add.cart');
    Route::post('/user/book/prepare', [UserController::class,'book_prepare'])->name('user.book.prepare');
    Route::get('/user/view/cart', [UserController::class,'view_cart'])->name('user.view.cart');
    Route::get('/user/view/payment', [UserController::class,'view_payment'])->name('user.view.payment');
    Route::get('/user/paypal/success', [UserController::class,'paypal_success'])->name('paypal.success');
    Route::get('/user/pay/credits/success', [UserController::class,'pay_credits_success'])->name('pay.credits.success');
});

/*product */
Route::get('/',[ProductController::class,'welcome'])->name('home');
Route::get('product/show/detail/{product_id?}',[ProductController::class,'show_detail'])->name('product.show.detail');
Route::get('product/get/ticket/detail/{id?}',[ProductController::class,'get_ticket_detail'])->name('get.ticket.detail');
Route::get('product/get/available-package/{product_id?}',[ProductController::class,'get_available_package'])->name('get.available.package');
Route::get('product/get/available-dates/{product_id?}',[ProductController::class,'get_dates'])->name('get.available.dates');
/* social login */
Route::get('auth/{provider}', 'Auth\LoginController@redirectToSocial')->name('auth.provider');
Route::get('auth/{provider}', [LoginController::class,'redirectToSocial'])->name('auth.provider');
Route::get('auth/{provider}/callback', [LoginController::class,'handleSocialCallback']);

/*admin panel*/
Route::middleware(['admin'])->group(function(){
    Route::get('admin',[AdminController::class,'index'])->name('admin');
    Route::get('admin/get/user/profile',[AdminController::class,'get_user'])->name('admin.get.user');
    Route::get('admin/get/user/username',[AdminController::class,'get_username'])->name('get.username');
    Route::get('admin/get/products',[AdminController::class,'get_products'])->name('admin.get.products');
    Route::get('admin/get/am/report',[AdminController::class,'get_report'])->name('admin.get.am.report');
    Route::get('admin/get/credits/history',[AdminController::class,'get_credits_history'])->name('admin.get.credits.history');
    Route::get('admin/get/user/credits/history',[AdminController::class,'get_user_credits_history'])->name('admin.get.user.credits.detail');
    Route::get('admin/get/abp/history',[AdminController::class,'get_abp_history'])->name('admin.get.abp.history');
    Route::post('admin/save/user/profile/',[AdminController::class,'store_user_profile'])->name('admin.user.profile.save');
    Route::post('admin/save/user/credits/',[AdminController::class,'store_user_credits'])->name('admin.user.credits.save');
    Route::get('admin/change/user/credits/',[AdminController::class,'change_user_credits'])->name('admin.user.credits.change');
    Route::get('admin/change/user/abp/',[AdminController::class,'change_user_abp'])->name('admin.user.abp.change');
    Route::post('admin/add/user/credits/',[AdminController::class,'add_user_credits'])->name('admin.user.add.credits');
    Route::post('admin/substract/user/credits/',[AdminController::class,'substract_user_credits'])->name('admin.user.substract.credits');
    Route::post('admin/transfer/user/credits/',[AdminController::class,'transfer_user_credits'])->name('admin.user.transfer.credits');
    Route::get('admin/change/user/abp/',[AdminController::class,'change_user_abp'])->name('admin.user.abp.change');
    Route::post('admin/add/user/abp/',[AdminController::class,'add_user_abp'])->name('admin.user.add.abp');
    Route::post('admin/substract/user/abp/',[AdminController::class,'substract_user_abp'])->name('admin.user.substract.abp');
    Route::post('admin/transfer/user/abp/',[AdminController::class,'transfer_user_abp'])->name('admin.user.transfer.abp');
    Route::post('admin/save/user/aiva/',[AdminController::class,'store_user_aiva'])->name('admin.user.aiva.save');
    Route::post('admin/save/user/management/',[AdminController::class,'store_user_management'])->name('admin.user.management.save');
    Route::get('admin/edit/user/management/{user_id?}',[AdminController::class,'edit_user_management'])->name('admin.edit.user.management');
    Route::post('admin/delete/user/profile/',[AdminController::class,'delete_user'])->name('admin.user.delete');
    Route::post('admin/change/user/username/',[AdminController::class,'change_username'])->name('admin.change.username');
    Route::post('admin/change/user/email/',[AdminController::class,'change_email'])->name('admin.change.email');
    Route::post('admin/change/user/password/',[AdminController::class,'change_password'])->name('admin.change.password');
    Route::post('admin/change/user/am_status/',[AdminController::class,'change_am_status'])->name('admin.change.am_status');
    Route::post('admin/change/user/status/',[AdminController::class,'change_status'])->name('admin.change.status');
    Route::get('get/city',[AdminController::class,'get_city'])->name('get.city');
    Route::get('get/country',[AdminController::class,'get_country'])->name('get.country');
    Route::get('get/subcategory',[AdminController::class,'get_subcategory'])->name('get.subcategory');
    Route::get('detail/admin',[AdminController::class,'admin_detail'])->name('admin.detail');
    Route::get('admin/add/product',[AdminController::class,'add_product'])->name('admin.add.product');
    Route::post('admin/store/product',[AdminController::class,'store_product'])->name('admin.store.product');
    Route::post('admin/add/product/upload/gallery',[AdminController::class,'upload_gallery'])->name('admin.product.image.upload');
    Route::post('admin/upload/gallery/{kind?}',[AdminController::class,'upload_gallery_setting'])->name('admin.upload.gallery');
    Route::get('admin/setup/package/{product_id?}',[AdminController::class,'setup_package'])->name('admin.setup.package');
    Route::post('admin/store/package/{product_id?}',[AdminController::class,'store_package'])->name('admin.store.package');
    Route::get('admin/add/ticket/{package_id?}',[AdminController::class,'add_package'])->name('admin.add.ticket');
    Route::post('admin/change/ticket/{ticket_id?}',[AdminController::class,'change_ticket'])->name('admin.change.tickets');
    Route::post('admin/store/ticket/{package_id?}',[AdminController::class,'store_ticket'])->name('admin.store.tickets');
    Route::post('admin/product/delete/{product_id?}',[AdminController::class,'delete_product'])->name('admin.product.delete');
    Route::get('admin/product/edit/{product_id?}',[AdminController::class,'edit_product'])->name('admin.product.edit');
    Route::get('admin/package/delete/{package_id?}',[AdminController::class,'delete_package'])->name('admin.package.delete');
    Route::get('admin/package/edit/{package_id?}',[AdminController::class,'edit_package'])->name('admin.package.edit');
    Route::get('admin/ticket/edit/{ticket_id?}',[AdminController::class,'edit_ticket'])->name('admin.ticket.edit');
    Route::get('admin/ticket/delete/{ticket_id?}',[AdminController::class,'delete_ticket'])->name('admin.ticket.delete');
    Route::get('admin/category/add',[AdminController::class,'add_category'])->name('admin.create.category');
    Route::get('admin/subcategory/add',[AdminController::class,'add_subcategory'])->name('admin.add.subcategory');
    Route::post('admin/category/store',[AdminController::class,'store_category'])->name('admin.store.category');
    Route::post('admin/subcategory/store',[AdminController::class,'store_subcategory'])->name('admin.store.subcategory');
    Route::get('admin/maincategory/delete/{category_id?}',[AdminController::class,'delete_maincategory'])->name('admin.maincategory.delete');
    Route::get('admin/maincategory/edit/{category_id?}',[AdminController::class,'edit_maincategory'])->name('admin.maincategory.edit');
    Route::get('admin/subcategory/edit/{category_id?}',[AdminController::class,'edit_subcategory'])->name('admin.subcategory.edit');
    Route::get('admin/subcategory/delete/{category_id?}',[AdminController::class,'delete_subcategory'])->name('admin.subcategory.delete');
    Route::get('admin/setup/welcomepage',[AdminController::class,'setup_welcome'])->name('admin.setup.welcome');
    Route::post('admin/save/welcomepage',[AdminController::class,'save_welcome'])->name('admin.store.welcome');
    Route::get('admin/edit/welcomepage',[AdminController::class,'edit_welcome'])->name('admin.edit.welcome');
    Route::get('admin/edit/region/{region_id?}',[AdminController::class,'edit_region'])->name('admin.region.edit');
    Route::get('admin/add/region/',[AdminController::class,'add_region'])->name('admin.region.add');
    Route::get('admin/delete/region/{region_id?}',[AdminController::class,'delete_region'])->name('admin.region.delete');
    Route::post('admin/save/region',[AdminController::class,'save_region'])->name('admin.region.save');
    Route::get('admin/edit/m_dest/{m_dest_id?}',[AdminController::class,'edit_m_dest'])->name('admin.m_dest.edit');
    Route::get('admin/add/m_dest/',[AdminController::class,'add_m_dest'])->name('admin.m_dest.add');
    Route::get('admin/delete/m_dest/{m_dest_id?}',[AdminController::class,'delete_m_dest'])->name('admin.m_dest.delete');
    Route::post('admin/save/m_dest',[AdminController::class,'save_m_dest'])->name('admin.m_dest.save');
    Route::get('admin/edit/s_dest/{s_dest_id?}',[AdminController::class,'edit_s_dest'])->name('admin.s_dest.edit');
    Route::get('admin/add/s_dest/',[AdminController::class,'add_s_dest'])->name('admin.s_dest.add');
    Route::get('admin/delete/s_dest/{s_dest_id?}',[AdminController::class,'delete_s_dest'])->name('admin.s_dest.delete');
    Route::post('admin/save/s_dest',[AdminController::class,'save_s_dest'])->name('admin.s_dest.save');

});

