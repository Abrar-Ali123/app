<?php

use App\Helpers\TextUtil;
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

//Route::get('/test',[App\Http\Controllers\Controller::class,'test'])->name('test');
Route::post('/test',[App\Http\Controllers\Controller::class,'test'])->name('test');
Route::get('/testView',[App\Http\Controllers\Controller::class,'testView']);


Route::prefix('/user')->group(function (){
    Route::get('/mobile/orders/{order_id}/payment/stripe/pay/', 'User\OrderPaymentController@stripePaymentViaMobile');
    Route::post('/mobile/orders/payment/stripe/callback/', 'User\OrderPaymentController@stripeCallbackViaMobile')->name('user.mobile.orders_payment.stripe.callback');
});

Route::group(['middleware'=>'locale'],function (){

    Route::prefix('admin')->group(function (){



        Route::get('/login',[App\Http\Controllers\Admin\Auth\LoginController::class,'showLoginForm']);
        Route::get('/register','Admin\Auth\RegisterController@showRegisterForm');
        Route::post('/login','Admin\Auth\LoginController@login')->name('admin.login');
        Route::post('/register','Admin\Auth\RegisterController@create')->name('admin.register');


        //Password  Reset
        Route::post('/password/email','Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset','Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset','Admin\Auth\ResetPasswordController@reset');
        Route::get('/password/reset/{token}','Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

    });

    Route::prefix('manager')->group(function (){

        Route::get('/login','Manager\Auth\LoginController@showLoginForm');
        Route::get('/register','Manager\Auth\RegisterController@showRegisterForm');
        Route::post('/login','Manager\Auth\LoginController@login')->name('manager.login');
        Route::post('/register','Manager\Auth\RegisterController@create')->name('manager.register');


        //Password  Reset
        Route::post('/password/email','Manager\Auth\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
        Route::get('/password/reset','Manager\Auth\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
        Route::post('/password/reset','Manager\Auth\ResetPasswordController@reset');
        Route::get('/password/reset/{token}','Manager\Auth\ResetPasswordController@showResetForm')->name('manager.password.reset');

        //Print Receipt
       // Route::get('/orders/{id}/receipt','Manager\OrderReceiptController@show')->name('user.orders.receipt');



    });

    Route::prefix('user')->group(function (){

        Route::get('/login','User\Auth\LoginController@showLoginForm');
        Route::get('/register','User\Auth\RegisterController@showRegisterForm');
        Route::post('/login','User\Auth\LoginController@login')->name('user.login');
        Route::post('/register','User\Auth\RegisterController@create')->name('user.register');


        //Password  Reset
        Route::post('/password/email','User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
        Route::get('/password/reset','User\Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
        Route::post('/password/reset','User\Auth\ResetPasswordController@reset');
        Route::get('/password/reset/{token}','User\Auth\ResetPasswordController@showResetForm')->name('user.password.reset');

    });



    Route::group(['middleware'=>'auth:admin','prefix'=>'/admin'],function (){

        //----------------------------- Auth -----------------------------------//
        Route::get('/logout','Admin\Auth\LoginController@logout')->name('admin.logout');



        // ------------------------ Admin ---------------------------//
        Route::get('/','Admin\AdminController@index')->name('admin.dashboard');
        Route::get('/setting','Admin\AdminController@edit')->name('admin.setting.edit');
        Route::patch('/setting','Admin\AdminController@update')->name('admin.setting.update');
        Route::patch('/setting/updateLocale/{langCode}','Admin\AdminController@updateLocale')->name('admin.setting.updateLocale');

        //----------------------- Add Data -----------------------------//
        Route::get('/app_data','Admin\AppDataController@index')->name('admin.appdata.index');
        Route::post('/app_data','Admin\AppDataController@create')->name('admin.appdata.create');


        //----------------------- Banner -----------------------------//
        Route::get('/banners','Admin\BannerController@index')->name('admin.banners.index');
        Route::post('/banners','Admin\BannerController@store')->name('admin.banners.store');
        Route::delete('/banners','Admin\BannerController@destroy')->name('admin.banners.destroy');



        //-------------------------------- Category --------------------------------//

        //Index
        Route::get('/users/','Admin\UserController@index')->name('admin.users.index');
        Route::get('/users/{id}','Admin\UserController@edit')->name('admin.users.edit');
        Route::patch('/users/{id}','Admin\UserController@update')->name('admin.users.update');


        //-------------------------------- Category --------------------------------//

        //Index
        Route::get('/categories/','Admin\CategoryController@index')->name('admin.categories.index');

        //Create
        Route::get('/categories/create','Admin\CategoryController@create')->name('admin.categories.create');
        Route::post('/categories','Admin\CategoryController@store')->name('admin.categories.store');

        //Read
        Route::get('/categories/{id}','Admin\CategoryController@show')->name('admin.categories.show');

        //Update
        Route::get('/categories/{id}/edit','Admin\CategoryController@edit')->name('admin.categories.edit');
        Route::patch('/categories/{id}','Admin\CategoryController@update')->name('admin.categories.update');

        //Delete
        Route::delete('/categories/{id}','Admin\CategoryController@destroy')->name('admin.categories.destroy');






        //-------------------------------- Sub - Category --------------------------------//

        //Index
        Route::get('/sub_categories/','Admin\SubCategoryController@index')->name('admin.sub-categories.index');

        //Create
        Route::get('/sub_categories/create','Admin\SubCategoryController@create')->name('admin.sub-categories.create');
        Route::post('/sub_categories','Admin\SubCategoryController@store')->name('admin.sub-categories.store');

        //Read
        Route::get('/sub_categories/{id}','Admin\SubCategoryController@show')->name('admin.sub-categories.show');

        //Update
        Route::get('/sub_categories/{id}/edit','Admin\SubCategoryController@edit')->name('admin.sub-categories.edit');
        Route::patch('/sub_categories/{id}','Admin\SubCategoryController@update')->name('admin.sub-categories.update');

        //Delete
        Route::delete('/sub_categories/{id}','Admin\SubCategoryController@destroy')->name('admin.sub-categories.destroy');



        //-------------------------------- Coupon --------------------------------//

        //Index
        Route::get('/coupons','Admin\CouponController@index')->name('admin.coupons.index');

        //Create
        Route::get('/coupons/create','Admin\CouponController@create')->name('admin.coupons.create');
        Route::post('/coupons','Admin\CouponController@store')->name('admin.coupons.store');

        //Read
        Route::get('/coupons/{id}','Admin\CouponController@show')->name('admin.coupons.show');

        //Update
        Route::get('/coupons/{id}/edit','Admin\CouponController@edit')->name('admin.coupons.edit');
        Route::patch('/coupons/{id}','Admin\CouponController@update')->name('admin.coupons.update');

        //Delete
        Route::delete('/coupons/{id}','Admin\CouponController@destroy')->name('admin.coupons.destroy');



        //-------------------------------- Product --------------------------------//

        //Index
        Route::get('/products','Admin\ProductController@index')->name('admin.products.index');



        //Read
        Route::get('/products/{id}','Admin\ProductController@show')->name('admin.products.show');

        //Update
        Route::get('/products/{id}/edit','Admin\ProductController@edit')->name('admin.products.edit');
        Route::get('/products/{id}/images','Admin\ProductImageController@edit')->name('admin.product-images.edit');
        Route::post('/products/{id}/images','Admin\ProductImageController@store')->name('admin.product-images.store');
        Route::patch('/products/{id}','Admin\ProductController@update')->name('admin.products.update');


        //Delete
        Route::delete('/products/{id}','Admin\ProductController@destroy')->name('admin.products.destroy');

        //Delete Product Image
        Route::delete('/productImages','Admin\ProductImageController@destroy')->name('admin.product-images.delete');





        //------------------------------ Order ----------------------------------------//

        //Index
        Route::get('/orders','Admin\OrderController@index')->name('admin.orders.index');

        //edit
        Route::get('/orders/{id}','Admin\OrderController@show')->name('admin.orders.show');


        //----------------------------- Shop ------------------------------------//

        //index
        Route::get('/shops','Admin\ShopController@index')->name('admin.shops.index');

        //create
        Route::get('/shops/create','Admin\ShopController@create')->name('admin.shops.create');
        Route::post('/shops','Admin\ShopController@store')->name('admin.shops.store');

        //show
        Route::get('/shops/{id}','Admin\ShopController@show')->name('admin.shops.show');


        //update
        Route::get('/shops/{id}/edit','Admin\ShopController@edit')->name('admin.shops.edit');
        Route::patch('/shops/{id}/edit','Admin\ShopController@update')->name('admin.shops.update');


        //Shop Reviews
        Route::get('/shops/{id}/reviews','Admin\ShopController@showReviews')->name('admin.shops.reviews.show');




        //---------------------------- Shop Review -----------------------------//

        //Delete
        Route::delete('/shops-reviews/{id}','Admin\ShopReviewController@destroy')->name('admin.shops.reviews.delete');



        //------------------------------ Shop Request --------------------------//
        Route::get('/shop_requests','Admin\ShopRequestController@index')->name('admin.shop_requests.index');
        Route::patch('/shop_requests/{id}','Admin\ShopRequestController@update')->name('admin.shop_requests.update');


        //------------------------------ Delivery Boy --------------------------//
        //index
        Route::get('/delivery-boys','Admin\DeliveryBoyController@index')->name('admin.delivery-boys.index');
        Route::get('/delivery-boys/{id}/reviews','Admin\DeliveryBoyController@showReviews')->name('admin.delivery-boy.reviews.show');

        //Delete review
        Route::delete('/delivery-boy-reviews/{id}','Admin\DeliveryBoyReviewController@destroy')->name('admin.delivery-boy.review.delete');




        //Index
        Route::get('/transactions','Admin\TransactionController@index')->name('admin.transactions.index');


        //capture payment
        Route::post('/capture_transaction/{id}','Admin\TransactionController@capturePayment')->name('admin.transaction.capture');
        Route::post('/refund_transaction/{id}','Admin\TransactionController@refundPayment')->name('admin.transaction.refund');



        //-----------------  FCM Notifications ------------------------//
        Route::get('/notifications','Admin\NotificationController@create')->name('admin.notifications.create');
        Route::post('/notifications','Admin\NotificationController@send')->name('admin.notifications.send');


    });

    Route::group(['middleware'=>['auth:manager'],'prefix'=>'/manager'],function () {
        Route::get('/mobile_verification','Manager\Auth\NumberVerificationController@showNumberVerificationForm')->name('manager.auth.numberVerificationForm');
        Route::post('/verify_mobile_number','Manager\Auth\NumberVerificationController@verifyMobileNumber')->name('manager.auth.verify_mobile_number');
        Route::post('/mobile_verified','Manager\Auth\NumberVerificationController@mobileVerified')->name('manager.auth.mobile_verified');

    });

    Route::group(['middleware'=>['auth:manager','numberVerification:manager'],'prefix'=>'/manager'],function (){



        //--------------------------- Auth -------------------------------------//
        Route::get('/logout','Manager\Auth\LoginController@logout')->name('manager.logout');



        //-------------------------- Manager -----------------------------------//
        Route::get('/','Manager\ManagerController@index')->name('manager.dashboard');
        Route::get('/setting','Manager\ManagerController@edit')->name('manager.setting.edit');
        Route::patch('/setting','Manager\ManagerController@update')->name('manager.setting.update');
        Route::patch('/setting/updateLocale/{langCode}','Manager\ManagerController@updateLocale')->name('manager.setting.updateLocale');






        //-------------------------------- Shop --------------------------------//

        //Index
        Route::get('/shops','Manager\ShopController@index')->name('manager.shops.index');

        //Create is not available

        //Read
        Route::get('/shops/{id}','Manager\ShopController@show')->name('manager.shops.show');

        //Update
        Route::get('/shops/{id}/edit','Manager\ShopController@edit')->name('manager.shops.edit');
        Route::patch('/shops/{id}','Manager\ShopController@update')->name('manager.shops.update');

        //Delete
        Route::delete('/shops/{id}','Manager\ShopController@destroy')->name('manager.shops.destroy');

        //Shop Reviews
        Route::get('/shops/{id}/reviews','Manager\ShopController@showReviews')->name('manager.shops.show_reviews');




        //-------------------------------- Shop Request --------------------------------//

        Route::post('/shop_requests','Manager\ShopRequestController@store')->name('manager.shop_requests.store');

        //Delete
        Route::delete('/shop_requests/{id}','Manager\ShopRequestController@destroy')->name('manager.shop_requests.destroy');





        //-------------------------------- Product --------------------------------//

        //Index
        Route::get('/products','Manager\ProductController@index')->name('manager.products.index');

        //Create
        Route::get('/products/create','Manager\ProductController@create')->name('manager.products.create');
        Route::post('/products','Manager\ProductController@store')->name('manager.products.store');
        Route::post('/products/{id}/images','Manager\ProductImageController@store')->name('manager.product-images.store');

        //Read

        Route::get('/products/{id}','Manager\ProductController@show')->name('manager.products.show');

        //Update
        Route::get('/products/{id}/edit','Manager\ProductController@edit')->name('manager.products.edit');
        Route::get('/products/{id}/images','Manager\ProductImageController@edit')->name('manager.product-images.edit');
        Route::patch('/products/{id}','Manager\ProductController@update')->name('manager.products.update');

        //Delete
        Route::delete('/products/{id}','Manager\ProductController@destroy')->name('manager.products.destroy');




        //-------------------------------- Product Images --------------------------------//


        //Delete
        Route::delete('/productImages','Manager\ProductImageController@destroy')->name('manager.product-images.delete');


        //--------------------------------- Reviews -----------------------------------//

        //Index
        Route::get('/reviews','Manager\ProductReviewController@index')->name('manager.reviews.index');




        //---------------------------------- Order -----------------------------------//

        //Index
        Route::get('/orders','Manager\OrderController@index')->name('manager.orders.index');

        //Update
        Route::get('/orders/{id}/edit','Manager\OrderController@edit')->name('manager.orders.edit');
        Route::patch('/orders/{id}','Manager\OrderController@update')->name('manager.orders.update');


        //----------------------------- Shop Revenues ------------------------------------//
        //index
        Route::get('/shop-revenues','Manager\ShopRevenueController@index')->name('manager.shop-revenues.index');


        //------------------------------ Transactions --------------------------//
        //index
        Route::get('/transaction','Manager\TransactionController@index')->name('manager.transaction.index');




        //---------------------------------------- Coupon -------------------------//
        Route::get('/coupons','Manager\ShopCouponController@index')->name('manager.coupons.index');
        Route::patch('/coupons','Manager\ShopCouponController@update')->name('manager.coupons.update');




        //----------------------------- Delivery Boy ---------------------------------//

        //Index
        Route::get('/delivery_boys','Manager\DeliveryBoyController@index')->name('manager.delivery-boys.index');



        //Show reviews
        Route::get('/delivery-boys/{id}/reviews','Manager\DeliveryBoyController@showReviews')->name('manager.delivery-boy.reviews.show');


        //Assign
        Route::get('/delivery_boys/assign/{order_id}','Manager\DeliveryBoyController@showForAssign')->name('manager.delivery-boys.showForAssign');
        Route::post('/delivery_boys/assign/{order_id}/{delivery_boy_id}','Manager\DeliveryBoyController@assign')->name('manager.delivery-boys.assign');



    });


    Route::group(['middleware'=>['auth:user'],'prefix'=>'/user'],function () {
        Route::get('/mobile_verification','User\Auth\NumberVerificationController@showNumberVerificationForm')->name('user.auth.numberVerificationForm');
        Route::post('/verify_mobile_number','User\Auth\NumberVerificationController@verifyMobileNumber')->name('user.auth.verify_mobile_number');
        Route::post('/mobile_verified','User\Auth\NumberVerificationController@mobileVerified')->name('user.auth.mobile_verified');

        //--------------------------- Blocked -------------------------------------//
        Route::get('/block','User\Auth\BlockController@show')->name('user.block.show');

        //--------------------------- Auth -------------------------------------//
        Route::get('/logout','User\Auth\LoginController@logout')->name('user.logout');

    });


    Route::group(['middleware'=>['auth:user','numberVerification:user','blocked:user'],'prefix'=>'/user'],function (){


        //-------------------------- User -----------------------------------//
        Route::get('/','User\UserController@index')->name('user.dashboard');
        Route::get('/setting','User\UserController@edit')->name('user.setting.edit');
        Route::patch('/setting','User\UserController@update')->name('user.setting.update');
        Route::patch('/setting/updateLocale/{langCode}','User\UserController@updateLocale')->name('user.setting.updateLocale');


        //-------------------------------- Product --------------------------------//

        //Index
        Route::get('/products','User\ProductController@index')->name('user.products.index');


        //Show
        Route::get('/products/{id}','User\ProductController@show')->name('user.products.show');

        //Show Reviews
        Route::get('/products/{id}/reviews', 'User\ProductController@showReviews')->name('user.product.reviews.show');


        //----------------- Category -------------------------------//
        Route::get('/categories/{id}', 'User\CategoryController@show')->name('user.categories.show');

        //----------------- Sub Category -------------------------------//
        Route::get('/sub_categories/{id}', 'User\SubCategoryController@show')->name('user.sub-categories.show');




        //--------------- Favourite ------------------------//
        Route::get('/favorites', 'User\FavoriteController@index')->name('user.favorites.index');
        Route::post('/favorites', 'User\FavoriteController@store')->name('user.favorites.store');



        //----------------- Cart -------------------------------//
        Route::get('/carts', 'User\CartController@index')->name('user.carts.index');
        Route::post('/carts', 'User\CartController@store')->name('user.carts.store');
        Route::delete('/carts', 'User\CartController@destroy')->name('user.carts.delete');
        Route::patch('/carts/{id}', 'User\CartController@update')->name('user.carts.update');


        //----------------------------------- Order ----------------------------------------//
        Route::get('/orders', 'User\OrderController@index')->name('user.orders.index');
        Route::patch('/orders/{id}', 'User\OrderController@update')->name('user.orders.update');
        Route::get('/orders/{id}', 'User\OrderController@show')->name('user.orders.show');
        Route::post('/orders', 'User\OrderController@store')->name('user.orders.store');
        Route::get('/orders/{id}/reviews', 'User\OrderController@showReviews')->name('user.order.review.show');



        //---------------- Shop --------------------------//
        Route::get('/shops/{id}', 'User\ShopController@show')->name('user.shops.show');
        Route::get('/shops', 'User\ShopController@index')->name('user.shops.index');
        Route::get('/shops/{id}/reviews', 'User\ShopController@showReviews')->name('user.shop.reviews.show');



        //--------------------- Order Payment -----------------------------------------------//
        Route::get('/orders/{id}/payment', 'User\OrderPaymentController@index')->name('user.orders_payment.index');

        //Paystack Gateway
        Route::post('orders/payment/paystack/pay', 'User\OrderPaymentController@paystackPayment')->name('user.orders_payment.paystack.pay');
        Route::get('orders/payment/paystack/callback', 'User\OrderPaymentController@handleGatewayCallback');

        //Stripe Gateway
        Route::get('orders/payment/stripe/pay', 'User\OrderPaymentController@stripePayment')->name('user.orders_payment.stripe.pay');
        Route::post('orders/payment/stripe/callback', 'User\OrderPaymentController@handleStripePaymentCallback')->name('user.orders_payment.stripe.callback');


        //----------------- Order Checkout -------------------------------//
        Route::get('/checkout', 'User\CheckoutController@index')->name('user.checkout.index');



        //-------------------- Address ------------------------//
        Route::get('/addresses', 'User\UserAddressController@index')->name('user.addresses.index');
        Route::get('/addresses/create', 'User\UserAddressController@create')->name('user.addresses.create');
        Route::post('/addresses', 'User\UserAddressController@store')->name('user.addresses.store');
        Route::delete('/addresses/{id}', 'User\UserAddressController@destroy')->name('user.addresses.delete');


        //-------------------- Shop Review ----------------------//
        Route::post('/shop-reviews', 'User\ShopReviewController@store')->name('user.shop_reviews.store');

        //-------------------- Product Review ----------------------//
        Route::post('/product-reviews', 'User\ProductReviewController@store')->name('user.product_reviews.store');


        //-------------------- Delivery Boy Review ----------------------//
        Route::post('/delivery-boy-reviews', 'User\DeliveryBoyReviewController@store')->name('user.delivery_boy_reviews.store');





    });


    Route::prefix('user')->group(function (){

        //Password  Reset
        Route::post('/password/reset','User\Auth\ResetPasswordController@reset')->name('user.password.reset');
        Route::get('/password/reset/{token}','User\Auth\ResetPasswordController@showResetForm')->name('user.password.resetForm');


        //Print Receipt
       // Route::get('/orders/{id}/receipt','User\OrderReceiptController@show')->name('user.orders.receipt');



    });

    Route::prefix('delivery-boy')->group(function (){

        //Password  Reset
        Route::post('/password/reset','DeliveryBoy\Auth\ResetPasswordController@reset')->name('delivery-boy.password.reset');
        Route::get('/password/reset/{token}','DeliveryBoy\Auth\ResetPasswordController@showResetForm')->name('delivery-boy.password.resetForm');


        //Print Receipt
        Route::get('/orders/{id}/receipt','DeliveryBoy\OrderReceiptController@show')->name('delivery-boy.orders.receipt');

    });



    Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {

    });

    Route::get('/', function () {
        return view('home');
    })->name('home');




//Auth::routes();








});


//Applications
Route::get('/downloads/apk',function (){
    return redirect(TextUtil::$DOCS_APK);
})->name('downloads.apk');

Route::get('/downloads/apk/emall',function (){
    return redirect(TextUtil::$EMALL_APK_DOWNLOAD);
})->name('downloads.apk.emall');

Route::get('/downloads/apk/manager',function (){
    return redirect(TextUtil::$MANAGER_APK_DOWNLOAD);
})->name('downloads.apk.manager');


Route::get('/downloads/apk/delivery-boy',function (){
    return redirect(TextUtil::$DELIVERY_BOY_APK_DOWNLOAD);
})->name('downloads.apk.delivery-boy');

