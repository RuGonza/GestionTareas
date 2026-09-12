<?php

namespace tests;


use vendor\PHPUnit\Framework\TestCase;
use Model\Usuarios;
require_once __DIR__ . '/../vendor/autoload.php';

class LoginTest extends TestCase  {

   private Usuario $modeloUsuario;

    // Se ejecuta antes de CADA test para darnos un entorno limpio
    protected function setUp(): void {
        $this->modeloUsuario = new Usuarios();
    }

    // --- TESTS DE REGISTRO ---

    public function testRegistroExitoso(): void {
        $resultado = $this->modeloUsuario->registrar('test@ejemplo.com', 'ClaveSegura123');
        $this->assertTrue($resultado);
    }

    public function testRegistroFallaSiFaltanCampos(): void {
        $resultado = $this->modeloUsuario->registrar('', 'Clave123');
        $this->assertFalse($resultado);
    }

    public function testRegistroFallaSiElEmailYaExiste(): void {
        $this->modeloUsuario->registrar('duplicado@ejemplo.com', 'Clave1');
        
        // Intentar registrar el mismo correo de nuevo
        $resultado = $this->modeloUsuario->registrar('duplicado@ejemplo.com', 'Clave2');
        $this->assertFalse($resultado);
    }

    // --- TESTS DE LOGIN ---

    public function testLoginExitoso(): void {
        // 1. Primero registramos al usuario
        $this->modeloUsuario->registrar('usuario@login.com', 'MiPassword123');

        // 2. Intentamos loguearnos
        $resultado = $this->modeloUsuario->login('usuario@login.com', 'MiPassword123');
        $this->assertTrue($resultado);
    }

    public function testLoginFallaConContrasenaIncorrecta(): void {
        $this->modeloUsuario->registrar('usuario@login.com', 'MiPassword123');

        // Intentar ingresar con una clave incorrecta
        $resultado = $this->modeloUsuario->login('usuario@login.com', 'ClaveEquivocada');
        $this->assertFalse($resultado);
    }

    public function testLoginFallaConUsuarioInexistente(): void {
        // Intentar loguear un usuario que nunca se registró
        $resultado = $this->modeloUsuario->login('no_existo@ejemplo.com', 'Cualquiera');
        $this->assertFalse($resultado);
    }
    
}