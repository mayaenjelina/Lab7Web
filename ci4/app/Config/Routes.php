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

$routes->resource('post');

// 2. Route Modul Artikel (Akses Publik/Tanpa Login)
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// 3. Route Login & Logout (User)
$routes->get('user/login', 'User::login');
$routes->post('user/login', 'User::login');
$routes->get('user/logout', 'User::logout'); 

// 4. Route Modul Admin (Memerlukan Login / Filter Auth)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Jalur utama admin artikel (Gunakan rute ini untuk load halaman awal dan request AJAX)
    $routes->get('artikel', 'Artikel::admin_index', ['as' => 'admin_artikel']);
    
    // Fitur Kelola Artikel
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
    
    // Fitur Kelola Kategori
    $routes->post('artikel/add_kategori', 'Artikel::add_kategori');
    $routes->post('artikel/add_kategori_cepat', 'Artikel::add_kategori_cepat');
    $routes->get('artikel/delete_kategori/(:num)', 'Artikel::delete_kategori/$1');
});

// Menonaktifkan Auto Routing demi keamanan
$routes->setAutoRoute(false);

// 5. Route Tambahan untuk Eksperimen AJAX Lainnya (Jika Diperlukan)
$routes->get('ajax', 'AjaxController::index');
$routes->get('ajax/getData', 'AjaxController::getData');
$routes->delete('ajax/delete/(:num)', 'AjaxController::delete/$1');

