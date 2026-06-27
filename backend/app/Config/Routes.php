<?php

use CodeIgniterRouterRouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Page::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:segment)', 'Artikel::detail/$1');
$routes->get('/kategori/(:segment)', 'Artikel::kategori/$1');
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->get('artikel/add', 'Artikel::add');
    $routes->post('artikel/add', 'Artikel::add');
    $routes->get('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->post('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});

$routes->post('/api/auth/login', 'ApiAuth::login');
$routes->post('/api/auth/logout', 'ApiAuth::logout');

$routes->group('', ['filter' => 'apiAuth'], static function ($routes) {
    $routes->get('/post', 'ApiArtikel::index');
    $routes->get('/post/(:num)', 'ApiArtikel::show/$1');
    $routes->post('/post', 'ApiArtikel::create');
    $routes->put('/post/(:num)', 'ApiArtikel::update/$1');
    $routes->delete('/post/(:num)', 'ApiArtikel::delete/$1');
});
