/**
 * Obtenemos el cuestionario seleccionado.
 */
window.onload = () => {
    cuestionario = JSON.parse(localStorage.getItem("cuestionario"));
    document.getElementById('titulo-cuestionario').textContent = cuestionario.titulo;
    document.getElementById('descripcion-cuestionario').textContent = cuestionario.descripcion;
};