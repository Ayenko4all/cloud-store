<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/admin')->namespace('Admin')->group(function () {

    Route::match(['get','post'],'/', 'AdminController@login')->name('admin.login');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::get('settings', 'AdminController@settings')->name('admin.settings');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::post('check-current-pwd', 'AdminController@chkCurrentPassword')->name('admin.check.current.pwd');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword')->name('admin.update.current.pwd');
        Route::match(['get','post'],'profile', 'AdminController@updateProfile')->name('admin.profile');

        /*SECTIONS ROUTES*/
        Route::get('sections', 'SectionController@index')->name('sections.index');
        Route::patch('update-section-status', 'SectionController@status')->name('update.section.status');

        /*BRAND ROUTE*/
        Route::get('brands', 'BrandsController@index')->name('admin.brands.index');
        Route::get('brands/create', 'BrandsController@create')->name('admin.brands.create');
        Route::post('brands/store', 'BrandsController@store')->name('admin.brand.store');
        Route::get('brands/{brand}', 'BrandsController@edit')->name('admin.brand.edit');
        Route::patch('brands/update/{brand}', 'BrandsController@update')->name('admin.brand.update');
        Route::get('delete-brand/{brand}', 'BrandsController@destroy')->name('admin.brand.destroy');
        Route::patch('update-brand-status', 'BrandsController@status')->name('update.brand.status');

        /*CATEGORIES ROUTE*/
        Route::get('categories', 'CategoryController@index')->name('categories');
        Route::patch('update-category-status', 'CategoryController@updateCategoryStatus')->name('update.category.status');
        Route::match(['get','post'], 'add-edit-category/{id?}', 'CategoryController@addUpdateCategory')->name('admin.add.edit.category');
        Route::post('append-categories-level', 'CategoryController@appendCategoriesLevel')->name('append.category.level');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCatgeoryImage')->name('delete.category.image');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory')->name('delete.category');

        /*PRODUCT ROUTE*/
        Route::get('products', 'ProductsController@index')->name('admin.products.index');
        Route::get('products/create', 'ProductsController@create')->name('admin.products.create');
        Route::post('products/store', 'ProductsController@store')->name('admin.product.store');
        Route::get('products/{product}', 'ProductsController@edit')->name('admin.product.edit');
        Route::patch('products/update/{product}', 'ProductsController@update')->name('admin.product.update');
        Route::patch('update-product-status', 'ProductsController@status')->name('update.product.status');
        Route::get('delete-product/{product}', 'ProductsController@destroy')->name('product.destroy');
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage')->name('delete.product.image');
        Route::get('delete-product-video/{id}', 'ProductsController@deleteProductVideo')->name('delete.product.video');

        /*PRODUCT ATTRIBUTES*/
        Route::match(['get', 'post'], 'product-attribute/{id}', 'ProductAttributesController@store')->name('admin.product.attribute');
        Route::patch('product-edit-attribute/{id}', 'ProductAttributesController@update')->name('admin.product.edit.attribute');
        Route::patch('update-product-attribute-status','ProductAttributesController@updateProductAttributeStatus')->name('admin.update.product.attribute.status');
        Route::get('delete-product-attribute/{id}', 'ProductAttributesController@delete')->name('delete.product.attribute');

        /*PRODUCT IMAGES*/
        Route::match(['post','get'],'add-images/{id}', 'ProductImagesController@store')->name('admin.product.images');
       /* Route::patch('update-product-images/{id}', 'ProductImagesController@update')->name('admin.update.product.images');*/
        Route::patch('update-product-images-status', 'ProductImagesController@status')->name('admin.update.product.images.status');
        Route::get('delete-product-images/{id}', 'ProductImagesController@delete')->name('admin.delete.product.images');



   });

});
