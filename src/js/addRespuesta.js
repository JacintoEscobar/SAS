/**
 * Crea los elementos de las respuestas obtenidas de la bd.
 * @param respuesta Objeto respuesta.
 * @param divRespuestas Elemento html que sera padre de las respuestas.
 */
const addRespuesta = (respuesta, divRespuestas) => {
    // <p id="pRespuesta">Respuesta1</p>
    const pRespuesta = document.createElement('p');
    pRespuesta.setAttribute('id', 'pRespuesta');
    pRespuesta.setAttribute('data-idRespuesta', respuesta.idRespuestaMultiple);
    pRespuesta.setAttribute('data-tipo', respuesta.tipo);
    pRespuesta.textContent = respuesta.contenido;

    if (respuesta.tipo == 'correcta') {
        pRespuesta.style.backgroundColor = 'rgba(0, 153, 51, 0.7)';
        pRespuesta.style.borderRadius = '0.3rem';
        pRespuesta.style.padding = '0.4rem';
        pRespuesta.setAttribute('data-tipo', 'correcta');
    }

    divRespuestas.appendChild(pRespuesta);

    // Asignamos el evento de seleccion de respuesta correcta.
    // Esto para el caso en que el profesor quiera modificar la respuesta correcta.
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

            divRespuestas.parentElement.setAttribute('editado', 'true');
        }
    });
};