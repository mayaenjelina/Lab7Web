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

// 2. Route Modul Artikel (Akses Publik/Tanpa Login)
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// 3. Route Login (User)
$routes->get('user/login', 'User::login');
$routes->post('user/login', 'User::login');
$routes->get('user/logout', 'User::logout'); // Tambahkan ini jika sudah buat fungsi logout

// 4. Grouping Route Admin (WAJIB PAKAI FILTER AUTH)
// Semua URL yang diawali /admin/ akan dicek loginnya di sini
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // localhost:8080/admin/artikel
    $routes->get('artikel', 'Artikel::admin_index');
    
    // localhost:8080/admin/artikel/add
    $routes->add('artikel/add', 'Artikel::add');
    
    // localhost:8080/admin/artikel/edit/(:any)
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    
    // localhost:8080/admin/artikel/delete/(:any)
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

// Matikan AutoRoute agar keamanan lebih terjamin
$routes->setAutoRoute(false);
$routes->get('user/logout', 'User::logout');