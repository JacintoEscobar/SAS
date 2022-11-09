/**
 * Crea el body de la petición y agrega los datos del formulario de crear ua.
 * @param {String} t
 * @param {String} d
 * @return {FormData}
 */
const createBody = (t, d) => {
  const body = new FormData();
  body.append("t", t);
  body.append("d", d);
  return body;
};

/**
 * Envía una petición para registrar una nueva ua en la bd.
 * @param {HTMLElement} t
 * @param {HTMLElement} d
 */
const agregarUA = async (t, d) => {
  const body = createBody(t.value, d.value);
  await fetch("http://localhost/sas/controladores/agregarUA.php", {
    method: "POST",
    body: body,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data);

      // Limpiamos los campos del formulario.
      t.value = "";
      d.value = "";

      // Limpiamos los elementos html de las ua.
      limpiarUA();

      // Obtenemos de nuevo las ua y sus tópicos.
      obtenerUA();
    })
    .catch((error) => console.error(error.message));
};

/**
 * Verifica que los datos del formulario de crear ua sean válidos.
 */
const verificarDatosUA = () => {
  const tituloUA = document.getElementById("titulo-ua");
  const descripcionUA = document.getElementById("descripcion-ua");

  if (tituloUA.value.length == 0 || descripcionUA.value.length == 0) {
    return alert("Llena el formulario para continuar.");
  }

  agregarUA(tituloUA, descripcionUA);
};

// Configuración del botón que envía la petición de creación.
const buttonCrearUA = document.getElementById("crearUA");
buttonCrearUA.addEventListener("click", () => verificarDatosUA());

// Configuración del botón que muestra el formulario para crear una ua.
const buttonAddUA = document.getElementById("agregar-unidad");
buttonAddUA.addEventListener("click", () =>
  document.getElementById("addUA").click()
);
