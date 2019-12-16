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
$route['default_controller'] = 'mainController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'LoginController';
$route['student'] = 'studentController';
$route['student/logout'] = 'studentController/logout';

$route['admin'] = 'adminLoginController';
$route['admin/dashboard'] = 'adminController';
$route['admin/admins'] = 'adminController/admins';
$route['admin/teachers'] = 'adminController/teachers';
$route['admin/students'] = 'adminController/students';
$route['admin/parents'] = 'adminController/parents';
$route['admin/subjects'] = 'adminController/subjects';
$route['admin/gradings'] = 'adminController/gradings';
$route['admin/school-years'] = 'adminController/schoolYear';
$route['admin/subject-teachers'] = 'adminController/subjectTeachers';
$route['admin/subject-teachers/students/(:num)'] = 'adminController/subjectStudents/$1';
$route['admin/parents/students/(:num)'] = 'adminController/parentStudents/$1';
$route['admin/profile'] = 'adminController/profile';
$route['admin/logout'] = 'adminController/logout';

$route['teacher'] = 'teacherLoginController';
$route['teacher/dashboard'] = 'teacherController';
$route['teacher/profile'] = 'teacherController/profile';
$route['teacher/subjects'] = 'teacherController/subjects';
$route['teacher/subjects/criterias/(:num)'] = 'teacherController/subjectCriterias/$1';
$route['teacher/subjects/students/(:num)'] = 'teacherController/subjectStudents/$1';
$route['teacher/subjects/criterias/scores/(:num)'] = 'teacherController/criteriaScores/$1';
$route['teacher/subjects/students/sheet/(:num)/(:num)'] = 'teacherController/studentSheet/$1/$2';
$route['teacher/logout'] = 'teacherController/logout';
