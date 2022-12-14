/**
 * Crea los elementos html para las ua y los tópicos y los agrega al container principal.
 * @param ua Unidad de aprendizaje actual
 * @param topicos Tópicos de la unidad de aprendizaje actual.
 */
const crearUATopicos = (ua, topicos /* UsA */) => {
  // Obtenemos el contenedor de todas las unidades de aprendizaje.
  const containerUsAT = document.getElementById(
    "container-unidades-aprendizaje"
  );

  /* for (const usa in UsA) { */
  const containerUAT = document.createElement("div");
  containerUAT.setAttribute("id", "container-unidad-aprendizaje");
  containerUAT.setAttribute("class", "container");

  const rowUA = document.createElement("div");
  rowUA.setAttribute("id", "row-unidad-aprendizaje");
  rowUA.setAttribute("class", "row");
  const bEliminarUA = document.createElement("button");
  bEliminarUA.setAttribute("type", "button");
  bEliminarUA.setAttribute("class", "btn btn-danger");
  bEliminarUA.setAttribute("id", "eliminarUAButton");
  bEliminarUA.appendChild(document.createTextNode("Eliminar UA."));
  bEliminarUA.addEventListener("click", () => {
    eliminarUA(ua.idUnidadAprendizaje);
  });
  const spanTituloUA = document.createElement("span");
  spanTituloUA.setAttribute("id", "unidad-aprendizaje");
  spanTituloUA.appendChild(document.createTextNode(ua.titulo));
  spanTituloUA.appendChild(bEliminarUA);
  rowUA.appendChild(spanTituloUA);

  containerUAT.appendChild(rowUA);
  containerUsAT.appendChild(containerUAT);

  const containerT = document.createElement("div");
  topicos.forEach((topico) => {
    // Creamos un <div que contenga los tópicos y sus funciones>
    const div = document.createElement("div");

    const aTopico = document.createElement("a");
    containerT.setAttribute("id", "container-topicos");
    containerT.setAttribute("class", "container");
    const bEliminarT = document.createElement("button");
    bEliminarT.setAttribute("id", "eliminarTButton");
    bEliminarT.setAttribute("class", "btn btn-danger");
    bEliminarT.setAttribute("type", "button");
    bEliminarT.addEventListener("click", () => {
      eliminarTopico(ua.idUnidadAprendizaje, topico.titulo, topico.descripcion);
    });
    bEliminarT.appendChild(document.createTextNode("Eliminar."));
    aTopico.setAttribute(
      "href",
      `http://localhost/sas/vistas/Topico.php?i=${topico.idTopico}`
    );
    aTopico.setAttribute("id", "aTopico");
    aTopico.appendChild(
      document.createTextNode(`${topico.titulo}: ${topico.descripcion}`)
    );
    div.append(aTopico, bEliminarT);
    containerT.append(div);
  });

  const buttonAgregarT = document.createElement("button");
  buttonAgregarT.setAttribute("id", "agregar-topico");
  buttonAgregarT.setAttribute("class", "btn btn-primary");
  buttonAgregarT.setAttribute("type", "button");
  buttonAgregarT.setAttribute("data-bs-toggle", "modal");
  buttonAgregarT.setAttribute("data-bs-target", "#div-form-addT");
  buttonAgregarT.style.backgroundColor = "#00b33c";

  buttonAgregarT.onclick = () => {
    // Cambiamos el título del modal con cada ua.
    const tituloModal = document.getElementById("titulo-addT");
    tituloModal.setAttribute("id-data-ua", ua.idUnidadAprendizaje);
    if (tituloModal.hasChildNodes())
      tituloModal.removeChild(tituloModal.firstChild);
    tituloModal.appendChild(
      document.createTextNode(`Nuevo tópico para ${ua.titulo}`)
    );
  };

  buttonAgregarT.appendChild(document.createTextNode("Agregar tópico"));
  containerT.append(buttonAgregarT);
  containerUAT.appendChild(containerT);
};
