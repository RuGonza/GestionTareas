<?php

namespace Model;

use Model\ActiveRecord;

class Usuarios extends ActiveRecord
{

    protected static $tabla = "usuarios";
    protected static $columnasDB = ['id', 'nombre', 'email', 'pass'];

    public $id;
    public $nombre;
    public $email;
    public $pass;


    public function __construct($args = [])
    {
        $this->id = $argc['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->pass = $args['pass'] ?? null;
    }

    public function validarCuenta()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El email es Obligatorio";
        }
        if (!$this->pass) {
            self::$alertas['error'][] = "El pass es Obligatorio";
        }

        return self::$alertas;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El E-mail es Obligatorio";
        }
        return self::$alertas;
    }

    public function validarpass()
    {
        if (!$this->pass) {
            self::$alertas['error'][] = "La contraseña es Obligatorio";
        }
        return self::$alertas;
    }

    public function existeUsuario()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas["error"][] = "El usuario ya esta registrado";
        }

        return  $resultado;
    }

      public function hashPassword(){
        $this->pass = password_hash($this->pass, PASSWORD_BCRYPT);
    }

  
  public function comprobarPassword($password = "") {
        $resultado =  password_verify($password,$this->pass);
        if(!$resultado || !$this->confirmado) {
                self::$alertas["error"][] = "Password Incorrecto o tu cuenta no ha sido confirmada";
        } else {
            return true;
        }
 }
}
