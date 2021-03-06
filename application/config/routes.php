<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['maintainance'] = 'maintainance/index';
$route['about-us'] = 'home/about_us';
$route['save-order'] = 'user/save_order';
$route['save_order_developer'] = 'user/save_order_developer';
$route['payment-status/(:any)'] = 'user/payment_status/$1';
$route['contact-us'] = 'home/contact_us';
$route['privacy-policy'] = 'home/privacy';
$route['terms-condition'] = 'home/terms';
$route['returns-refunds'] = 'home/refund';
$route['login-register'] = 'home/login';
$route['login']['post'] = 'home/login_post';
$route['signup']['post'] = 'home/signup';
$route['my-account'] = 'user/my_account';
$route['logout'] = 'user/logout';
$route['prod-info'] = 'home/prod_info';
$route['add-wishlist'] = 'home/add_wishlist';
$route['wishlist'] = 'user/wishlist';
$route['cart'] = 'user/cart';
$route['add-cart'] = 'home/add_cart';
$route["update-cart"] = "user/update_cart";
$route["cart-delete"] = "user/cart_delete";
$route["wish-delete"] = "user/wish_delete";
$route["checkout"]['get'] = "user/checkout";
$route["checkout"]['post'] = "user/checkout_post";
$route["check-code"] = "user/check_code";
$route["payment"] = "user/payment";
$route['invoice/(:num)'] = 'user/invoice/$1';
$route['cancel']['post'] = 'user/cancel';
$route['return']['post'] = 'user/return';
$route['update-profile']['post'] = 'user/update_profile';
$route['otp']['post'] = 'home/otp';
$route['forgot-password'] = 'home/forgot_password';
$route['change-password'] = 'home/change_password';
$route['sitemap'] = 'home/sitemap';
$route['check-pincode'] = 'home/verify_pincode';
$route['reviews/(:num)/(:num)'] = 'home/reviews/$1/$2';
/* $route['(:any)(/:any)?(/:any)?'] = 'home/product_list/$1$2$3';
$route['(:any)/(:any)/(:any)/(:any)'] = 'home/product/$1/$2/$3/$4'; */
$route['blog/(:any)'] = 'home/blog/$1';
$route['blogs/(:any)(/:any)?(/:any)?(/:any)?'] = 'blogs/blogs_list/$1$2$3$4';
$route['(:any)(/:any)?(/:any)?(/:any)?'] = 'home/product_list/$1$2$3$4';
$route['(:any)/(:any)/(:any)/(:any)/(:any)'] = 'home/product/$1/$2/$3/$4/$5';