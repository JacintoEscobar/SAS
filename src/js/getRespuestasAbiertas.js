URL_RA = "http://localhost/sas/controladores/registrarRespuestasAbiertas.php";

/**
 * Obtiene las respuestas del alumno y las almacena en un arreglo
 * que es parseado a string para enviarlo en la petición.
 * @return {String} arreglo de respuestas parseado.
 */
const getStringRespuestas = () => {
  const respuestas = [];

  // Obtenemos las respuestas del alumno y los ids correspondientes a las respuestas múltiple de dicha respuestas.
  respuestasAbiertas.forEach((resp) => {
    const respuesta = {
      idRespuestaMultiple: resp.getAttribute("data-idrespuesta"),
      contenido: resp.value,
    };
    respuestas.push(respuesta);
  });

  return JSON.stringify(respuestas);
};

/**
 * Crea el body de la petición con las respuestas del alumnos.
 * @return {FormData}
 */
const createBody = () => {
  const body = new FormData();
  body.append("respuestas", getStringRespuestas());
  return body;
};

/**
 * Registra las respuestas del alumno para cuestionario de tipo abiertas.
 */
const registrarRespuestasAbiertas = () => {
  const body = createBody();
  fetch(URL_RA, {
    method: "POST",
    body: body,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      alert(data);
      window.location.href = "http://localhost/sas/vistas/ClasesEstudiante.php";
    })
    .catch((error) => alert(error.message));
};

/**
 * Verifica que todos los textArea tengan contenido
 * @return {Boolean} true si todas las preguntas están respondidas o false en caso contrario
 */
const verificarRespuestasAbiertas = () => {
  for (const respuestaAbierta of respuestasAbiertas) {
    if (respuestaAbierta.value == "") return false;
  }
  return true;
};

const respuestasAbiertas = document.querySelectorAll("#respuestaAbierta");
