<h1 class="nombre-pagina">Crear Tarea</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para crear una Tarea</p>

<form action="/crearTarea"  class="formulario"  method="POST">
         <div class="campo">
        <label for="nombreTarea">Nombre de la Tarea</label>
        <input 
            type="text" 
            id="nombretarea" 
            name="nombretarea" 
            placeholder="Escribe la tarea"
        >
    </div>
    <input type="submit" value="Guardar Tarea" class="boton">
</form>
