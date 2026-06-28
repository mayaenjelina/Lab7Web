<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. Route Halaman Utama & Statis
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos', 'Page::tos');

// 2. Route API Post — GET boleh tanpa token, POST/PUT/DELETE wajib token
$routes->get('post', 'Api\Post::index');
$routes->get('post/(:segment)', 'Api\Post::show/$1');
$routes->post('post', 'Api\Post::create', ['filter' => 'apiauth']);
$routes->put('post/(:segment)', 'Api\Post::update/$1', ['filter' => 'apiauth']);
$routes->delete('post/(:segment)', 'Api\Post::delete/$1', ['filter' => 'apiauth']);

// 3. Route Modul Artikel (Akses Publik/Tanpa Login)
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// 4. Route Login & Logout (User)
$routes->get('user/login', 'User::login');
$routes->post('user/login', 'User::login');
$routes->get('user/logout', 'User::logout'); 

// 5. Route Modul Admin (Memerlukan Login / Filter Auth)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel', 'Artikel::admin_index', ['as' => 'admin_artikel']);
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
    $routes->post('artikel/add_kategori', 'Artikel::add_kategori');
    $routes->post('artikel/add_kategori_cepat', 'Artikel::add_kategori_cepat');
    $routes->get('artikel/delete_kategori/(:num)', 'Artikel::delete_kategori/$1');
});

// Menonaktifkan Auto Routing demi keamanan
$routes->setAutoRoute(false);