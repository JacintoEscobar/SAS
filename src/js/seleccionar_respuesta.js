// Obtenemos todos los <div> de respuestas de cada pregunta.
const divsRespuestas = document.querySelectorAll("#div-respuestas");

// Para cada <p> respuesta en cada <div> de respuestas asignamos
// el eventListener que les define el diseño de respuesta seleccionada.
divsRespuestas.forEach((divRespuesta) => {
  // Obtenemos los <p> de las respuestas dentro del <div> de respuestas de una pregunta.
  const psRespuestas = divRespuesta.querySelectorAll("#pRespuesta");
  psRespuestas.forEach((pRespuesta) => {
    pRespuesta.addEventListener("click", () => {
      pRespuesta.style.backgroundColor = 'rgba(0, 153, 51, 0.7)';
      pRespuesta.style.borderRadius = '0.3rem';
      pRespuesta.style.padding = '0.4rem';
      pRespuesta.setAttribute('estado', 'seleccionada');

      // Limpiamos el diseño de las respuestas no seleccionadas.
      psRespuestas.forEach(respuesta => {
        if (respuesta.getAttribute('data-idrespuesta') != pRespuesta.getAttribute('data-idrespuesta')) {
          respuesta.style.backgroundColor = 'transparent';
          respuesta.style.borderRadius = '0px';
          respuesta.style.padding = '0px';
          respuesta.setAttribute('estado', 'no-seleccionada');
        }
      });
    });
  });
});
