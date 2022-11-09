const errores = {
  ERROR_ARCHIVO: "Selecciona una archivo válido para subir.",
  ERROR_SUBIDA: "Ocurrió un error al subir tu archivo al servidor.",
  ERROR_REGISTRO:
    "Ocurrió un error al registrar el material educativo en la base de datos.",
};

/**
 * Verifica que el título y el enlace proporcionados por el profesor sean válidos.
 * @param {String} titulo
 * @param {String} enlace
 * @return {Boolean} false si falto un campo del formulario o true en caso contrario.
 */
const verificarCampos = (titulo, enlace) => {
  return titulo.length != 0 && enlace.length != 0;
};

/**
 * Envía una petición para subir un material educativo de tipo enlace.
 */
const subirEnlace = () => {
  // Obtenemos el título y el enlace del material educativo.
  const titulo = document.querySelector('input[name="meTitulo"]');
  const enlace = document.querySelector('input[name="meEnlace"]');

  if (!verificarCampos(titulo.value, enlace.value)) {
    return alert("Llena los campos para continuar.");
  }

  const body = new FormData();
  body.append("t", titulo.value);
  body.append("e", enlace.value);
  body.append(
    "idE",
    document.getElementById("select-etiqueta").firstElementChild.value
  );

  fetch("http://localhost/sas/controladores/subirEnlace.php", {
    method: "POST",
    body: body,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ERROR) {
        return alert(errores[data.ERROR]);
      }

      if (data.ERROR_FATAL) {
        return alert(data.ERROR_FATAL);
      }

      alert(data);
      window.location.href = "http://localhost/sas/vistas/Topico.php";
    })
    .catch((error) => console.error(error.message));
};

/**
 * Envía una petición para subir un material educativo de tipo archivo.
 */
const subirArchivo = () => {
  // Obtenemos el input que contiene el archivo subido por el profesor.
  const inputFile = document.querySelector('input[type="file"]');

  // Creamos el body de la petición con el archivo.
  const body = new FormData();
  body.append("meFile", inputFile.files[0]);
  body.append(
    "idE",
    document.getElementById("select-etiqueta").firstElementChild.value
  );

  fetch("http://localhost/sas/controladores/subirArchivo.php", {
    method: "POST",
    body: body,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ERROR) {
        return alert(errores[data.ERROR]);
      }

      if (data.ERROR_FATAL) {
        return alert(data.ERROR_FATAL);
      }

      alert(data);
      window.location.href = "http://localhost/sas/vistas/Topico.php";
    })
    .catch((error) => console.error(error.message));
};

/**
 * Verifica que el select tenga una opción válida seleccionada ya sea archivo o enlace.
 * @return {Boolean} true si hay una opción válida o false en caso contrario.
 */
const verificarOpcion = () => {
  return (
    document.getElementById("select-me").firstElementChild.value.length != 0 &&
    document.getElementById("select-etiqueta").firstElementChild.value.length !=
      0
  );
};

/**
 * Dependiendo del tipo de archivo que se va a subir llama a la función que envía la petición correspondiente.
 */
const subirMaterialEducativo = () => {
  if (!verificarOpcion()) {
    return alert("Selecciona un material educativo y una etiqueta válida");
  }

  // Segun el tipo de archivo, archivo o enlace, se enviará una petición diferente.
  if (document.getElementById("form-me").getAttribute("tipo") === "archivo") {
    return subirArchivo();
  }
  return subirEnlace();
};

const subir = document.getElementById("subir");
subir.addEventListener("click", () => {
  subirMaterialEducativo();
});
