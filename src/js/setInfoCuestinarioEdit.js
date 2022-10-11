/**
 * Asignamos a los campos del formulario los datos
 * del cuestionario seleccionado para editar.
 */
window.onload = () => {
    // Obtenemos los campos del cuestionario.
    const inputTit = document.getElementById('titulo');
    const inputTDesc = document.getElementById('descripcion');
    const inputTip = document.getElementById('tipo');

    // Obtenemos el formulario del local storage.
    const cuestionario = JSON.parse(localStorage.getItem('cuestionario'));

    // Asignamos los datos al formulario.
    inputTit.value = cuestionario.titulo;
    inputTDesc.value = cuestionario.descripcion;
    inputTip.value = cuestionario.tipo;

    // Obtenemos el boton de editar cuestionario
    // y asignamos el id del mismo para identificarlo.
    document.getElementById('editar').setAttribute('data-id', cuestionario.idCuestionario);
};