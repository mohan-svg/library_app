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
|example.com/class/method/id/
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
$route['default_controller'] = 'Admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = "Admin/index";
$route['admin_signin'] = "Admin/signin_verification";
$route['admin_logout'] = "Admin/logout";	
$route['admin_dashboard'] = "Admin/admin_dashboard";

$route['viewStudents'] = "Admin/allStudentData";

$route['register_student'] = "Admin/register_student";

$route['add_gre_video'] = "Admin/add_new_gre_video";
$route['add_gre_book'] = "Admin/add_new_gre_book";
$route['add_gre_audio'] = "Admin/add_new_gre_audio";

$route['add_gre_videoss'] = "Admin/insert_gre_video";
$route['add_gre_bookss'] = "Admin/insert_gre_book";
$route['add_gre_audioss'] = "Admin/insert_gre_audio";

$route['delete_gre_video'] = "Admin/delete_gre_video";
$route['delete_gre_book'] = "Admin/delete_gre_book";
$route['delete_gre_audio'] = "Admin/delete_gre_audio";

$route['add_ielts_video'] = "Admin/add_new_ielts_video";
$route['add_ielts_book'] = "Admin/add_new_ielts_book";
$route['add_ielts_audio'] = "Admin/add_new_ielts_audio";

$route['add_ielts_videoss'] = "Admin/insert_ielts_video";
$route['add_ielts_bookss'] = "Admin/insert_ielts_book";
$route['add_ielts_audioss'] = "Admin/insert_ielts_audio";

$route['delete_ielts_video'] = "Admin/delete_ielts_video";
$route['delete_ielts_book'] = "Admin/delete_ielts_book";
$route['delete_ielts_audio'] = "Admin/delete_ielts_audio";

$route['add_toefl_video'] = "Admin/add_new_toefl_video";
$route['add_toefl_book'] = "Admin/add_new_toefl_book";
$route['add_toefl_audio'] = "Admin/add_new_toefl_audio";

$route['add_toefl_videoss'] = "Admin/insert_toefl_video";
$route['add_toefl_bookss'] = "Admin/insert_toefl_book";
$route['add_toefl_audioss'] = "Admin/insert_toefl_audio";

$route['delete_toefl_video'] = "Admin/delete_toefl_video";
$route['delete_toefl_book'] = "Admin/delete_toefl_book";
$route['delete_toefl_audio'] = "Admin/delete_toefl_audio";

$route['insert_student'] = "Admin/save_student_data";

$route['getUpdateStudent/:num'] = "Admin/getStudentbyId";
$route['update_student'] = "Admin/update_student_data";

$route['delete_student/:num'] = "Admin/delete_student_data";

$route['get_student'] = "Student/student_get";

$route['get_topics'] = "Admin/fetch_topics";

$route['update_gre_book'] = "Admin/update_gre_book";
$route['update_toefl_book'] = "Admin/update_toefl_book";
$route['update_ielts_book'] = "Admin/update_ielts_book";

$route['update_gre_video'] = "Admin/update_gre_video";
$route['update_toefl_video'] = "Admin/update_toefl_video";
$route['update_ielts_video'] = "Admin/update_ielts_video";

$route['update_gre_audio'] = "Admin/update_gre_audio";
$route['update_toefl_audio'] = "Admin/update_toefl_audio";
$route['update_ielts_audio'] = "Admin/update_ielts_audio";

