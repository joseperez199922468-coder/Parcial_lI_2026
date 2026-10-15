<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('editoriales', 'EditorialesController::index');
$routes->get('editoriales/nueva', 'EditorialesController::nueva');
$routes->post('editoriales/crear', 'EditorialesController::crear');
$routes->get('editoriales/editar/(:num)', 'EditorialesController::editar/$1');
$routes->post('editoriales/actualizar/(:num)', 'EditorialesController::actualizar/$1');
$routes->post('editoriales/eliminar/(:num)', 'EditorialesController::eliminar/$1');
