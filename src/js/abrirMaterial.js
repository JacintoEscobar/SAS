/**
 * Redirige al enlace del material.
 * @param {HTMLElement} h5
 */
const abrirEnlace = (h5) => {
  return window.open(
    h5.nextElementSibling.querySelector("#direccion").textContent
  );
};

/**
 * Redirigue al controlador que permite la descarga del archivo.
 * @param {HTMLElement} h5
 */
const abrirArchivo = async (h5) => {
  return window.open(
    "http://localhost/sas/controladores/descargarMaterial.php"
  );
};

const materiales = document.querySelectorAll("#material");
materiales.forEach((material) => {
  material.addEventListener("click", (e) => {
    if (e.target.getAttribute("data-tipo") == "archivo") {
      return abrirArchivo(e.target);
    }
    return abrirEnlace(e.target);
  });
});
