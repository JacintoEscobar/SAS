/**
 * Crear y agrega los elments html de las preguntas obtenidas de la bd.
 * @param pregunta Objeto pregunta.
 * @return divRespuestas div donde se agregaran las respuestas.
 */
const addPregunta = pregunta => {
    // Obtenemos el div en donde agregaremos la pregunta.
    const divPreguntas = document.getElementById('div-preguntas');

    /**
        <div id="div-pregunta" data-idPregunta="pregunta.idPregunta">
            <p id="pPregunta">pregunta.pregunta</p>
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
    divPregunta.setAttribute('data-idPregunta', pregunta.idPregunta);
    divPregunta.setAttribute('editado', 'false');

    // Creamos el párrafo que contendrá a la pregunta.
    const pPregunta = document.createElement('p');
    pPregunta.setAttribute('id', 'pPregunta');
    pPregunta.textContent = pregunta.pregunta;

    // Creamos el div donde se encontraras las respuestas.
    const divRespuestas = document.createElement('div');
    divRespuestas.setAttribute('id', 'div-respuestas');

    // Agregamos el botón para editar pregunta
    const bEditPregunta = document.createElement('button');
    bEditPregunta.setAttribute('type', 'button');
    bEditPregunta.setAttribute('id', 'editPregunta');
    bEditPregunta.setAttribute('class', 'btn btn-outline-warning');
    bEditPregunta.textContent = 'Editar pregunta';
    bEditPregunta.addEventListener('click', () => {
        const nuevaPregunta = modificarPregunta();
        if (nuevaPregunta) {
            pPregunta.textContent = nuevaPregunta;
            divPregunta.setAttribute('editado', 'true');
        }
    });

    // Agregamos el boton para eliminar pregunta.
    const bEliPregunta = document.createElement('button');
    bEliPregunta.setAttribute('type', 'button');
    bEliPregunta.setAttribute('id', 'elimPregunta');
    bEliPregunta.setAttribute('class', 'btn btn-outline-danger');
    bEliPregunta.textContent = 'Eliminar Pregunta';
    bEliPregunta.addEventListener('click', () => eliminarPregunta(pregunta.idPregunta, divPregunta));

    // Agregamos los elementos al div principal.
    divPreguntas.appendChild(divPregunta);
    divPregunta.append(pPregunta, divRespuestas, bEditPregunta, bEliPregunta);

    return divRespuestas;
};