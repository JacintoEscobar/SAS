// Obtenemos todos los <div> de respuestas de cada pregunta.
const divsRespuestas = document.querySelectorAll("#div-respuestas");

// Para cada <p> respuesta en cada <div> de respuestas asignamos
// el eventListener que les define el diseño de respuesta seleccionada.
divsRespuestas.forEach((divRespuesta) => {
  // Obtenemos los <p> de las respuestas dentro del <div> de respuestas de una pregunta.
  const psRespuestas = divRespuesta.querySelectorAll("#pRespuesta");
  psRespuestas.forEach((pRespuesta) => {
    pRespuesta.addEventListener("click", () => {
      pRespuesta.style;
    });
  });
});
