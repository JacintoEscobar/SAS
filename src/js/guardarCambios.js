const RESPUESTA_CORRECTA = 'correcta';
const URL = 'http://localhost/sas/controladores/guardarCambiosCuestionario.php';

const bGuaCamb = document.getElementById('guardarCambios');
bGuaCamb.addEventListener('click', () => existenPreguntas());

/**
 * Verificamos que exista al menos una pregunta en el formulario.
*/
const existenPreguntas = () => {
    document.querySelectorAll('#div-pregunta').length > 0 ? existenRespuestas() : alert('Antes de guardar los cambios crear al menos una pregunta.');
};

/**
 * Verificamos que todas las preguntas tengan al menos una respuesta.
 */
const existenRespuestas = () => {
    const divsRespuestas = document.querySelectorAll('#div-respuestas');
    let verificacion = true;
    for (const divRespuesta of divsRespuestas) {
        if (!divRespuesta.hasChildNodes()) {
            verificacion = false;
            break;
        }
    }
    verificacion ? verificarRespCorrect(divsRespuestas) : alert('Antes de guardar los cambios crea al menos una respuesta para cada pregunta.');
};

/**
 * Verifica que para cada pregunta exista una respuesta correcta.
 * @param divsRespuestas arreglo de <div> que contienen las respuestas de cada pregunta.
 */
const verificarRespCorrect = divsRespuestas => {
    // Definimos una bandera para saber si la verificacion fue correcta o hay preguntas sin respuesta correcta.
    let verificacionCorrecta = false;

    // Recorremos todos los <div> que contienen <p> de respuestas.
    for (const divRespuesta of divsRespuestas) {
        // Obtenemos todos los <p> de respuestas de cada pregunta.
        const psRespuestas = divRespuesta.querySelectorAll('#pRespuesta');

        // Definimos una bandera para saber si existe una respuesta correcta para la pregunta actual recorrida.
        let existeRespCorrect = false;

        // Recorremos todos los <p> para verificar que haya uno marcado como respuesta correcta.
        for (const pRespuesta of psRespuestas) {
            // Verificamos que el <p> actual de la respuesta tenga el atributo 'data-tipo' como correcta.
            if (pRespuesta.getAttribute('data-tipo') === RESPUESTA_CORRECTA) {
                existeRespCorrect = true;
                break;
            }
        }

        if (!existeRespCorrect) {
            verificacionCorrecta = false;
            break;
        } else {
            verificacionCorrecta = true;
        }
    }

    verificacionCorrecta ? guardarCambios() : alert('Antes de guardar los cambios elige una respuesta correcta a cada pregunta.');
};

/**
 * Se envia una peticion para registrar en la bd
 * las nuevas preguntas y respuestas del cuestionario.
 */
const guardarCambios = () => {
    // Obtenemos todos los elementos html de las preguntas del cuestionario.
    const divsPreguntas = obtenerPreguntas();

    // Obtenemos el cuestionario.
    const cuestionario = obtenerCuestionario();

    // Pasamos las preguntas a un objeto JSON y pasamos ese JSON a string para su envio.
    const preguntas = getPreguntasJSON(divsPreguntas);

    // Creamos un formData para el envio de los datos.
    const data = construirFormData(cuestionario, preguntas);

    fetch(URL, {
        method: 'POST',
        body: data
    })
        .then(exito => alert('Datos guardados de manera satisfactoria.'), fracaso => alert('Ocurrió un error al guardar los datos.'));
};

/**
 * Almacenamos la informacion de las preguntas html
 * en un objeto json para su envio en la peticion de guardar datos.
 * @param divsPreguntas elementos html <div> de cada pregunta.
 */
const getPreguntasJSON = divsPreguntas => {
    let preguntas = [];
    for (const divPregunta of divsPreguntas) {
        const objPregunta = {};

        const pregunta = divPregunta.querySelector('#pPregunta').textContent;
        objPregunta.pregunta = pregunta;
        objPregunta.respuestas = [];

        const respuestas = divPregunta.querySelectorAll('#pRespuesta');
        for (const respuesta of respuestas) {
            const objRespuesta = {};
            objRespuesta.contenido = respuesta.textContent;
            objRespuesta.tipo = respuesta.getAttribute('data-tipo');
            objPregunta.respuestas.push(objRespuesta);
        }

        preguntas.push(objPregunta);
    }

    return JSON.stringify(preguntas);
};

/**
 * Devuelve todas las preguntas del cuestionario.
 */
const obtenerPreguntas = () => { return document.querySelectorAll('#div-pregunta'); };

/**
 * Devuelve la informacion del cuestionario almacenada como JSON como un objeto.
 */
const obtenerCuestionario = () => { return localStorage.getItem('cuestionario'); };

/**
 * Construimos un formData con las preguntas del cuestionario.
 * @param cuestionario
 * @param preguntas
 */
const construirFormData = (cuestionario, preguntas) => {
    const data = new FormData();
    data.append('cuestionario', cuestionario);
    data.append('preguntas', preguntas);
    return data;
};