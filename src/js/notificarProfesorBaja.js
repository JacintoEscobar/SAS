const respuestasEsperadas = {
    ERROR_GET_NOMBRE_ALUMNO: 'Ocurrió un error al obtener tu nombre. Favor de reportar la falla.',
    ERROR_GET_NOMBRE_CLASE_PROFESOR: 'Ocurrió un error al obtener el nombre de la clase y del profesor. Favor de reportar la falla.',
    CORREO_ENVIADO: 'Hemos notificado a tu profesor sobre tu baja.',
    CORREO_NO_ENVIADO: 'Ocurrió un error al notificar a tu profesor. Favor de reportar la falla.'
};

const notificarProfesorBaja = idClase => {
    // Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            try {
                const respuesta = JSON.parse(peticion.response);
            } catch (error) {
                alert('Hemos notificado a tu profesor sobre tu baja.');
            }
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/notificarProfesorBaja.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`idc=${idClase}`);
};