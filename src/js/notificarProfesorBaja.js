const respuestasEsperadas = {
    ERROR_GET_DATA_ALUMNO: 'Ocurrió un error al obtener tu nombre. Favor de reportar la falla.',
    ERROR_GET_DATA_PROFESOR: 'Ocurrió un error al obtener la información del profesor. Favor de reportar la falla.',
    ERROR_GET_DATA_CLASE: 'Ocurrió un error al obtener la información de la clase. Favor de reportar la falla.'
};

const notificarProfesorBaja = (idClase, nombreClase) => {
    // Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            try {
                const respuesta = JSON.parse(peticion.response);
            } catch (error) {
                alert('Hemos notificado a tu profesor sobre tu petición.');
                console.log(respuestasEsperadas[respuesta]);
            }
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/notificarProfesorBaja.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`idc=${idClase}&nombreClase=${nombreClase}`);
};