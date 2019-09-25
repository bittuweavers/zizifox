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



Auth::routes(['register'=>false]);

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::get('/admin/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/videos/list', 'Admin\VideosController@index')->name('admin.videos');
Route::get('/admin/videos/add', 'Admin\VideosController@add_video')->name('admin.videos.create');
Route::post('/admin/videos/store', 'Admin\VideosController@store')->name('admin.videos.store');
Route::delete('/admin/videos/destroy/{id}', 'Admin\VideosController@destroy')->name('admin.videos.destroy');
Route::get('/admin/videos/view/{id}', 'Admin\VideosController@view')->name('admin.videos.view');
Route::post('/admin/videos/changeStatus', 'Admin\VideosController@changeStatus')->name('admin.videos.changeStatus');
Route::get('/admin/search/list', 'Admin\SearchController@index')->name('admin.search');
Route::delete('/admin/search/destroy/{id}', 'Admin\SearchController@destroy')->name('admin.search.destroy');
Route::get('/admin/settings', 'Admin\AdminSettingsController@settingsOption',['middleware' => 'admin']);
Route::post('/admin/settings/update', 'Admin\AdminSettingsController@saveOrUpdateSettings',['middleware' => 'admin']);
Route::get('/admin/influencers/list', 'Admin\InfluencersController@index')->name('admin.influencers');
Route::get('/admin/influencers/add', 'Admin\InfluencersController@add_influencers' )->name('admin.influencers.add');
Route::post('/admin/influencers/store', 'Admin\InfluencersController@store')->name('admin.influencers.store');
Route::delete('/admin/influencers/destroy/{id}', 'Admin\InfluencersController@destroy')->name('admin.influencers.destroy');
Route::get('/admin/influencers/view/{id}', 'Admin\InfluencersController@show')->name('admin.influencers.show');
Route::get('/admin/influencers/edit/{id}', 'Admin\InfluencersController@edit')->name('admin.influencers.edit');
Route::put('/admin/influencers/update/{id}', 'Admin\InfluencersController@update')->name('admin.influencers.update');
Route::post('/admin/ajax-upload-photo', 'Admin\AjaxPhotoController@store');
Route::post('allvideos', 'Admin\VideosController@allvideos' )->name('allvideos');
Route::get('/show_chanel_video', 'Admin\VideosController@show_chanel_video' )->name('show_chanel_video');
Route::get('/admin/channel/find', 'Admin\InfluencersController@channel_find' )->name('admin.channel.find');


Route::get('/admin/languages/list', 'Admin\AdminLanguageController@index')->name('admin.languages');
Route::get('/admin/languages/add', 'Admin\AdminLanguageController@add_languages' )->name('admin.languages.add');
Route::post('/admin/languages/store', 'Admin\AdminLanguageController@store')->name('admin.languages.store');
Route::delete('/admin/languages/destroy/{id}', 'Admin\AdminLanguageController@destroy')->name('admin.languages.destroy');
Route::get('/admin/languages/edit/{id}', 'Admin\AdminLanguageController@edit')->name('admin.languages.edit');
Route::put('/admin/languages/update/{id}', 'Admin\AdminLanguageController@update')->name('admin.languages.update');



Route::get('/admin/pages/list', 'Admin\AdminPagesController@index')->name('admin.pages.index');
Route::delete('/admin/pages/destroy/{id}', 'Admin\AdminPagesController@destroy')->name('admin.pages.destroy');
Route::get('/admin/pages/edit/{id}', 'Admin\AdminPagesController@edit')->name('admin.pages.edit');
Route::put('/admin/pages/update/{id}', 'Admin\AdminPagesController@update')->name('admin.pages.update');

Route::get('/admin/banners/add', 'Admin\AdminBannersController@create')->name('admin.banners.create');
Route::post('/admin/banners/store', 'Admin\AdminBannersController@store')->name('admin.banners.store');
Route::get('/admin/banners/list', 'Admin\AdminBannersController@index')->name('admin.banners.index');
Route::delete('/admin/banners/destroy/{id}', 'Admin\AdminBannersController@destroy')->name('admin.banners.destroy');
Route::get('/admin/banners/edit/{id}', 'Admin\AdminBannersController@edit')->name('admin.banners.edit');
Route::put('/admin/banners/update/{id}', 'Admin\AdminBannersController@update')->name('admin.banners.update');

/**************** Forntend ************************/
/*Route::get('/', function()
{
    return 'Hello World';
});*/
//Route::get('/', 'Forntend\HomeController@index')->name('home');
Route::get('/', 'Forntend\HomeController@index')->name('home');
Route::get('/search', 'Forntend\HomeController@search')->name('home.search.video');
Route::get('/ajax-pagination', 'Forntend\HomeController@ajax_pagination')->name('home.ajax.video');
Route::get('/insertcaption', 'Forntend\HomeController@insert_caption')->name('home.insert.caption');
Route::get('/filesearch', 'Forntend\FileSearchController@file_search')->name('video.filesearch');


Route::get('/developer', 'Forntend\ForntendPageController@page_show')->name('page.developer');
Route::get('/about-us', 'Forntend\ForntendPageController@page_show')->name('page.about_us');
Route::get('/privacy-policy', 'Forntend\ForntendPageController@page_show')->name('page.privacy_policy');

Route::get('/{slug}', 'Forntend\ForntendInfluencersController@index')->name('influencers');
Route::get('/{slug}/search', 'Forntend\ForntendInfluencersController@search')->name('influencers.search.video');
Route::get('/{slug}/ajax-pagination', 'Forntend\ForntendInfluencersController@ajax_pagination')->name('influencers.ajax.video');



//Route::get('/insertcaption', 'Forntend\HomeController@insert_caption')->name('home.insert.caption');
