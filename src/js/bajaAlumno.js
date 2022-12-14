const solicitarBaja = (idClase, nombreClase) => {

    confirmacion = prompt(`Ingresa "${nombreClase}" para confirmar tu petición de baja de la clase.`);

    if (confirmacion === nombreClase) {
        // Creamos el objeto que permite enviar la solicitud al servidor
        const peticion = new XMLHttpRequest();

        // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
        peticion.onreadystatechange = () => {
            if (peticion.readyState == 4 && peticion.status == 200) {
                const respuesta = JSON.parse(peticion.response);

                if (respuesta['EXITO']) {
                    // Enviamos el correo para notificar al profesor de la baja del alumno
                    notificarProfesorBaja(idClase, nombreClase);

                    // Eliminamos los elementos HTML de las clases previamente obtenidas
                    limpiarClases();

                    // Actualizamos las clases del alumno
                    obtenerClases();
                } else {
                    alert(respuesta['ERROR']);
                }
            }
        };

        // Establecemos la conexión
        peticion.open('POST', '../controladores/solicitarBaja.php', true);

        peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Enviamos la información del formulario a la api
        peticion.send(`idc=${idClase}`);
    } else {
        alert('Ingresa el texto indicado para realizar tu petición de baja.');
    }
};