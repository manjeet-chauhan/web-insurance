<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|	
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// --------------- front end ----------------



// $route['logout']='home/logout';
// //$route['admin-login-authentication']='home/login';
// $route['admin-login-authentication'] = 'login/Auth/authenticateAdminLogin';
// $route['admin-signup-authentication'] = 'login/Auth/authenticateAdminSignup';
// $route['admin-request-reset-password'] = 'login/Auth/reset-passsword';
// $route['admin-request-for-reset-password-resend'] = 'login/Auth/requestResetPasswordResendMail';
// $route['login']='home/login';
// $route['reset-passsword']='login/Auth/forget_password';
// $route['request-reset']='login/Auth/requestResetPassword';

 

// -------------- Admin Backend -----------

$route['admin'] = 'login/auth/login';
$route['admin/login'] = 'login/auth/login';
$route['admin/login-admin'] = 'login/auth/login_admin';
$route['admin/logout'] = 'login/auth/logout';




$route['admin/dashboard'] = 'admin/admin/all_users';
$route['admin/CSV-Data'] = 'admin/admin/csv_data';
$route['admin/CSV-Data/(:any)'] = 'admin/admin/csv_data/$1';
$route['admin/view-CSV-Data/(:any)/(:any)'] = 'admin/admin/view_csv_data/$1/$2';

$route['admin/CSV-Format'] = 'admin/admin/csv_format';
$route['admin/CSV-Format/(:any)'] = 'admin/admin/csv_format/$1';

$route['admin/add-comapny'] = 'admin/admin/add_company';
$route['admin/remove-company'] = 'admin/admin/remove_company';

$route['admin/add-csv-format'] = 'admin/admin/add_csv_format';
$route['admin/save-csv-format'] = 'admin/admin/save_csv_format';


$route['admin/Landing-page-setting'] = 'admin/admin/landing_page';
$route['admin/save-page-setting'] = 'admin/admin/save_page_setting';










$route['admin/profile'] = 'login/auth/admin_profile';
$route['admin/update-profile'] = 'login/auth/update_profile';
$route['admin/change-password'] = 'login/auth/admin_change_password';
$route['admin/update-password'] = 'login/auth/admin_update_password';

$route['admin/saloon-profile/(:any)/(:any)'] = 'admin/admin/saloon_users_profile/$1/$2';
$route['admin/user-profile/(:any)/(:any)'] = 'admin/admin/users_profile/$1/$2';





$route['admin/all-users'] = 'admin/admin/all_users';
$route['admin/users'] = 'admin/admin/users';
$route['admin/sallons'] = 'admin/admin/sallon';
// $route['admin/profile/(:any)/(:any)'] = 'admin/admin/users_profile/$1/$2';
$route['admin/users-enable'] = 'admin/admin/users_enabled';
$route['admin/users-status'] = 'admin/admin/users_status';
$route['admin/edit-profile/(:any)/(:any)'] = 'admin/admin/edit_users_profile/$1/$2';
$route['admin/save-profile'] = 'admin/admin/save_users_profile';
$route['admin/users-delete-account'] = 'admin/admin/users_delete_account';
$route['admin/delete-sallon-img'] = 'admin/admin/delete_sallon_img';


$route['admin/category'] 		= 'admin/admin/category';
$route['admin/subcategory'] 	= 'admin/admin/subcategory';
$route['admin/service'] 		= 'admin/admin/service';
$route['admin/add'] 			= 'admin/admin/addCategory';
$route['admin/edit'] 			= 'admin/admin/editCategory';

$route['admin/addsub'] 			= 'admin/admin/addsubCategory';
$route['admin/editsub'] 		= 'admin/admin/editsubCategory';


$route['admin/booking']         = 'admin/admin/userBooking';
$route['admin/offline_booking']         = 'admin/admin/userOfflineBooking';
$route['admin/booking-detail/(:any)'] = 'admin/admin/bookingDetail/$1';
$route['admin/payment-list'] 	= 'admin/admin/payment';
//$route['admin/order'] 			= 'admin/admin/order';

$route['admin/booking-detail-csv/(:any)'] = 'admin/admin/bookingDetailCSV/$1';



$route['admin/size-delete']    = 'admin/admin/size_delete';
$route['admin/size-status']    = 'admin/admin/size_status';

$route['admin/container-status'] = 'admin/admin/container_status';
$route['admin/container-delete'] = 'admin/admin/container_delete';

$route['admin/subcat-status'] = 'admin/admin/subcat_status';
$route['admin/subcat-delete'] = 'admin/admin/subcat_delete';

$route['admin/service-status'] = 'admin/admin/service_status';
$route['admin/service-delete'] = 'admin/admin/service_delete';



$route['admin/saloon-transaction-history/(:any)/(:any)'] = 'admin/admin/saloon_transaction_history/$1/$2';
$route['admin/user-transaction-history/(:any)/(:any)'] = 'admin/admin/user_transaction_history/$1/$2';



// $route['admin/order'] = 'admin/admin/order';










