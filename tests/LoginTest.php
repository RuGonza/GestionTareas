<?php

namespace tests;

use Controllers\LoginController;
use Model\Usuarios;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use MVC\Router;

class LoginTest extends TestCase
{
    // #[RunInSeparateProcess]
     public function test_user_register_pasando_argumentos() 
     {
         require_once __DIR__ . '/../includes/app.php'; 

         $password = "123456789";
         $_SERVER['REQUEST_METHOD'] = 'POST';
         $_SERVER['REQUEST_URI'] = '/crear-cuenta';

         // CORREGIDO: Cambiamos 'name' por 'nombre'
         $_POST = [
             'nombre'   => "Prueba", 
             'email'    => "prueba@prueba.com",
             'pass' => $password
         ];

         $router = new Router();
         $router->post('/crear-cuenta', [LoginController::class, 'crear']);

         register_shutdown_function(function() {
             $user = Usuarios::where('email', 'prueba@prueba.com');
             $this->assertNotNull($user, "El usuario no se guardó en la base de datos.");
         });
         ob_start();
         $router->comprobarRutas(); 
         ob_get_clean();
     }

       #[RunInSeparateProcess] // Asegúrate de tener este atributo arriba del método
    public function test_user_login_pasando_argumentos() 
    {
        require_once __DIR__ . '/../includes/app.php'; 

        $password = "123456789";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/login'; 

        $_POST = [
            'email'    => "prueba@prueba.com",
            'password' => $password
        ];

        $router = new Router();
        $router->post('/login', [LoginController::class, 'login']);

        // 1. Ejecutamos el router atrapando cualquier salida de texto de la vista
        ob_start();
        $router->comprobarRutas(); 
        ob_get_clean();

        // 2. LA ASERCIÓN VA AQUÍ DIRECTAMENTE (Fuera del shutdown)
        // Buscamos al usuario por su email para verificar que existe en la DB
        $usuario = Usuarios::where('email', 'prueba@prueba.com');
        
        // Si tu ActiveRecord devuelve un array, asegúrate de tomar el primer índice o verificar que no esté vacío
        if (is_array($usuario)) {
            $this->assertNotEmpty($usuario, "El usuario de login no fue encontrado.");
        } else {
            $this->assertNotNull($usuario, "El usuario de login no fue encontrado.");
        }
    }

}
