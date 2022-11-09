/**
 * Envía una petición para eliminar un material educativo.
 * @param {HTMLElement} button
 */
const eliminarME = (button) => {
  const idME = button.getAttribute("data-idME");
  const body = new FormData();
  body.append("idME", idME);
  fetch("http://localhost/sas/controladores/eliminarME.php", {
    method: "POST",
    body: body,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ERROR) {
        return alert(data.ERROR);
      }

      alert(data);
      window.location.href = "http://localhost/sas/vistas/Topico.php";
    })
    .catch((error) => console.error(error.message));
};

const buttonsEliminarME = document.querySelectorAll("#eliminarME");
buttonsEliminarME.forEach((button) => {
  button.addEventListener("click", (e) => {
    eliminarME(e.target);
  });
});
