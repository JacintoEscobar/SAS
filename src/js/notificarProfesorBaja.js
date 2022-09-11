const notificarProfesorBaja = idClase => {
    // Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            try {
                const respuesta = JSON.parse(peticion.response);
            } catch (error) {
                alert('Se notificó al profesor sobre tu baja de la clase.');
            }
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/notificarProfesorBaja.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`idc=${idClase}`);
};