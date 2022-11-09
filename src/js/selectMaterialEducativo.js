/**
 * Muestra el formulario para subir un enlace como material educativo.
 */
const formEnlace = () => {
  const divForm = document.getElementById("form-me");
  const divPadre = document.createElement("div");
  const divTitulo = document.createElement("div");
  const divEnlace = document.createElement("div");
  const labelTitulo = document.createElement("label");
  const labelEnlace = document.createElement("label");
  const inputEnlace = document.createElement("input");
  const inputTitulo = document.createElement("input");

  divForm.setAttribute("tipo", "enlace");
  divPadre.className = "mb-3";
  divTitulo.className = "form-floating mb-3";
  divEnlace.className = "form-floating mb-3";
  inputTitulo.setAttribute("type", "text");
  inputTitulo.className = "form-control";
  inputTitulo.id = "meTitulo";
  inputTitulo.name = "meTitulo";
  inputTitulo.placeholder = "Antigua Grecia";
  inputEnlace.setAttribute("type", "text");
  inputEnlace.className = "form-control";
  inputEnlace.id = "meEnlace";
  inputEnlace.name = "meEnlace";
  inputEnlace.placeholder = "https://es.wikipedia.org/wiki/Antigua_Grecia";
  labelTitulo.setAttribute("for", "meTítulo");
  labelTitulo.textContent = "Escribe el título";
  labelEnlace.setAttribute("for", "meEnlace");
  labelEnlace.textContent = "Escribe el enlace";

  divTitulo.append(inputTitulo, labelTitulo);
  divEnlace.append(inputEnlace, labelEnlace);
  divPadre.append(divTitulo, divEnlace);
  divForm.append(divPadre);
};

/**
 * Muestra el formulario para subir un archivo como material educativo.
 */
const formArchivo = () => {
  const divForm = document.getElementById("form-me");
  const div = document.createElement("div");
  const label = document.createElement("label");
  const input = document.createElement("input");

  divForm.setAttribute("tipo", "archivo");
  div.className = "mb-3";
  label.setAttribute("for", "meFile");
  label.className = "form-label";
  label.textContent = "Selecciona una archivo para subir";
  input.className = "form-control";
  input.setAttribute("type", "file");
  input.id = "meFile";
  input.name = "meFile";

  div.append(label, input);
  divForm.appendChild(div);
};

/**
 * Muestra el formulario para seleccionar el material educativo
 * dependiendo de la opción seleccionada por el profesor.
 * @param {String} tipo tipo de archivo que se subirá: archivo o enlace.
 */
const showForm = (tipo) => {
  form = 1;
  if (tipo === "archivo") {
    return formArchivo();
  }
  return formEnlace();
};

/**
 * Elimina el formulario subir material
 */
const removeForm = () => {
  form = 0;
  const divForm = document.getElementById("form-me");
  divForm.removeAttribute("tipo");
  try {
    divForm.removeChild(divForm.firstChild);
  } catch (error) {}
};

const select = document.getElementById("select-me");
let form = 0;

select.addEventListener("change", (e) => {
  // Verificamos que el valor del <select> sea o bien archivo o enlace.
  if (e.target.value.length == 0) {
    return removeForm();
  }
  removeForm();
  return showForm(e.target.value);
});
