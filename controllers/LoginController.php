<?php


namespace Controllers;

use Model\Usuarios;
use MVC\Router;

class LoginController
{
    public static function login(Router $router) {
    
    
        $auth = new Usuarios;

        if($_SERVER['REQUEST_METHOD'] ===  "POST"){
             $auth = new Usuarios($_POST);
             $alertas = $auth->validarCuenta();
             if(empty($alertas)) {
                $usuario = Usuarios::find('email',$auth->email);
                if($usuario) {
                    $usuario->comprobarPassword($auth->pass);
                    session_start();
                     $_SESSION['id'] = $usuario->id;
                     $_SESSION['nombre'] = $usuario->nombre;
                     $_SESSION['email'] = $usuario->email;
                     $_SESSION['login'] = true;

                    //refirecionamos
                     header('Location: /admin');
                }
             } 
        }
      
         $router->render('auth/login',[
            'auth' => $auth
         ]);
    }

    public static function crear(Router $router){
        $usuario = new Usuarios;
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
                 $usuario->sincronizar($_POST);


        
                $alertas = $usuario->validarCuenta();
                if(empty($alertas)) {
                    $resultado = $usuario->existeUsuario();
                    if($resultado->num_rows) {
                        $alertas = Usuarios::getAlertas();
                    } else {
                        $usuario->hashPassword();
                    
                        $resultado = $usuario->guardar();
                        if($resultado) {
                            header("location: /");
                        }
                    }
                }
                
        }
        $router->render('auth/crear',[
            'usuario' => $usuario
        ]);
    }

     public static function logout()
    {
        echo "Serrar Sesíon";
    }

   
}
