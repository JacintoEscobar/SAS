/**
 * Crear y agrega los elments html de las preguntas.
 * @param pregunta Cadena de texto de la pregunta.
 */
const addPregunta = pregunta => {
    // Obtenemos el div en donde agregaremos la pregunta.
    const divPreguntas = document.getElementById('div-preguntas');

    /**
        <div id="div-pregunta">
            <p id="pPregunta">Pregunta?</p>
            <div id="div-respuestas">
                <p id="pRespuesta">Respuesta1</p>
                <p id="pRespuesta">Respuesta2</p>
            </div>
            <button type="button" id="addRespuesta">Agregar respuesta</button>
        </div>
    */

    // Creamos el div que contendrá la pregunta y sus respuestas.
    const divPregunta = document.createElement('div');
    divPregunta.setAttribute('id', 'div-pregunta');

    // Creamos el párrafo que contendrá a la pregunta.
    const pPregunta = document.createElement('p');
    pPregunta.setAttribute('id', 'pPregunta');
    pPregunta.textContent = pregunta;

    // Creamos el div donde se encontraras las respuestas.
    const divRespuestas = document.createElement('div');
    divRespuestas.setAttribute('id', 'div-respuestas');

    // Agregamos el botón para agregar respuestas a la pregunta.
    const bAddRespuesta = document.createElement('button');
    bAddRespuesta.setAttribute('type', 'button');
    bAddRespuesta.setAttribute('id', 'addRespuesta');
    bAddRespuesta.setAttribute('class', 'btn btn-outline-success');
    bAddRespuesta.textContent = 'Agregar respuesta';
    bAddRespuesta.addEventListener('click', () => {
        document.getElementById('crearRespuesta').setAttribute('data-pregunta-refer', pregunta);
        document.getElementById('mostrarFormCrearResp').click()
    });

    // Agregamos los elementos al div principal.
    divPreguntas.appendChild(divPregunta);
    divPregunta.append(pPregunta, divRespuestas, bAddRespuesta);

    // Limpiamos el campo de pregunta por si el usuario desea agregar otra mas.
    document.getElementById('inpPregunta').value = '';
};