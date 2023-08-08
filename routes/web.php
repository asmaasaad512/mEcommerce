<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Fronted\CartController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Fronted\IndexController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;

use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\VendorProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, 'Index']);
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

 
//Admin Dashboard
Route::middleware('auth','role:admin')->group(function () {

  
Route::get('admin/dashobard',[AdminController::class,'AdminDashboard']);

Route::get('admin/logout',[AdminController::class,'AdminDestroy']);
Route::get('admin/profile',[AdminController::class,'AdminProfile']);
Route::post('admin/profile/store',[AdminController::class,'AdminProfileStore']);

Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword']);

Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword']);

});

/// Vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function() {
   Route::get('vendor/dashboard', [VendorController::class, 'VendorDashboard']);
 

   Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy']);
  
   Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');

    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore']);

    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword']);

    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword']);




// Vendor Add Product All Route 
Route::controller(VendorProductController::class)->group(function(){
    Route::get('/vendor/all/product' , 'VendorAllProduct');
    Route::get('/vendor/add/product' , 'VendorAddProduct');

    Route::post('/vendor/store/product' , 'VendorStoreProduct');
    Route::get('/vendor/edit/product/{id}' , 'VendorEditProduct');

    Route::post('/vendor/update/product' , 'VendorUpdateProduct');
    Route::post('/vendor/update/product/thambnail' , 'VendorUpdateProductThabnail');

    Route::post('/vendor/update/product/multiimage' , 'VendorUpdateProductmultiImage');
    
    Route::get('/vendor/product/multiimg/delete/{id}' , 'VendorMultiimgDelete');

    Route::get('/vendor/product/inactive/{id}' , 'VendorProductInactive');
    Route::get('/vendor/product/active/{id}' , 'VendorProductActive');

    Route::get('/vendor/delete/product/{id}' , 'VendorProductDelete');

    Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');
     

});
 // Brand All Route 
 Route::controller(VendorOrderController::class)->group(function(){
    Route::get('/vendor/order' , 'VendorOrder');
    Route::get('/vendor/return/order' , 'VendorReturnOrder');

    Route::get('/vendor/complete/return/order' , 'VendorCompleteReturnOrder');
    Route::get('/vendor/order/details/{order_id}' , 'VendorOrderDetails');
 
});
Route::controller(ReviewController::class)->group(function(){

    Route::get('/vendor/all/review' , 'VendorAllReview');
    
   });
});

Route::middleware('auth','role:user')->group(function () {

    Route::get('/dashboard',[UserController::class,'UserDashboard']);
    
    Route::get('user/logout',[UserController::class,'UserDestroy']);
    Route::get('user/profile',[UserController::class,'UserProfile']);
    Route::post('user/profile/store',[UserController::class,'userProfileStore']);
    
    Route::get('/user/change/password', [UserController::class, 'userChangePassword']);
    
    Route::post('/user/update/password', [userController::class, 'userUpdatePassword']);
    
    });



    Route::middleware(['auth','role:admin'])->group(function() {


        // Brand All Route 
       Route::controller(BrandController::class)->group(function(){
           Route::get('/all/brand' , 'AllBrand');
           Route::get('/add/brand' , 'AddBrand');
           Route::post('/store/brand' , 'StoreBrand');
           Route::get('/edit/brand/{id}' , 'EditBrand');
           Route::post('/update/brand' , 'UpdateBrand');
           Route::get('/delete/brand/{id}' , 'DeleteBrand');
       
       });
       
       
      //  Category All Route 
       Route::controller(CategoryController::class)->group(function(){
           Route::get('/all/category' , 'AllCategory');
           Route::get('/add/category' , 'AddCategory');
           Route::post('/store/category' , 'StoreCategory');
           Route::get('/edit/category/{id}' , 'EditCategory');
           Route::post('/update/category' , 'UpdateCategory');
           Route::get('/delete/category/{id}' , 'DeleteCategory');
       
       });
       
       
    //     // Category All Route 
       Route::controller(SubCategoryController::class)->group(function(){
           Route::get('/all/subcategory' , 'AllSubCategory');
           Route::get('/add/subcategory' , 'AddSubCategory');
           Route::post('/store/subcategory' , 'StoreSubCategory');
           Route::get('/edit/subcategory/{id}' , 'EditSubCategory');
           Route::post('/update/subcategory' , 'UpdateSubCategory');
           Route::get('/delete/subcategory/{id}' , 'DeleteSubCategory');
       
       });
               // Vendor Active and Inactive All Route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/inactive/vendor' , 'InactiveVendor');
    Route::get('/active/vendor' , 'ActiveVendor');
    Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails');
    Route::post('/active/vendor/approve' , 'ActiveVendorApprove');
    Route::get('/active/vendor/details/{id}' , 'ActiveVendorDetails');
    Route::post('/inactive/vendor/approve' , 'InActiveVendorApprove');
    

});
       
       // Product All Route 
    Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product' , 'AllProduct');
    Route::get('/add/product' , 'AddProduct');
    Route::post('/store/product' , 'StoreProduct');
    Route::get('/edit/product/{id}' , 'EditProduct');
    Route::post('/update/product' , 'UpdateProduct');
    Route::post('/update/product/thambnail' , 'UpdateProductThambnail');
    Route::post('update/product/multiimage' , 'UpdateProductMultiimage');
    Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte');

    Route::get('/product/inactive/{id}' , 'ProductInactive');
    Route::get('/product/active/{id}' , 'ProductActive');
    Route::get('/delete/product/{id}' , 'ProductDelete');
     // For Product Stock
     Route::get('/product/stock' , 'ProductStock');

}); 
   
     // Slider All Route 
Route::controller(SliderController::class)->group(function(){
    Route::get('/all/slider' , 'AllSlider');
    Route::get('/add/slider' , 'AddSlider');
    Route::post('/store/slider' , 'StoreSlider');
    Route::get('/edit/slider/{id}' , 'EditSlider');
    Route::post('/update/slider' , 'UpdateSlider');
    Route::get('/delete/slider/{id}' , 'DeleteSlider');

});

 // Banner All Route 
Route::controller(BannerController::class)->group(function(){
    Route::get('/all/banner' , 'AllBanner');
    Route::get('/add/banner' , 'AddBanner');
    Route::post('/store/banner' , 'StoreBanner');
    Route::get('/edit/banner/{id}' , 'EditBanner');
    Route::post('/update/banner' , 'UpdateBanner');
    Route::get('/delete/banner/{id}' , 'DeleteBanner');

});
// Coupon  All Route
Route::controller(CouponController::class)->group(function(){
    Route::get('/all/coupon' , 'AllCoupon');
    Route::get('/add/coupon' , 'AddCoupon');
    Route::post('/store/coupon' , 'StoreCoupon');
    Route::get('/edit/coupon/{id}' , 'EditCoupon');
    Route::post('/update/coupon' , 'UpdateCoupon');
    Route::get('/delete/coupon/{id}' , 'DeleteCoupon');

}); 
 // Shipping Division All Route 
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision');
    Route::get('/add/division' , 'AddDivision');
    Route::post('/store/division' , 'StoreDivision');
    Route::get('/edit/division/{id}' , 'EditDivision');
    Route::post('/update/division' , 'UpdateDivision');
    Route::get('/delete/division/{id}' , 'DeleteDivision');

}); 
        // Shipping District All Route 
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/district' , 'AllDistrict');
    Route::get('/add/district' , 'AddDistrict');
    Route::post('/store/district' , 'StoreDistrict');
    Route::get('/edit/district/{id}' , 'EditDistrict');
    Route::post('/update/district' , 'UpdateDistrict');
    Route::get('/delete/district/{id}' , 'DeleteDistrict');

}); 


 // Shipping State All Route 
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/state' , 'AllState');
    Route::get('/add/state' , 'AddState');
    Route::post('/store/state' , 'StoreState');
    Route::get('/edit/state/{id}' , 'EditState');
    Route::post('update/state' , 'UpdateState');
    Route::get('delete/state/{id}' , 'DeleteState');

    Route::get('district/ajax/{division_id}' , 'GetDistrict');

}); 

 // Admin Order All Route 
 Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder');
    Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails');

    Route::get('admin/confirmed/order' , 'AdminConfirmedOrder');

    Route::get('/admin/processing/order' , 'AdminProcessingOrder');
 
    Route::get('/admin/delivered/order' , 'AdminDeliveredOrder');

    Route::get('pending-confirm/{order_id}' , 'PendingToConfirm');
    Route::get('confirm-processing/{order_id}' , 'ConfirmToProcess');

   Route::get('processing-delivered/{order_id}' , 'ProcessToDelivered');

  Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload');

}); 
 // Return Order All Route 
 Route::controller(ReturnController::class)->group(function(){
 Route::get('/return/request' , 'ReturnRequest');

  Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved');

  Route::get('/complete/return/request' , 'CompleteReturnRequest');
   

});



 // Report All Route 
 Route::controller(ReportController::class)->group(function(){

    Route::get('/report/view' , 'ReportView');
    Route::post('/search-by-date' , 'SearchByDate');
    Route::post('/search-by-month' , 'SearchByMonth');
    Route::post('/search-by-year' , 'SearchByYear');

    Route::get('/order/by/user' , 'OrderByUser');
    Route::post('/search-by-user' , 'SearchByUser');
 
});
 // Active user and vendor All Route 
 Route::controller(ActiveUserController::class)->group(function(){

    Route::get('all-user' , 'AllUser');
    Route::get('all-vendor' , 'AllVendor');
    
 
});

  
 // Blog Category All Route 
 Route::controller(BlogController::class)->group(function(){

    Route::get('/admin/blog/category' , 'AllBlogCateogry'); 
   
     Route::get('add/blog/category' , 'AddBlogCateogry');
   
     Route::post('/store/blog/category' , 'StoreBlogCateogry');
     Route::get('edit/blog/category/{id}' , 'EditBlogCateogry');
   
     Route::post('update/blog/category' , 'UpdateBlogCateogry');
   
     Route::get('delete/blog/category/{id}' , 'DeleteBlogCateogry');
       
   });

      
//     // Blog Post All Route 
   Route::controller(BlogController::class)->group(function(){
   
    Route::get('/admin/blog/post' , 'AllBlogPost'); 
   
     Route::get('/add/blog/post' , 'AddBlogPost');
   
     Route::post('/store/blog/post' , 'StoreBlogPost');
     Route::get('edit/blog/post/{id}' , 'EditBlogPost');
   
     Route::post('/update/blog/post' , 'UpdateBlogPost');
   
     Route::get('/delete/blog/post/{id}' , 'DeleteBlogPost');
       
    
   });
       
// Admin Reviw All Route 
Route::controller(ReviewController::class)->group(function(){

    Route::get('/pending/review' , 'PendingReview');
    Route::get('/review/approve/{id}' , 'ReviewApprove');
    Route::get('/publish/review' , 'PublishReview'); 
    Route::get('/review/delete/{id}' , 'ReviewDelete');
   });

     // Site Setting All Route 
     Route::controller(SiteSettingController::class)->group(function(){

    Route::get('/site/setting' , 'SiteSetting')->name('site.setting');
    Route::post('/site/setting/update' , 'SiteSettingUpdate')->name('site.setting.update');
   
    Route::get('/seo/setting' , 'SeoSetting')->name('seo.setting');
     Route::post('/seo/setting/update' , 'SeoSettingUpdate')->name('seo.setting.update');
   });



   });
   

       // End Middleware 




/// Frontend Product Details All Route 
       //end Vendor Active and Inactive All Route 
         //start  IndexController
       Route::controller(IndexController::class)->group(function(){
       
        Route::get('/product/details/{id}/{slug}','ProductDetails');
        Route::get('/vendor/details/{id}', 'VendorDetails');
        Route::get('/vendor/all','VendorAll');
        Route::get('/product/category/{id}/{slug}','CatWiseProduct');
        Route::GET('/product/subcategory/{id}/{slug}', 'SubCatWiseProduct');
        // Product View Modal With Ajax
        
        Route::get('/product/view/modal/{id}', 'ProductViewAjax');
    });  
           //start CartController
      /// Add to cart store data

        Route::post('cart/data/store/{id}',[CartController::class,'AddToCart']);

        // Get Data from mini Cart
        Route::get('product/mini/cart', [CartController::class, 'AddMiniCart']);
        
        Route::get('minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
        
        /// Add to cart store data For Product Details Page 
        // Route::post('product/details/{id}/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);
        
        /// Add to Wishlist 

  Route::post('add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
     /// Add to Compare 
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);   

/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);


// Checkout Page Route 
Route::get('/checkout', [CartController::class, 'CheckoutCreate']);
 // Cart All Route 
 Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');

    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');
    

});
// Frontend Blog Post All Route 
Route::controller(BlogController::class)->group(function(){

    Route::get('/blog' , 'AllBlog');  
    Route::get('/post/details/{id}/{slug}' , 'BlogDetails'); 
     Route::get('/post/category/{id}/{slug}' , 'BlogPostCategory');  
    
   });
   // Frontend Blog Post All Route 
    Route::controller(ReviewController::class)->group(function(){

    Route::post('/store/review' , 'StoreReview'); 
    
   });
   
// Search All Route 
Route::controller(IndexController::class)->group(function(){

    Route::post('search' , 'ProductSearch');
    Route::post('search-product' , 'SearchProduct'); 
    
   });
/// User All Route
Route::middleware(['auth','role:user'])->group(function() {

    // Wishlist All Route 
   Route::controller(WishlistController::class)->group(function(){
       Route::get('wishlist' , 'AllWishlist');
       Route::get('get-wishlist-product/' , 'GetWishlistProduct');
       Route::get('wishlist-remove/{id}' , 'WishlistRemove'); 
   
   }); 
    // Compare All Route 
Route::controller(CompareController::class)->group(function(){
    Route::get('compare/' , 'AllCompare');
    Route::get('get-compare-product/' , 'GetCompareProduct');
   Route::get('compare-remove/{id}' , 'CompareRemove'); 
   

});
 // Checkout All Route 
 Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');

    Route::post('/checkout/store' , 'CheckoutStore');
  

});



 // Stripe All Route 
 Route::controller(StripeController::class)->group(function(){
    Route::post('/stripe/order' , 'StripeOrder');
    Route::post('/cash/order' , 'CashOrder');
  

}); 

 // User Dashboard All Route 
 Route::controller(AllUserController::class)->group(function(){
    Route::get('/user/account/page' , 'UserAccount');
    Route::get('/user/change/password' , 'UserChangePassword');
   
    Route::get('/user/order/page' , 'UserOrderPage');
   
    Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
    Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');  
   
    Route::post('/return/order/{order_id}' , 'ReturnOrder');
   
    Route::get('/return/order/page' , 'ReturnOrderPage');
    // Order Tracking 
  Route::get('/user/track/order' , 'UserTrackOrder');
  Route::post('/order/tracking' , 'OrderTracking');
   
   }); 

});
Route::get('admin/login',[AdminController::class,'AdminLogin']);
Route::get('vendor/login',[VendorController::class,'VendorLogin']);
Route::get('become/vendor', [VendorController::class, 'BecomeVendor']);
Route::post('vendor/register', [VendorController::class, 'VendorRegister']);
require __DIR__.'/auth.php';
