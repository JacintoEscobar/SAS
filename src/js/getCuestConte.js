/**
 * Envia una peticion para obtener las preguntas y respuestas de un cuestionario.
 */
const getCuestConte = () => {
    const divPreguntas = getDivPreguntas();

    const idCuestionario = getCuestionarioAtributo('idCuestionario');

    fetch(`http://localhost/sas/controladores/getPreguntas.php?i=${idCuestionario}`, {
        method: 'GET'
    })
        .then(response => { return response.json(); })
        .then(data => mostrarPregResp(data['PREGUNTAS']))
        .catch(error => alert(error.message));
};

/**
 * Retorna el div donde se agregaran las preguntas obtenidas
 */
const getDivPreguntas = () => { return document.getElementById('div-preguntas'); };

/**
 * Retorna el atributo del cuestionario.
 * @param attr
 */
const getCuestionarioAtributo = attr => { return JSON.parse(localStorage.getItem('cuestionario'))[attr]; }

/**
 * Crea los elementos html de las preguntas y sus respuestas.
 * @param preguntas Arreglo de preguntas.
 */
const mostrarPregResp = preguntas => {
    for (let i = 0; i < preguntas.length; i++) {
        const divRespuestas = addPregunta(preguntas[i]);

        for (let j = 0; j < preguntas[i].respuestas.length; j++) {
            addRespuesta(preguntas[i].respuestas[j], divRespuestas);
        }
    }
}

//Llamamos a la funcion de obtener preguntas.
getCuestConte();