<?php

namespace Controllers;

use Model\Tareas;
use Model\Usuarios;
use MVC\Router;

class CitaController
{

    public static function index(Router $router)
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        // Obtener todas las tareas de la base de datos
        $tareasAll = Tareas::all();

        // Renderizar pasando tanto los datos del usuario como el listado
        $router->render('admin/index', [
            "nombre" => $_SESSION['nombre'] ?? '',
            "id" => $_SESSION['id'] ?? null,
            "tareas" => $tareasAll
        ]);
    }

    public static function crearTarea(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Proteger la ruta
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {


            $tarea = new tareas($_POST);
            $tarea->sincronizar($_POST);
            $tarea->usuarioid = $_SESSION['id'];

            $resultado = $tarea->guardar();

            if ($resultado) {
                header('Location: /admin');
                exit;
            }
        }

        // Si necesitas los datos del usuario en la vista 'crear':
        $router->render('admin/crear', [
            'id' => $_SESSION['id'] ?? null
        ]);
    }


 public static function actualizar(Router $router) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 1. Si el usuario envía el formulario (Guardar cambios)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ;
        $tarea = Tareas::find('id',$id);
        if ($tarea) {
            $tarea->sincronizar($_POST);
            $resultado = $tarea->guardar();

            if ($resultado) {
                header('Location: /admin');
                exit;
            }
        }
    }
        

    // 2. Si el usuario entra de manera normal (Ver el formulario)
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /admin');
            exit;
        }

        $tarea = Tareas::find('id',$id);

        // Renderizas la vista pasando el objeto recuperado
        $router->render('admin/actualizar', [
            'tarea' => $tarea
        ]);
    }
}


    public static function Eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            // 1. Obtener el ID que viene desde el FormData de JS
            $id = $_POST['id'] ?? null;

           
     

            if ($id) {
                // 2. Buscar la tarea por su ID
                $tarea = Tareas::find('id',$id);


                // 3. Si la tarea existe, proceder a borrarla
                if ($tarea) {
                    $resultado = $tarea->eliminar(); // Devuelve true o false

                    if ($resultado) {
                        echo "Eliminado";
                        exit;
                    }
                }
            }

            // Si llega aquí es porque algo falló
            echo "Error al intentar eliminar";
            exit;
        }
    }
}
