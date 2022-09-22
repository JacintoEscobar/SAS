/**
 * Envía una petición para insertar un nuevo registro de ua en la bd.
 * @param titulo Elemento input con el título de la ua como value
 * @param descripcion Elemento input con la descripcion de la ua como value
 */
const agregarUA = (titulo, descripcion) => {
    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'http://localhost/sas/controladores/agregarUA.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`t=${titulo.value}&d=${descripcion.value}`);

    peticion.onreadystatechange = () => {
        if (peticion.status === 200 && peticion.readyState === 4) {
            alert(JSON.parse(peticion.response));

            // Limpiamos los campos del formulario y ocultamos este último.
            titulo.value = '';
            descripcion.value = '';
            buttonAddUA.click();

            // Limpiamos los elementos html de las ua.
            limpiarUA();

            // Obtenemos de nuevo las ua y sus tópicos.
            obtenerUA();
        }
    };
};

/**
 * Verifica la integridad de los datos enviados por el formulario.
 */
const verificarDatos = () => {
    // Obtenemos los campos del formulario.
    const titulo = document.getElementById('input-titulo');
    const descripcion = document.getElementById('input-descripcion');

    // Verificamos la información del formulario.
    titulo.value === '' || descripcion.value === '' ? alert('Llena los campos para continuar.') : agregarUA(titulo, descripcion);
};

// Asignamos la función que envía la petición.
const inputAddUA = document.getElementById('input-addUA');
inputAddUA.addEventListener('click', () => { verificarDatos() });

// Configuramos la lógica para mostrar/ocultar el formulario de creación de UsA.
const buttonAddUA = document.getElementById('agregar-unidad');
buttonAddUA.addEventListener('click', () => {
    const formAddUA = document.getElementById('section-addUA');
    formAddUA.style.visibility === 'hidden' ? formAddUA.style.visibility = 'visible' : formAddUA.style.visibility = 'hidden'
});