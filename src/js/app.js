// public/build/js/tareas.js

async function eliminartarea(id) {
    if (!confirm('¿Realmente deseas eliminar esta tarea?')) return;

    try {
        const datos = new FormData();
        console.log(datos.append('id',id));
        datos.append('id', id);

        const respuesta = await fetch('/tareas/eliminar', {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.text();

        if (resultado.trim() === "Eliminado") {
            alert('Tarea eliminada correctamente.');
            window.location.reload(); 
        } else {
            alert('No se pudo eliminar: ' + resultado);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Hubo un error de conexión.');
    }
}

// 🛠️ FUERZA A QUE SEA GLOBAL (Agrega esto al final del archivo)
window.eliminartarea = eliminartarea;



