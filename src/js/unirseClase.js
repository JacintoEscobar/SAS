const buttonSolicitarUnirse = document.getElementById('buttonSolicitarUnirse');

// Obtenemos el código de la clase
const codigo = document.getElementById('codigoClase');

buttonSolicitarUnirse.onclick = () => {
    // Verificamos que se este recibiendo un código
    codigo.value == '' ? alert('Ingrese un código de clase válido.') : verificarCodigoClase(codigo);
};

const verificarCodigoClase = codigo => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            let respuesta = JSON.parse(peticion.response)['RESULTADO'];

            if (respuesta['ERROR_DE_CONEXION']) {
                alert(respuesta['ERROR_DE_CONEXION']);
            } else if (respuesta['ERROR']) {
                alert(respuesta['ERROR']);
            } else {
                // Llamamos a la función que obtiene las clases a las que está inscrito el alumno
                unirseClase();
            }
            codigo.value = '';
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/verificarCodigoClase.php', true);
    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`c=${codigo.value}`);
};

const unirseClase = () => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);

            respuesta['ERROR_DE_CONEXION'] ? alert(respuesta['ERROR_DE_CONEXION']) :
                respuesta['ERROR_DE_CONSULTA'] ? alert(respuesta['ERROR_DE_CONSULTA']) :
                    respuesta['ERROR_DE_INSERCIÓN'] ? alert(respuesta['ERROR_DE_INSERCIÓN']) :
                        alert(respuesta['EXITO']);

            const cerrarModal = document.getElementById('cerrarModal');
            cerrarModal.click();

            // Eliminamos los elementos HTML de las clases previamente obtenidas
            limpiarClases();

            // Actualizamos las clases del alumno
            obtenerClases();
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/unirseClase.php', true);
    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`c=${codigo.value}`);
}

const limpiarClases = () => {
    // Obtenemos la colección de elementos HTML de las clases del alumno
    let clases = document.getElementsByClassName('card');

    // Convertimos la colección en un arreglo
    clases = Array.from(clases);

    // Eliminamos cada elemento HTML clase del div de clases
    for (const clase of clases) { divClases.removeChild(clase); }
};