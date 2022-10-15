/**
 * Obtenemos el cuestionario seleccionado.
 */
window.onload = () => {
    document.getElementById('titulo-cuestionario').textContent = JSON.parse(localStorage.getItem('cuestionario')).titulo;
    document.getElementById('descripcion-cuestionario').textContent = JSON.parse(localStorage.getItem('cuestionario')).descripcion;
};