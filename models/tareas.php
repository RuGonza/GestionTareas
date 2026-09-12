<?php
namespace Model;

class Tareas extends ActiveRecord {
    protected static $tabla = 'tareas';
    
   
    protected static $columnasDB = ['id', 'nombretarea', 'usuarioid'];

    public $id;
    public $nombretarea;
    public $usuarioid;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        
        $this->nombretarea = $args['nombretarea'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }
}

