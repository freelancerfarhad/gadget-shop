<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\SliderController;
use App\Http\Middleware\TokenAuthenticate;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductWishListController;



Route::get('/',[HomeController::class,'HomePage'])->name('home.page');
Route::get('/by-category',[CategoryController::class,'ProductByCategoryPage']);
Route::get('/by-brand',[BrandController::class,'ProductByBrandPage']);
Route::get('/policy',[PolicyController::class,'PolicyPage']);
Route::get('/details', [ProductController::class, 'Details']);


/**
 * API Route All
*/
// BrandList
Route::get('/brand-list',[BrandController::class,'BrandList'])->name('brand.list');


// CategoryList
Route::get('/category-list',[CategoryController::class,'CategoryList'])->name('category.list');
// ListProductByCategory
Route::get('/ListProductByCategory/{id}',[ProductController::class,'ListProductByCategory'])->name('productbycategory');
// ListProductByRemark
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ListProductByRemark'])->name('productbyremark');
// ListProductByBrand
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ListProductByBrand'])->name('productbybrand');
// ListProductBySlider
Route::get('/ListProductBySlider',[ProductController::class,'ListProductBySlider'])->name('productbyslider');
// ProductDetailsById
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById'])->name('productbydetails');
// ListReviewByProduct
Route::get('/ListReviewByProduct/{product_id}',[ProductController::class,'ListReviewByProduct'])->name('productbyreview');
// PolicyByType
Route::get('/PolicyByType/{type}',[PolicyController::class,'PolicyByType'])->name('policybytype');
//filter product
Route::get('/search-product',[ProductController::class,'search_products'])->name('search.products');
Route::get('/sort-by',[ProductController::class,'sort_by'])->name('sort.by');

// user auth
Route::get('/UserLogin/{UserEmail}',[UserController::class,'UserLogin'])->name('user.login');
Route::get('/VerifyLogin/{UserEmail}/{OTP}',[UserController::class,'VerifyLogin'])->name('user.otp');
Route::get('/logout',[UserController::class,'UserLogout'])->name('UserLogout');
Route::get('/login', [UserController::class, 'loginPage']);
Route::get('/verify', [UserController::class, 'verifyPage']);
Route::get('/wish', [ProductWishListController::class, 'WishListPage'])->name('wishlist');
Route::get('/cart', [ProductCartController::class, 'productCartPage'])->name('cart');
// user profile
Route::get('/profile', [ProfileController::class, 'profilePage'])->name('profile')->middleware(TokenAuthenticate::class);
Route::post('/createProfile',[ProfileController::class,'createProfile'])->name('create.profle')->middleware(TokenAuthenticate::class);
Route::get('/readProfile',[ProfileController::class,'readProfile'])->name('read.profle')->middleware(TokenAuthenticate::class);

//review product
Route::post('/CreateReviwByProduct',[ProductController::class,'CreateReviwByProduct'])->name('read.review')->middleware(TokenAuthenticate::class);



//wishlist api
Route::get( '/wishlist', [ProductWishListController::class, 'ProductWishList'])->middleware(TokenAuthenticate::class);
Route::get( '/createwishlist/{product_id}', [ProductWishListController::class, 'CreateWishList'])->middleware(TokenAuthenticate::class);
Route::get( '/deletewishlist/{product_id}', [ProductWishListController::class, 'RemoveWishList'])->middleware(TokenAuthenticate::class);
Route::get('/total-wishlist', [ProductWishListController::class, 'WishListCount'])->name('total-wishlist')->middleware(TokenAuthenticate::class);

//product cart api
Route::post( '/create-product-cart', [ProductCartController::class, 'CreateProdudtCart'])->middleware(TokenAuthenticate::class);

Route::get( '/list-product-cart', [ProductCartController::class, 'ListProductCart'])->middleware(TokenAuthenticate::class);
Route::get( '/remove-product-cart/{product_id}', [ProductCartController::class, 'RemoveProductCart'])->middleware(TokenAuthenticate::class);
Route::get('/total-cart-qty', [ProductCartController::class, 'CartQTYCount'])->name('total-cartQty')->middleware(TokenAuthenticate::class);
//invoice
Route::get( '/create-invoice', [InvoiceController::class, 'InvoiceCreate'])->middleware(TokenAuthenticate::class);
Route::get( '/invoice-list', [InvoiceController::class, 'ListInvoice'])->middleware(TokenAuthenticate::class);
Route::get( '/invoice-product-list/{invoice_id}', [InvoiceController::class, 'InvoiceProductList'])->middleware(TokenAuthenticate::class);

Route::post( '/PaymentSuccess', [InvoiceController::class, 'PaymentSuccess']);
Route::post( '/PaymentFail', [InvoiceController::class, 'PaymentFail']);
Route::post( '/PaymentCancel', [InvoiceController::class, 'PaymentCancel']);



// Backend Page Route -----------------------------------------------------------------
Route::get( '/dashboard', [DashboardController::class, 'DashboardPage'] )->name('dashboard');
Route::get( '/brand-page', [BrandController::class, 'BrandPage'] )->name('brandPage');
Route::get( '/category-page', [CategoryController::class, 'CategoryPage'] )->name('CategoryPage');
Route::get( '/product-page', [ProductController::class, 'ProductPage'] )->name('ProductPage');
Route::get( '/slider-page', [SliderController::class, 'SliderPage'] )->name('SliderPage');
//slider 
Route::post('/create-slider',[SliderController::class,'CreateSlider'])->name('create.slider');
Route::post('/update-slider',[SliderController::class,'UpdateSlider'])->name('update.slider');
Route::post('/delete-slider',[SliderController::class,'DeleteSlider'])->name('delete.slider');
Route::post('/slider_by_id',[SliderController::class,'SliderById']);
//brand 
Route::post('/create-brand',[BrandController::class,'CreateBrind'])->name('create.brand');
Route::post('/update-brand',[BrandController::class,'UpdateBrind'])->name('update.brand');
Route::post('/delete-brand',[BrandController::class,'DeleteBrind'])->name('delete.brand');
Route::post('/brand_by_id',[BrandController::class,'BrandById']);
//category 
Route::post('/create-category',[CategoryController::class,'CreateCategory'])->name('create.category');
Route::post('/update-category',[CategoryController::class,'UpdateCategory'])->name('update.category');
Route::post('/delete-category',[CategoryController::class,'DeleteCategory'])->name('delete.category');
Route::post('/category_by_id',[CategoryController::class,'CategoryById']);
//product 
Route::get('/product-list',[ProductController::class,'ProductList'])->name('product.list');
Route::post('/create-product',[ProductController::class,'CreateProduct'])->name('product.store');
Route::get('/product-edit',[ProductController::class,'ProductEdit'])->name('product.edit');
Route::post('/update-product',[ProductController::class,'UpdateProduct'])->name('update.product');
Route::post('/delete-product',[ProductController::class,'DeleteProduct'])->name('delete.product');
Route::post('/product_by_id',[ProductController::class,'ProductById']);
// Backend Page Route -----------------------------------------------------------------


