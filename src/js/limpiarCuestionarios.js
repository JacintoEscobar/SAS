/**
 * Elimina los elementos html de los cuestionarios
 * para poder actualizarlos despues de una modificacion
 * a la base de datos.
 */
const limpiarCuestionarios = () => {
    const divCuestionarios = document.getElementById('cuestionarios');
    let cuestionario;
    while (cuestionario = document.getElementById('cardCuestionario')) {
        divCuestionarios.removeChild(cuestionario);
    }
    divCuestionarios.removeChild(divCuestionarios.lastChild);
};