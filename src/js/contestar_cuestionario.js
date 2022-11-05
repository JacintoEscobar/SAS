const URL =
  "http://localhost/sas/controladores/registrar_respuestas_alumno.php";

/**
 * Crea el init para la petición.
 */
const generateBody = (rS) => {
  const body = new FormData();
  body.append("respuestas", JSON.stringify(rS));
  return body;
};

/**
 * Envía una petición para registrar las respuestas del alumno en la base de datos.
 * @param respuestasSeleccionadas Arreglo con las respuestas del alumno.
 */
const registrarRespuestasAlumno = (respuestasSeleccionadas) => {
  const body = generateBody(respuestasSeleccionadas);

  fetch(URL, {
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
 * Obtiene los <p> de las respuestas cuyo atributo estado es seleccionada.
 */
const getRespuestasSeleccionadas = () => {
  // Definimos un arreglo con las respuestas seleccionadas.
  const respuestasSeleccionadas = [];

  // Obtenemos todas las respuestas y filtramos las seleccionadas.
  const respuestas = document.querySelectorAll("#pRespuesta");
  for (const respuesta of respuestas) {
    if (respuesta.getAttribute("estado") == "seleccionada") {
      const respuestaObj = {
        contenido: respuesta.textContent,
        idRespuestaMultiple: respuesta.getAttribute("data-idrespuesta"),
        idUsuario: "",
      };
      respuestasSeleccionadas.push(respuestaObj);
    }
  }

  // Llamamos a la función que envía la petición de inserción para
  // registrar las respuestas del alumno.
  registrarRespuestasAlumno(respuestasSeleccionadas);
};

/**
 * Se verifica que haya una respuesta seleccionada para cada pregunta.
 */
const verifyRespuestasAlumno = () => {
  // Recorremos las respuestas de cada <div> para verificar
  // que exista aquella con el atributo estado = seleccionada.
  for (const divRespuesta of divsRespuestas) {
    let existeRespuestaSeleccionada = false;

    // Obtenemos las respuestas de la pregunta.
    const respuestas = divRespuesta.querySelectorAll("#pRespuesta");
    for (const respuesta of respuestas) {
      if (respuesta.getAttribute("estado") == "seleccionada") {
        existeRespuestaSeleccionada = true;
        break;
      }
    }

    if (!existeRespuestaSeleccionada) {
      return false;
    }
  }

  return true;
};

// Asignamos el evento al botón de enviar cuestionario.
const buttonEnviarCuest = document.getElementById("enviar-cuestionario");
buttonEnviarCuest.addEventListener("click", (e) => {
  // Obtenemos el tipo de preguntas que maneja el cuestionario.
  const tipoPreguntas = e.target.getAttribute("tipo_cuest");

  // En caso de ser preguntas abiertas se hace lo siguiente:
  if (tipoPreguntas == "abiertas") {
    if (!verificarRespuestasAbiertas()) {
      alert("Debes responder primero todas las preguntas.");
      return;
    }

    const confirmacion = confirm("¿Estás seguro de enviar tus respuestas?");
    if (confirmacion) {
      // Llamamos a la función que registra las preguntas abiertas del alumno.
      registrarRespuestasAbiertas();
    }
    return;
  }

  // En caso de ser preguntas cerradas se hace lo siguiente:
  if (!verifyRespuestasAlumno()) {
    alert("Aún tienes preguntas sin responder.");
    return;
  }

  const confirmacion = confirm("¿Estás seguro de enviar tus respuestas?");
  if (confirmacion) {
    // Llamamos a la función que obtienes las preguntas seleccionadas por el alumno.
    getRespuestasSeleccionadas();
  }
  return;
});
