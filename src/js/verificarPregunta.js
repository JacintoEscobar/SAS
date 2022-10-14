// Obtenemos el boton que confirma la creacion de la pregunta.
const bCrearPreg = document.getElementById('crearPregunta');
bCrearPreg.addEventListener('click', () => { verificarPregunta() });

/**
 * Verifica que el campo de pregunta sea valido para su creacion.
 */
const verificarPregunta = () => {
    // Obtenemos el input de la pregunta.
    const inpPregunta = document.getElementById('inpPregunta');

    (inpPregunta.value != '') ? addPregunta(inpPregunta.value) : alert('Ingrese la pregunta para continuar.');
};