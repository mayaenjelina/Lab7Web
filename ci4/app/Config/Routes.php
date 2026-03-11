<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route bawaan untuk halaman utama
$routes->get('/', 'Home::index');

// Route untuk halaman statis (Page)
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos', 'Page::tos');

// Route untuk modul Artikel (User/Public) [cite: 112, 201]
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// Grouping Route untuk Menu Admin 
$routes->group('admin', function($routes) {
    // URL: localhost:8080/admin/artikel 
    $routes->get('artikel', 'Artikel::admin_index');
    
    // URL: localhost:8080/admin/artikel/add [cite: 285]
    $routes->add('artikel/add', 'Artikel::add');
    
    // URL: localhost:8080/admin/artikel/edit/{id} [cite: 286]
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    
    // URL: localhost:8080/admin/artikel/delete/{id} [cite: 287]
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

// Sebaiknya matikan AutoRoute jika semua rute sudah didefinisikan secara manual
$routes->setAutoRoute(false);