const modalTitulo = document.getElementById('staticBackdropLabel');
const modalForm = document.getElementsByClassName('modal-body')[0];
const mostrarModalButton = document.getElementById('buttMostrModal');

document.getElementById('addPregunta').addEventListener('click', () => {
    mostrarFormCrearPreg();
    mostrarModalButton.click();
});

/**
 * Crea y agregar los elementos html de la nueva pregunta.
 */
const addPreguntaHHTML = () => {
    const pregunta = verificarNuevaPregunta();
    if (pregunta) {
        const divPreguntas = document.getElementById('div-preguntas');

        // Creamos el div que contendrá la pregunta y sus respuestas.
        const divPregunta = document.createElement('div');
        divPregunta.setAttribute('id', 'div-pregunta');
        divPregunta.setAttribute('data-idPregunta', '');
        divPregunta.setAttribute('editado', 'nueva');

        // Creamos el párrafo que contendrá a la pregunta.
        const pPregunta = document.createElement('p');
        pPregunta.setAttribute('id', 'pPregunta');
        pPregunta.textContent = pregunta.value;

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
            }
        });

        // Agregamos el boton para eliminar pregunta.
        const bEliPregunta = document.createElement('button');
        bEliPregunta.setAttribute('type', 'button');
        bEliPregunta.setAttribute('id', 'elimPregunta');
        bEliPregunta.setAttribute('class', 'btn btn-outline-danger');
        bEliPregunta.textContent = 'Eliminar Pregunta';
        bEliPregunta.addEventListener('click', () => { eliminarPreguntaHTML(divPregunta); });

        // Agregamos el boton para crear respuesta.
        const bAddResp = document.createElement('button');
        bAddResp.setAttribute('type', 'button');
        bAddResp.setAttribute('id', 'addRespuesta');
        bAddResp.setAttribute('class', 'btn btn-outline-primary');
        bAddResp.textContent = 'Agregar respuesta';
        bAddResp.addEventListener('click', () => {
            mostrarFormCrearResp(pPregunta.nextElementSibling);
            mostrarModalButton.click();
        });

        // Agregamos los elementos al div principal.
        divPreguntas.appendChild(divPregunta);
        divPregunta.append(pPregunta, divRespuestas, bAddResp, bEditPregunta, bEliPregunta);

        pregunta.value = '';
    } else {
        alert('Ingrese una pregunta valida.');
    }
};

/**
 * Crea y agregar los elementos html de la nueva respuesta.
 */
const addRespuestaHTML = divRespuestas => {
    const respuesta = verificarNuevaRespuesta();
    if (respuesta) {
        const pRespuesta = document.createElement('p');
        pRespuesta.setAttribute('id', 'pRespuesta');
        pRespuesta.setAttribute('data-idRespuesta', '');
        pRespuesta.setAttribute('data-tipo', 'incorrecta');
        pRespuesta.textContent = respuesta.value;

        divRespuestas.appendChild(pRespuesta);

        pRespuesta.addEventListener('click', () => {
            if (pRespuesta.getAttribute('data-tipo') == 'incorrecta') {
                const respuestasPs = divRespuestas.querySelectorAll('#pRespuesta');

                respuestasPs.forEach(respuestaP => {
                    respuestaP.style.backgroundColor = 'transparent';
                    respuestaP.borderRadius = '0px';
                    respuestaP.style.padding = '0px';
                    respuestaP.setAttribute('data-tipo', 'incorrecta');
                });

                pRespuesta.setAttribute('data-tipo', 'correcta');
                pRespuesta.style.backgroundColor = 'rgba(0, 153, 51, 0.7)';
                pRespuesta.style.borderRadius = '0.3rem';
                pRespuesta.style.padding = '0.4rem';
                pRespuesta.setAttribute('data-tipo', 'correcta');
            }
        });

        respuesta.value = '';
    } else {
        alert('Ingrese una respuesta valida');
    }
};

/**
 * Verificamo la pregunta insertada en el input de crear pregunta.
 */
const verificarNuevaPregunta = () => {
    const nuevaPregunta = document.getElementById('inpPregunta');
    if (nuevaPregunta.value != '')
        return nuevaPregunta
    return false;
}

/**
 * Verificamo la respuesta insertada en el input de crear respuesta.
 */
const verificarNuevaRespuesta = () => {
    const nuevaRespuesta = document.getElementById('inpRespuesta');
    if (nuevaRespuesta.value != '')
        return nuevaRespuesta
    return false;
};

/**
 * Muestra el formulario para crear una nueva pregunta
 */
const mostrarFormCrearPreg = () => {
    modalTitulo.textContent = 'Creación de pregunta';

    modalForm.removeChild(modalForm.lastChild);

    const form = document.createElement('form');
    form.setAttribute('id', 'formCrearPregunta');

    const label = document.createElement('label');
    label.setAttribute('for', 'inpPregunta');
    label.textContent = 'Ingresa la pregunta:';

    const input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'inpPregunta');
    input.setAttribute('id', 'inpPregunta');

    form.append(label, input);
    modalForm.appendChild(form);

    const b = document.getElementsByClassName('modal-footer')[0].querySelector('#modal-confirm');
    if (b != null) {
        document.getElementsByClassName('modal-footer')[0].removeChild(b);
    }

    /* <button id="modal-confirm" type="button" class="btn btn-primary">Aceptar</button> */
    const modalConfirmButton = document.createElement('button');
    modalConfirmButton.setAttribute('id', 'modal-confirm');
    modalConfirmButton.setAttribute('type', 'button');
    modalConfirmButton.setAttribute('class', 'btn btn-primary');
    modalConfirmButton.textContent = 'Aceptar';
    modalConfirmButton.addEventListener('click', addPreguntaHHTML);
    document.getElementsByClassName('modal-footer')[0].appendChild(modalConfirmButton);
};

/**
 * Muestra el formulario para crear una nueva respuesta
 */
const mostrarFormCrearResp = divRespuestas => {
    modalTitulo.textContent = 'Creación de respuesta';

    modalForm.removeChild(modalForm.lastChild);

    const form = document.createElement('form');
    form.setAttribute('id', 'formCrearRespuesta');

    const label = document.createElement('label');
    label.setAttribute('for', 'inpRespuesta');
    label.textContent = 'Ingresa la respuesta:';

    const input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'inpRespuesta');
    input.setAttribute('id', 'inpRespuesta');

    form.append(label, input);
    modalForm.appendChild(form);

    const b = document.getElementsByClassName('modal-footer')[0].querySelector('#modal-confirm');
    document.getElementsByClassName('modal-footer')[0].removeChild(b);
    /* <button id="modal-confirm" type="button" class="btn btn-primary">Aceptar</button> */
    const modalConfirmButton = document.createElement('button');
    modalConfirmButton.setAttribute('id', 'modal-confirm');
    modalConfirmButton.setAttribute('type', 'button');
    modalConfirmButton.setAttribute('class', 'btn btn-primary');
    modalConfirmButton.textContent = 'Aceptar';
    modalConfirmButton.addEventListener('click', () => { addRespuestaHTML(divRespuestas) });
    document.getElementsByClassName('modal-footer')[0].appendChild(modalConfirmButton);
};
