// Obtenemos el boton que confirma la creacion de la respuesta.
const bCrearResp = document.getElementById('crearRespuesta');
bCrearResp.addEventListener('click', () => { verificarRespuesta(); });

/**
 * Verifica que el campo de respuesta sea valido para su creacion.
 */
const verificarRespuesta = () => {
    // Obtenemos el input de la respuesta.
    const inpRespuesta = document.getElementById('inpRespuesta');

    if (inpRespuesta.value != '') {
        // Obtenemos todas las preguntas.
        // Buscaremos la pregunta a la que se le asignara la respuesta.
        const pPreguntas = document.querySelectorAll('#pPregunta');

        // Obtenemos el <p> de la pregunta para acceder
        // a su hermano <div> de las respuestas.
        let preguntaSeleccionada = null;
        pPreguntas.forEach(pregunta => {
            if (pregunta.textContent == bCrearResp.getAttribute('data-pregunta-refer')) {
                preguntaSeleccionada = pregunta;
            }
        });

        addRespuesta(inpRespuesta.value, preguntaSeleccionada);
    } else {
        alert('Ingrese la respuesta para continuar.');
    }
};