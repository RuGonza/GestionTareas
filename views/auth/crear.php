<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">LLena el siguiente formulario para crear una cuenta</p>

<form action="/crear-cuenta"  class="formulario"  method="POST">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            placeholder="Tu Nombre"
        >
    </div>
    
      <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            placeholder="Tu Email"
        >
    </div>
 <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="pass" 
            id="password" 
            placeholder="Tu password"
        >
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
</form>
