<?php

namespace tests;

use Controllers\LoginController;
use Model\Usuarios;
use PHPUnit\Framework\TestCase;
use MVC\Router;

class LoginTest extends TestCase
{
    // Este método se ejecuta AUTOMÁTICAMENTE antes de arrancar el test
    protected function setUp(): void
    {
        parent::setUp();
        
        // REQUERIR LA BASE DE DATOS Y AYUDAS DE TU PROYECTO
        // Ajusta las rutas '../' según dónde esté tu carpeta 'includes' o 'config'
        require_once __DIR__ . '/../includes/app.php'; 
        // Si no tienes app.php, intenta requiriendo directamente tu archivo de conexión:
        // require_once __DIR__ . '/../includes/database.php';
    }

    public function test_user_register_pasando_argumentos() 
    {
        $password = "123456789";

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/crear-cuenta';

        $_POST = [
            'name'     => "Prueba",
            'email'    => "prueba@prueba.com",
            'password' => $password
        ];

        $router = new Router();
        $router->post('/crear-cuenta', [LoginController::class, 'crear']);

        register_shutdown_function(function() {
            $codigoStatus = http_response_code();
            $this->assertEquals(200, $codigoStatus, "El código de respuesta no es el esperado.");

            // Ahora que la DB está conectada en setUp(), esto no dará error:
            $user = Usuarios::where('email', 'prueba@prueba.com')->first();
            $this->assertNotNull($user, "El usuario no se guardó en la base de datos.");
        });

        ob_start();
        $router->comprobarRutas(); 
        ob_get_clean();
    }
}
