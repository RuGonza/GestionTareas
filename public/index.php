<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\CitaController;
use Controllers\LoginController;
use MVC\Router;
$router = new Router();

// En tu index.php
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Deja solo esto en tu index.php
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

//rutas  privadas
$router->get('/admin',[CitaController::class,'index']);
$router->get('/crearTarea',[CitaController::class,'crearTarea']);
$router->post('/crearTarea',[CitaController::class,'crearTarea']); 
//metodos para actualizar los datos
// Cambia 'atualizar' por 'actualizar'
$router->get('/admin/actualizar', [CitaController::class, 'actualizar']);
$router->post('/admin/actualizar', [CitaController::class, 'actualizar']);

//eliminar la tarea
$router->post('/tareas/eliminar',[CitaController::class,'Eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();