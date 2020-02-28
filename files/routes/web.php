<?php
Route::namespace('Admin')->group(function(){

    Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login.submit');
    Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
        Route::get('/', 'PagesController@index')->name('admin.index');

        Route::group(['prefix' => 'categories'], function(){
            Route::get('/', 'CategoriesController@index')->name('category.index');
            Route::get('/create', 'CategoriesController@create')->name('category.create');
            Route::put('/store', 'CategoriesController@store')->name('category.store');
            Route::group(['prefix' => '{category}'], function(){
                Route::get('edit', 'CategoriesController@edit')->name('category.edit');
                Route::post('edit', 'CategoriesController@update')->name('category.update');
                Route::delete('delete', 'CategoriesController@delete')->name('category.delete');
            });
        });

        Route::group(['prefix' => 'subcategories'], function(){
            Route::get('/', 'SubcategoriesController@index')->name('subcategory.index');
            Route::get('/create', 'SubcategoriesController@create')->name('subcategory.create');
            Route::put('/store', 'SubcategoriesController@store')->name('subcategory.store');
            Route::group(['prefix' => '{subcategory}'], function(){
                Route::get('edit', 'SubcategoriesController@edit')->name('subcategory.edit');
                Route::post('edit', 'SubcategoriesController@update')->name('subcategory.update');
                Route::delete('delete', 'SubcategoriesController@delete')->name('subcategory.delete');
            });
        });

        Route::group(['prefix' => 'categoryproducts'], function(){
            Route::get('/', 'CategoryproductsController@index')->name('categoryproduct.index');
            Route::get('/create', 'CategoryproductsController@create')->name('categoryproduct.create');
            Route::post('select-ajax', 'CategoryproductsController@selectAjax')->name('select-ajax');
            Route::put('/store', 'CategoryproductsController@store')->name('categoryproduct.store');
            Route::group(['prefix' => '{categoryproduct}'], function(){
                Route::get('edit', 'CategoryproductsController@edit')->name('categoryproduct.edit');
                Route::post('edit', 'CategoryproductsController@update')->name('categoryproduct.update');
                Route::delete('delete', 'CategoryproductsController@delete')->name('categoryproduct.delete');
            });
        });

        Route::group(['prefix' => 'brandcategories'], function(){
            Route::get('/', 'BrandcategoriesController@index')->name('brandcategories.index');
            Route::get('/create', 'BrandcategoriesController@create')->name('brandcategories.create');
            Route::put('/store', 'BrandcategoriesController@store')->name('brandcategories.store');
            Route::group(['prefix' => '{brandcategory}'], function(){
                Route::get('edit', 'BrandcategoriesController@edit')->name('brandcategories.edit');
                Route::post('edit', 'BrandcategoriesController@update')->name('brandcategories.update');
                Route::delete('delete', 'BrandcategoriesController@delete')->name('brandcategories.delete');
            });
        });

        Route::group(['prefix' => 'brands'], function(){
            Route::get('/', 'BrandsController@index')->name('brand.index');
            Route::get('/create', 'BrandsController@create')->name('brand.create');
            Route::put('/store', 'BrandsController@store')->name('brand.store');
            Route::group(['prefix' => '{brand}'], function(){
                Route::get('edit', 'BrandsController@edit')->name('brand.edit');
                Route::post('edit', 'BrandsController@update')->name('brand.update');
                Route::delete('delete', 'BrandsController@delete')->name('brand.delete');
            });
        });

        Route::group(['prefix' => 'products'], function(){
            Route::get('/', 'ProductsController@index')->name('product.index');
            Route::get('/export', 'ProductsController@export')->name('product.export');
            Route::post('/import', 'ProductsController@import')->name('product.import');
            Route::get('/create', 'ProductsController@create')->name('product.create');
            Route::post('select-ajax', 'ProductsController@selectAjax')->name('select-ajax');
            Route::put('/store', 'ProductsController@store')->name('product.store');
            Route::get('{subcategory}', 'ProductsController@showsubcat')->name('product.showsubcat');
            Route::group(['prefix' => '{product}'], function(){
                Route::get('edit', 'ProductsController@edit')->name('product.edit');
                Route::post('edit', 'ProductsController@update')->name('product.update');
                Route::delete('delete', 'ProductsController@delete')->name('product.delete');
            });
        });

        Route::group(['prefix' => 'blogs'], function(){
            Route::get('/', 'BlogsController@index')->name('blog.index');
            Route::get('/create', 'BlogsController@create')->name('blog.create');
            Route::put('/store', 'BlogsController@store')->name('blog.store');
            Route::group(['prefix' => '{blog}'], function(){
                Route::get('edit', 'BlogsController@edit')->name('blog.edit');
                Route::post('edit', 'BlogsController@update')->name('blog.update');
                Route::delete('delete', 'BlogsController@delete')->name('blog.delete');
            });
        });

        Route::group(['prefix' => 'countries'], function(){
            Route::get('/', 'CountriesController@index')->name('country.index');
            Route::get('/create', 'CountriesController@create')->name('country.create');
            Route::put('/store', 'CountriesController@store')->name('country.store');
            Route::group(['prefix' => '{country}'], function(){
                Route::get('edit', 'CountriesController@edit')->name('country.edit');
                Route::post('edit', 'CountriesController@update')->name('country.update');
                Route::delete('delete', 'CountriesController@delete')->name('country.delete');
            });
        });

        Route::group(['prefix' => 'comments'], function(){
            Route::get('/', 'CommentsController@index')->name('comment.index');
            Route::group(['prefix' => '{id}'], function(){
                Route::get('edit', 'CommentsController@edit')->name('comment.edit');
                Route::post('edit', 'CommentsController@update')->name('comment.update');
                Route::delete('delete', 'CommentsController@delete')->name('comment.delete');
            });
        });

        Route::group(['prefix' => 'orders'], function(){
            Route::get('/', 'OrdersController@index')->name('order.index');
            Route::group(['prefix' => '{id}'], function(){
                Route::get('edit', 'OrdersController@edit')->name('order.edit');
                Route::post('edit', 'OrdersController@update')->name('order.update');
                Route::delete('delete', 'OrdersController@delete')->name('order.delete');
            });
        });

        Route::group(['prefix' => 'admins'], function(){
            Route::get('/', 'AdminsController@index')->name('admin-list.index');
            Route::get('/create', 'AdminsController@create')->name('admin-list.create');
            Route::put('/store', 'AdminsController@store')->name('admin-list.store');
            Route::group(['prefix' => '{id}'], function(){
                Route::get('edit', 'AdminsController@edit')->name('admin-list.edit');
                Route::post('edit', 'AdminsController@update')->name('admin-list.update');
                Route::delete('delete', 'AdminsController@delete')->name('admin-list.delete');
            });
        });

        Route::group(['prefix' => 'users'], function(){
            Route::get('/', 'AdminsController@userIndex')->name('user.index');
            Route::group(['prefix' => '{id}'], function(){
                Route::delete('delete', 'AdminsController@userDelete')->name('user.delete');
            });
        });

        Route::group(['prefix' => 'sliders'], function(){
            Route::get('/', 'SlidersController@index')->name('slider.index');
            Route::get('/create', 'SlidersController@create')->name('slider.create');
            Route::put('/store', 'SlidersController@store')->name('slider.store');
            Route::group(['prefix' => '{slider}'], function(){
                Route::get('edit', 'SlidersController@edit')->name('slider.edit');
                Route::post('edit', 'SlidersController@update')->name('slider.update');
                Route::delete('delete', 'SlidersController@delete')->name('slider.delete');
            });
        });

    });
});

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/moi-profile', 'UsersController@edit')->name('pages.users.edit');
    Route::patch('/moi-profile', 'UsersController@update')->name('users.update');
    Route::get('/moi-zakazy', 'OrdersController@index')->name('pages.order');
    Route::get('/moi-zakazy/zakaz-№{id}', 'OrdersController@show')->name('pages.order.show');
});

Route::get('/', 'PagesController@index')->name('pages.index');
Route::get('/kategoriya-brendov', 'PagesController@brands')->name('pages.brands');
Route::get('/brands/{brand}', 'PagesController@brand')->name('pages.brand');

Route::get('/news', 'PagesController@news')->name('pages.news');

Route::get('/cart', 'CartsController@index')->name('cart.index');
Route::post('/cart', 'CartsController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartsController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartsController@destroy')->name('cart.destroy');

Route::get('/wish', 'WishesController@index')->name('wish.index');
Route::post('/wish', 'WishesController@store')->name('wish.store');
Route::delete('/wish/{id}', 'WishesController@delete')->name('wish.delete');

Route::get('/checkout', 'CheckoutsController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutsController@store')->name('checkout.store');

Route::get('/poisk', 'PagesController@search')->name('pages.search');

Route::get('/spasibo-chto-vybrali-nas', 'ConfirmationController@index')->name('confirmation.index');

Route::get('/empty', 'CartsController@empty')->name('cart.empty');

Route::get('about', 'NavsController@about')->name('menu.about');
Route::get('dostavka', 'NavsController@delivery')->name('menu.delivery');
Route::get('oplata', 'NavsController@payment')->name('menu.payment');
Route::get('sotrudnichestvo', 'NavsController@contact')->name('menu.contact');
Route::get('optom', 'NavsController@gallery')->name('menu.gallery');
Route::get('eco-blog', 'NavsController@ecoBlog')->name('menu.eco-blog');
Route::get('eco-blog/{blog}', 'PagesController@blog')->name('pages.blog');

Route::get('{category}', 'PagesController@category')->name('pages.category');
Route::get('{category}/{subcategory}', 'PagesController@subcategory')->name('pages.subcategory');
Route::get('{category}/{subcategory}/{categoryproduct}', 'PagesController@categoryproduct')->name('pages.categoryproduct');
Route::get('{category}/{subcategory}/{categoryproduct}/{product}', 'PagesController@product')->name('pages.product');
Route::post('{category}/{subcategory}/{categoryproduct}/{product}', 'PagesController@rating')->name('pages.rating');
Route::put('{category}/{subcategory}/{categoryproduct}/{product}', 'CommentsController@store')->name('pages.comment');
