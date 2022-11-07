/**
 * Elimina el HTML de los resultados de un alumno.
 */
const dropHTMLResultado = () => {
  const resultados =
    buttonAsignarCuestionario.parentElement.parentElement.previousElementSibling
      .parentElement.parentElement.previousElementSibling.parentElement
      .parentElement;
  resultados.removeChild(
    buttonAsignarCuestionario.parentElement.parentElement.previousElementSibling
      .parentElement.parentElement.previousElementSibling.parentElement
  );
};

/**
 * Realiza la petición para que registre la evaluación al alumno en la bd.
 * @param {Object} obj
 */
const registrarEvaluacion = (obj) => {
  const body = new FormData();
  body.append("obj", JSON.stringify(obj));

  fetch("http://localhost/sas/controladores/registrarEvaluacion.php", {
    method: "POST",
    body: body,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data);
      dropHTMLResultado();
    })
    .catch((error) => console.log(error.message));
};

const buttonAsignarCuestionario = document.getElementById("evaluar");
buttonAsignarCuestionario.addEventListener("click", (e) => {
  const button = e.target;
  const parent = button.parentElement;

  if (parent.querySelector("#asignarEtiqueta") !== null) {
    return alert("Antes de evaluar al alumno debes asignarle un etiqueta.");
  }

  const obj = {
    idA: button.getAttribute("data-idA"),
    idC: button.getAttribute("data-idC"),
    idE: parent
      .querySelector("#select_etiqueta")
      .selectedOptions[0].getAttribute("data-idEtiqueta"),
    puntaje: button.getAttribute("data-puntaje"),
  };

  registrarEvaluacion(obj);
});
