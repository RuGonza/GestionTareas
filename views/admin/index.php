<h1 class="titulo">Adminstrador</h1>

<div class="boton-secundario">
    <a href="/crearTarea">Agregar Tarea</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
             <th>Tarea</th>
             <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    
        <?php foreach($tareas as $t) {?>
        <tr>
            <td><?php echo $t->id ?></td>
            <td><?php echo $t->nombretarea ?></td>
            <td>
                 <a href="/admin/actualizar?id=<?php echo $t->id; ?>" class="btn btn-edit">Editar</a>
                <button class="btn btn-delete" onclick="eliminartarea('<?php echo $t->id; ?>')">Eliminar</button>
    
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<?php 
    $script = "
        <script src='/build/js/app.js'></script>
    ";
?>