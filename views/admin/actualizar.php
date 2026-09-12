<h1 class="nombre-pagina">Actualizar Tarea</h1>
<p class="descripcion-pagina">Formualario de  Actualizar Tarea</p>

<form action="/admin/actualizar"  class="formulario"  method="POST">
         <div class="campo">
        <label for="nombreTarea">Nombre de la Tarea</label>
        <input 
            type="text" 
            id="nombretarea" 
            name="nombretarea" 
            placeholder="Escribe la tarea"
            value="<?php echo  $tarea->nombretarea ?>"
        >
       <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
    </div>
    <input type="submit" value="Actualizar Tarea" class="boton">
</form>
