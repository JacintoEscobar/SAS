const bGuardarCambios = document.getElementById('guardarCambios');
bGuardarCambios.addEventListener('click', () => {
    if (verificarPreguntas()) {
        if (verificarRespuestas()) {
            if (verificarRespuestasCorrectas()) {
                guardarCambios();
            } else {
                alert('Antes de guardar tus cambios, asigna al menos una pregunta correcta para cada pregunta.');
            }
        } else {
            alert('Antes de guardar tus cambios, crea al menos una respuesta para cada pregunta.');
        }
    } else {
        alert('Antes de guardar tus cambios, crea al menos una pregunta para el cuestionario.');
    }
});

/**
 * Verifica que haya al menos una pregunta en el cuestionario.
 * @return false si no hay inguna pregunta.
 */
const verificarPreguntas = () => {
    const divPreguntas = document.getElementById('div-preguntas');
    return divPreguntas.hasChildNodes();
};

/**
 * Verifica que todas las preguntas tengan una respuesta correcta.
 * @return false si hay preguntas sin respuestas.
 */
const verificarRespuestas = () => {
    const divsRespuestas = document.querySelectorAll('#div-respuestas');
    for (const divRespuestas of divsRespuestas) {
        if (!divRespuestas.hasChildNodes()) {
            return false;
        }
    }
    return true;
};

/**
 * Verifica que cada div de respuestas tenga una respuesta correcta.
 * @return false si hay preguntas sin respuesta correcta.
 */
const verificarRespuestasCorrectas = () => {
    const divsRespuestas = document.querySelectorAll('#div-respuestas');
    for (const divRespuestas of divsRespuestas) {
        const psRespuestas = divRespuestas.querySelectorAll('#pRespuesta');
        let rCorrecta = false;
        for (const pRespuesta of psRespuestas) {
            if (pRespuesta.getAttribute('data-tipo') == 'correcta') {
                rCorrecta = true;
            }
        }
        if (!rCorrecta) { return false; }
    }
    return true;
};

/**
 * 
 */
const guardarCambios = () => {
    // Primero obtenemos las preguntas nuevas.
    const preguntasNuevas = getPreguntasNuevasObj(getPreguntasNuevas());

    // Obtenemos las preguntas que se modificaron.
    const preguntasEditadas = getPreguntasEditadasObj(getPreguntasEditadas());

    const dataPreguntasNuevas = createDataPreguntasNuevas(preguntasNuevas);
    fetch('http://localhost/sas/controladores/addPreguntas.php', {
        method: 'POST',
        body: dataPreguntasNuevas
    })
        .then(response => { return response.json(); })
        .then(data => { alert(data['EXITO']); window.location.href = 'http://localhost/sas/vistas/CuestionarioContenido.php' });

    const dataPreguntasEditadas = createDataPreguntasEditadas(preguntasEditadas);
    fetch('http://localhost/sas/controladores/actualizarPreguntas.php', {
        method: 'POST',
        body: dataPreguntasEditadas
    })
        .then(response => { return response.json(); })
        .then(data => { alert(data['EXITO']); window.location.href = 'http://localhost/sas/vistas/CuestionarioContenido.php' });
};

/**
 * 
 */
const createDataPreguntasNuevas = preguntasNuevas => {
    const cuestionario = localStorage.getItem('cuestionario');
    const formData = new FormData();
    formData.append('cuestionario', cuestionario);
    formData.append('preguntasNuevas', JSON.stringify(preguntasNuevas));
    return formData;
};

/**
 * Se obtienen las preguntas con el atributo editado = nueva
 * es decir aun no estan en la base de datos.
 */
const getPreguntasNuevas = () => {
    const preguntas = document.querySelectorAll('#div-pregunta');
    let preguntasNuevas = [];
    preguntas.forEach(pregunta => {
        if (pregunta.getAttribute('editado') == 'nueva') {
            preguntasNuevas.push(pregunta);
        }
    });
    return preguntasNuevas;
};

/**
 * Toma los datos de las preguntas nuevas y las respuestas y los asigna en objetos para su envio.
*/
const getPreguntasNuevasObj = preguntasNuevas => {
    const preguntasNuevasObj = [];

    for (const preguntaNueva of preguntasNuevas) {
        const pregunta = preguntaNueva.firstChild.textContent;
        const respuestas = preguntaNueva.querySelectorAll('#pRespuesta');

        const preguntaObj = {
            pregunta: pregunta,
            respuestas: []
        };

        for (const respuesta of respuestas) {
            const r = respuesta.textContent;
            const tipo = respuesta.getAttribute('data-tipo');
            preguntaObj.respuestas.push({
                contenido: r,
                tipo: tipo
            });
        }
        preguntasNuevasObj.push(preguntaObj);
    }
    return preguntasNuevasObj;
};

const createDataPreguntasEditadas = preguntasEditadas => {
    const cuestionario = localStorage.getItem('cuestionario');
    const formData = new FormData();
    formData.append('cuestionario', cuestionario);
    formData.append('preguntasEditadas', JSON.stringify(preguntasEditadas));
    return formData;
};

/**
 * Se obtienen las preguntas con el atributo editado = true
 * es decir aquellas que estan en la bd pero su info. Ha sido modificada.
 */
const getPreguntasEditadas = () => {
    const preguntas = document.querySelectorAll('#div-pregunta');
    let preguntasEditadas = [];
    preguntas.forEach(pregunta => {
        if (pregunta.getAttribute('editado') == 'true') {
            preguntasEditadas.push(pregunta);
        }
    });
    return preguntasEditadas;
};

/**
 * Toma los datos de las preguntas editadas y las respuestas y los asigna en objetos para su envio.
 */
const getPreguntasEditadasObj = preguntasEditadas => {
    const preguntasEditadasObj = [];

    for (const preguntaEditada of preguntasEditadas) {
        const id = preguntaEditada.getAttribute('data-idpregunta');
        const pregunta = preguntaEditada.firstChild.textContent;
        const respuestas = preguntaEditada.querySelectorAll('#pRespuesta');

        const preguntaObj = {
            id: id,
            pregunta: pregunta,
            respuestas: []
        };

        for (const respuesta of respuestas) {
            const id = respuesta.getAttribute('data-idrespuesta');
            const r = respuesta.textContent;
            const tipo = respuesta.getAttribute('data-tipo');
            preguntaObj.respuestas.push({
                id: id,
                contenido: r,
                tipo: tipo
            });
        }
        preguntasEditadasObj.push(preguntaObj);
    }
    return preguntasEditadasObj;
};