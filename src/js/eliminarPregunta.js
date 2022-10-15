/**
 * Envia una peticion para eliminar la pregunta seleccionada.
 * @param idPregunta
 * @param divPregunta Elemento html que contiene a la pregunta y sus respuestas.
 */
const eliminarPregunta = (idPregunta, divPregunta) => {
    const idCuestionario = getCuestionarioAtributo('idCuestionario');

    const bodyData = formDataPregunta(idPregunta, idCuestionario);

    fetch('http://localhost/sas/controladores/eliminarPregunta.php', {
        method: 'POST',
        body: bodyData
    }).then(response => { return response.json(); })
        .then(dataJSON => {
            alert(dataJSON['EXITO']);
            eliminarPreguntaHTML(divPregunta);
        })
        .catch(error => alert(error.message));
};

/**
 * Devuelve un formData con el id de la pregunta a eliminar y el id del cuestionario.
 * @param idPregunta
 * @param idCuestionario
 */
const formDataPregunta = (idPregunta, idCuestionario) => {
    const formData = new FormData();
    formData.append('idP', idPregunta);
    formData.append('idC', idCuestionario);
    return formData;
}

/**
 * Elimina los elemento html de una pregunta despues de haberse eliminado esta de la bd.
 * @param divPregunta
 */
const eliminarPreguntaHTML = divPregunta => {
    document.querySelector('#div-preguntas').removeChild(divPregunta);
}
