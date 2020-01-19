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

Auth::routes();
/*
--------------------------------------------------------------------------
 Ajax Routes
--------------------------------------------------------------------------
*/
Route::post('/AjaxRequest', 'StoreController@ajaxRequest');
Route::post('/AjaxPublic', 'FrontendController@ajaxPublic');
Route::post('/ajaxCartController', 'CartController@updateCart');

// Temporary Route for bulk change in product
// Route::get('/changeProductSupplier', 'ProductController@changeProductSupplier')->name('changeProductSupplier');

/*
--------------------------------------------------------------------------
 Frontend Routes
--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend'], function()
{
  // Browse Home Page
  Route::get('/', 'UiWelcomeController@welcome')->name('welcome');
});
// Search Products
Route::get('/search', 'FrontendController@searchProducts')->name('searchProducts');

// Browse Store Directory
Route::get('/store-directory', 'Frontend\UiProductController@storeDirectory')->name('storeDirectory');
// Browse Products by Category
Route::get('/products/{categoryUrl}', 'Frontend\UiProductController@productsByCategory')->name('categoryProduct');
// Browse Products by Sub Category
Route::get('/products/{categoryUrl}/{subCategoryUrl}', 'FrontendController@subCategoryProduct')->name('subCategoryProduct');

Route::group(['prefix' => 'brand'], function()
{
  // Browse Categories by Brand
  Route::get('/{brandUrl}', 'FrontendController@categoriesByBrand')->name('categoriesByBrand');
  // Browse Sub Categories by Brand & Category
  Route::get('/{brandUrl}/{categoryUrl}/', 'FrontendController@subCategoriesByBrandCategory')->name('subCategoriesByBrandCategory');
  // Browse Sub Categories by Brand & Category
  Route::get('/{brandUrl}/{categoryUrl}/{subCategoryUrl}', 'FrontendController@productsByBrandCategorySubCategory')->name('productsByBrandCategorySubCategory');
});
// Products
Route::get('/product/{productUrl}', 'FrontendController@productDetails')->name('product_details');

// Action Routes //
// Cart products
Route::post('/product/add-to-cart', 'CartController@addCartProduct')->name('addCartProduct');
Route::get('/my-shopping-cart', 'CartController@cartProductsView')->name('cartProductsView');
Route::get('/my-shopping-cart/remove-item/{productId}', 'CartController@cartProductRemove')->name('cartProductRemove');

// Favorite products
Route::post('/product/add-to-favorite', 'FrontendController@addFavoriteProduct')->name('addFavoriteProduct');
Route::get('/my-favorite/products', 'FrontendController@favoriteProductsView')->name('favoriteProductsView');
// Move from Favorite to Cart
Route::post('/product/move-to-cart', 'FrontendController@moveToCartProduct')->name('moveToCartProduct');
// Delete from Favorite
Route::post('/product/delete-from-favorite', 'FrontendController@deleteFromFavoriteProduct')->name('deleteFromFavoriteProduct');


// Browse About Page
Route::get('/about', 'FrontendController@about')->name('about');

Route::group(['prefix' => 'contact'], function()
{
  // Browse Contact Page
  Route::get('/', 'FrontendController@contact')->name('contact');
  // Contact Submit
  Route::post('/send-message', 'FrontendController@contactSendMessage')->name('contact_send_message');
});
/*
--------------------------------------------------------------------------
 User Related Routes
--------------------------------------------------------------------------
*/
// Common dashboard route for Developer, Supplier, Customre & All User
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
// Common profile route for Developer, Supplier, Customre & All User
Route::get('/profile/{userName}', 'UserController@userProfile')->name('userProfile');
// Common settings route for Developer, Supplier, Customre & All User
Route::group(['prefix' => 'settings'], function()
{
  Route::get('/{userName}', 'UserController@userSettings')->name('userSettings');
  Route::post('/change-info', 'UserController@userSettingsInfoUpdate')->name('userSettingsInfoUpdate');
  Route::post('/change-password', 'UserController@userSettingsPasswordUpdate')->name('userSettingsPasswordUpdate');
});


/*
--------------------------------------------------------------------------
 Backend Routes
--------------------------------------------------------------------------

--------------------------------------------------------------------------
 Common Panel Routes
--------------------------------------------------------------------------
*/
// Store Index Related Routes
Route::get('/stores', 'StoreController@index')->name('stores');


/*
--------------------------------------------------------------------------
 Developer Panel Routes
--------------------------------------------------------------------------
*/
// Developer Preferences
Route::group(['prefix' => 'developer'], function()
{
  Route::group(['prefix' => 'preferences'], function()
  {
    Route::get('/', 'PreferencesController@developerPreferences')->name('developerPreferences');
    Route::post('/slider-submit', 'PreferencesController@developerSliderSubmit')->name('developerSliderSubmit');
    Route::post('/slider-update', 'PreferencesController@developerSliderUpdate')->name('developerSliderUpdate');
    Route::post('/slider-delete', 'PreferencesController@developerSliderDelete')->name('developerSliderDelete');
  });
  // Brand Related Routes
  Route::group(['prefix' => 'my-store'], function()
  {
    Route::get('/brand', 'StoreController@developerBrandAdd')->name('developerBrandAdd');
    Route::post('/brand-submit', 'StoreController@developerBrandSubmit')->name('developerBrandSubmit');
    // Category Add Related Routes
    Route::get('/category/add', 'StoreController@developerCategoryAdd')->name('developerCategoryAdd');
    Route::post('/category-submit', 'StoreController@developerCategorySubmit')->name('developerCategorySubmit');
    // Category Edit Related Routes
    Route::get('/category/edit/{catId}', 'StoreController@developerCategoryEdit')->name('developerCategoryEdit');
    Route::post('/category-update', 'StoreController@developerCategoryUpdate')->name('developerCategoryUpdate');
    // Sub Category Add Related Routes
    Route::get('/sub-category', 'StoreController@developersubCategoryAdd')->name('developerSubCategoryAdd');
    Route::post('/sub-category-submit', 'StoreController@developerSubCategorySubmit')->name('developerSubCategorySubmit');
    // Category Edit Related Routes
    Route::get('/sub-category/edit/{subCatId}', 'StoreController@developerSubCategoryEdit')->name('developerSubCategoryEdit');
    Route::post('/sub-category-update', 'StoreController@developerSubCategoryUpdate')->name('developerSubCategoryUpdate');
    Route::post('/sub-category-delete', 'StoreController@developerSubCategoryDelete')->name('developerSubCategoryDelete');
    // Sub Category Aissign Related Routes
    Route::get('/assign-sub-categories/category-{catId}', 'StoreController@developerAssignSubCat')->name('developerAssignSubCat');
    Route::post('/sub-category-assign-done', 'StoreController@developerAssignSubCatDone')->name('developerAssignSubCatDone');
  });
});


/*
--------------------------------------------------------------------------
 Supplier Panel Routes
--------------------------------------------------------------------------
*/
// Store Add Related Routes
Route::group(['prefix' => 'supplier'], function()
{
  // Inner Store Routes
  Route::get('/store/{storeId}', 'StoreController@supplierInnerStore')->name('innerStore');
  // My Categories, Sub Categories & Products
  Route::get('/cats/{storeId}', 'StoreController@supplierAllCategories')->name('supplierAllCategories');
  Route::get('/sub-cats/{storeId}/{categoryId}', 'StoreController@supplierAllSubCategories')->name('supplierAllSubCategories');
  Route::get('/products/{storeId}/{subCategoryId}', 'StoreController@supplierAllProducts')->name('supplierAllProducts');

  Route::group(['prefix' => 'my-store'], function()
  {
    Route::get('/add', 'StoreController@supplierStoreAdd')->name('supplierStoreAdd');
    Route::post('/submit', 'StoreController@supplierStoreSubmit')->name('supplierStoreSubmit');
    // Add Something new
    Route::get('/product-add/{storeId}', 'ProductController@supplierProductAdd')->name('supplierProductAdd');
    Route::post('/product/submit', 'ProductController@supplierProductSubmit')->name('supplierProductSubmit');
    // Product Edit related routes
    Route::get('/product-edit/{productId}', 'ProductController@supplierEditProduct')->name('supplierEditProduct');
    Route::post('/product/update', 'ProductController@supplierProductUpdate')->name('supplierProductUpdate');
    // Store role Assignment Related Routes
    Route::get('/role/{storeId}', 'StoreController@supplierstoreRole')->name('supplierStoreRole');
    Route::post('/role-assigned', 'StoreController@supplierroleAssigned')->name('supplierRoleAssigned');
    // Tag Related Routes
    Route::get('/tags/{storeId}', 'StoreController@supplierTags')->name('supplierTagAdd');
    Route::post('/tag-submit', 'StoreController@suppliertagSubmit')->name('supplierTagSubmit');
    // Inventory Related Routes
    Route::post('/increase-inventory', 'StoreController@supplierStoreInventoryIncrease')->name('storeInventoryIncrease');
  });

});
