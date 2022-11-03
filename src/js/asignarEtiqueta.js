const URL = "http://localhost/sas/controladores/asignarEtiqueta.php";

/**
 * Elimina el botón que permite asignar la etiqueta al alumno
 * para que el profesor solo pueda asignar una por alumno.
 */
const dropAsignarEtiqueta = (button) => {
  button.parentElement.firstElementChild.setAttribute("disabled", true);
  button.parentElement.removeChild(button);
};

/**
 * Crea el body de la petición con el id del alumno y de la etiqueta.
 * @param {String} idA
 * @param {String} idE
 * @return {FormData}
 */
const createBody = (idA, idE) => {
  const body = new FormData();
  body.append("idA", idA);
  body.append("idE", idE);
  return body;
};

/**
 * Envía la petición para insertar el registro de la etiqueta.
 * @param {String} idE id de la etiqueta
 * @param {Element} button elemento button que genera la asignación de la etiqueta y contiene el id del alumno
 */
const asignarEtiqueta = async (idE, button) => {
  const body = createBody(button.getAttribute("data-idAlumo"), idE);
  await fetch(URL, {
    method: "POST",
    body: body,
  })
    .then((response) => {
      return response.json();
    })
    .then((result) => {
      if (result) {
        Swal.fire({
          icon: "success",
          title: "Yei.",
          text: "Etiqueta asignada de manera correcta.",
        });
        dropAsignarEtiqueta(button);
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Ocurrió un error al asignar la etiqueta al alumno.",
        });
      }
    })
    .catch((error) => console.log(error.message));
};

/**
 * Verifica que el <select> de etiquetas tenga un <option> seleccionado
 * válido para la inserción de la etiqueta en la base de datos.
 * @param {Element} button botón de asignar etiqueta.
 */
const verificarEtiqueta = (button) => {
  // Obtenmos el <option> de etiqueta seleccionado.
  const option =
    button.parentElement.querySelector("#select_etiqueta").selectedOptions[0];

  // Verificamos que la etiqueta seleccionada sea válida.
  if (option.value != "0") {
    // Obtenemos el id de la etiqueta.
    const idEtiqueta = option.getAttribute("data-idEtiqueta");

    asignarEtiqueta(idEtiqueta, button);
  }
};

// Obtenemos todos los <button> de asignar etiqueta.
const buttonsAsignarEtiqueta = document.querySelectorAll("#asignarEtiqueta");
buttonsAsignarEtiqueta.forEach((button) => {
  button.addEventListener("click", (e) => {
    verificarEtiqueta(e.target);
  });
});
