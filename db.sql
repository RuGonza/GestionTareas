create database gestionTareas;

use gestionTareas;

CREATE TABLE usuarios(
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(30) NULL,
    email VARCHAR(60) NOT NULL,
    pass VARCHAR(30) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE tareas(
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombretarea VARCHAR(200) NULL,
    usuarioid INT(11) NOT NULL unique, 
    PRIMARY KEY(id),
    CONSTRAINT fk_usuario_tarea FOREIGN KEY (usuarioid) REFERENCES usuarios(id) ON DELETE CASCADE
);