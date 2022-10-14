/**
 * Crea los elementos de las respuestas.
 * @param respuesta cadena de texto referente al contenido de la respuesta.
 * @param preguntaPadre Elemento html que sera padre de la respuesta.
 */
const addRespuesta = (respuesta, preguntaPadre) => {
    // <p id="pRespuesta">Respuesta1</p>
    const pRespuesta = document.createElement('p');
    pRespuesta.setAttribute('id', 'pRespuesta');
    pRespuesta.setAttribute('data-tipo', 'incorrecta');
    pRespuesta.textContent = respuesta;

    // Obtenemos el div de las respuestas para agregar
    // el elemento p de la respuesta nueva.
    const divRespuestas = preguntaPadre.nextElementSibling;
    divRespuestas.appendChild(pRespuesta);

    // Asignamos el evento de seleccion de respuesta correcta.
    // Esto para identificar a una sola respuesta correcta que se dara de alta asi en la bd.
    pRespuesta.addEventListener('click', () => {
        pRespuesta.style.backgroundColor = 'rgba(0, 153, 51, 0.7)';
        pRespuesta.style.borderRadius = '0.3rem';
        pRespuesta.style.padding = '0.4rem';
        pRespuesta.setAttribute('data-tipo', 'correcta');

        const respuestasP = divRespuestas.querySelectorAll('#pRespuesta');
        respuestasP.forEach(respuesta => {
            if (respuesta !== pRespuesta) {
                respuesta.style.backgroundColor = 'transparent';
                respuesta.borderRadius = '0px';
                respuesta.style.padding = '0px';
                respuesta.setAttribute('data-tipo', 'incorrecta');
            }
        });
    });

    // Removemos la referencia a la pregunta
    // para asegurar los datos.
    bCrearResp.removeAttribute('data-pregunta-refer');

    // Limpiamos el input de la respuesta
    // para la sig. Creacion de respuesta.
    document.getElementById('inpRespuesta').value = '';

    // Cerramos el modal de creacion de respuesta
    // para obtener nuevamente el p de la pregunta.
    document.getElementById('cerrarModalCreR').click();
};