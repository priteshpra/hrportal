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
$route['default_controller'] = 'admin/usersession/adminlogin';
//$route['default_controller'] 	= 'front/Home';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

$route['admin-login'] 			= "admin/usersession/adminlogin";
$route['admin-forgot-password']	= "admin/usersession/forgotPassword/";
$route['admin-reset-password'] 	= "admin/usersession/resetPassword/";
$route['logout'] 				= "admin/usersession/adminLogout/";
$route['page-expired'] 			= "admin/usersession/pageExpired/";
$route['admin-dashboard'] 		= "admin/admindashboard/index";
$route['change-password'] 		= "admin/usersession/changePassword";
$route['my-profile'] 			= "admin/usersession/myProfile";
$route['edit-my-profile'] 		= "admin/usersession/editMyProfile";

//Company
$route['company-login']             = "company/usersession/companylogin";
$route['company-dashboard'] 		= "company/admindashboard/index";
$route['company-forgot-password']	= "company/usersession/forgotPassword/";
$route['company-reset-password'] 	= "company/usersession/resetPassword/";
$route['company-logout'] 	= "company/usersession/Logout/";
$route['company-page-expired']  = "company/usersession/pageExpired/";
$route['company-change-password'] = "company/usersession/changePassword";
$route['company-profile']  = "company/usersession/myProfile";
$route['company-edit-my-profile']  = "company/usersession/editMyProfile";
$route['company-employee']  = "company/employeedetails/index";

//Mentor
$route['mentor-login']             = "mentor/usersession/adminlogin";
$route['mentor-dashboard'] 		= "mentor/admindashboard/index";
$route['mentor-forgot-password']	= "mentor/usersession/forgotPassword/";
$route['mentor-reset-password'] 	= "mentor/usersession/resetPassword/";
$route['mentor-logout'] 				    = "mentor/usersession/adminLogout/";
$route['mentor-page-expired'] 			    = "mentor/usersession/pageExpired/";
$route['mentor-change-password'] 		    = "mentor/usersession/changePassword";
$route['mentor-profile'] 			    = "mentor/usersession/myProfile";
$route['mentor-edit-my-profile'] 		    = "mentor/usersession/editMyProfile";
