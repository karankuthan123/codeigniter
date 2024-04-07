<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/login', 'Home::loginPost');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Home::registerPost');
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->post('/basvur', 'Home::basvur');

$routes->get('/admin/login', 'Admin::login');

$routes->get('/admin/dashboard', 'Admin::index', ['filter' => 'admin']);
$routes->get('/admin/exam', 'Admin::exam', ['filter' => 'admin']);
$routes->get('/admin/pending', 'Admin::pending', ['filter' => 'admin']);
$routes->post('/admin/addexam', 'Admin::addExam', ['filter' => 'admin']);
$routes->post('/admin/getexam', 'Admin::getExam', ['filter' => 'admin']);
$routes->post('/admin/changeexamrole', 'Admin::changeExamRole', ['filter' => 'admin']);
$routes->post('/admin/removeexam', 'Admin::removeExam', ['filter' => 'admin']);
$routes->get('/admin/exam/(:num)', 'Admin::examDetail/$1', ['filter' => 'admin']);
$routes->post('/admin/changestate', 'Admin::changeState', ['filter' => 'admin']);
