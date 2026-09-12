<?php

use Controllers\CitaController;
use Model\Tareas;
use PHPUnit\Framework\TestCase;
use MVC\Router;

// 1. Mover el require_once FUERA del método para evitar re-definiciones críticas
require_once __DIR__ . '/../includes/app.php';

class TareaTest extends TestCase
{

    public function test_agregar_tarea()
    {
        // 2. Simular variables de entorno globales
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['PATH_INFO'] = '/crearTarea';
        $_SERVER['REQUEST_URI'] = '/crearTarea';

        $datos = [
            'nombretarea' => 'Prueba de datos',
            'usuarioId' => '1'
        ];

        $router = new Router();
        $router->post('/crearTarea', [CitaController::class, 'crearTarea']);

        $_POST = $datos;

        ob_start();
        $router->comprobarRutas();
        $respuestaDelControlador = ob_get_clean();
    }
}
