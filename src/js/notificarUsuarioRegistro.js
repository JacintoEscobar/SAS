const notificarUsuarioRegistro = (nombre, paterno, correo, usuario, contraseña) => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            try {
                alert(JSON.parse(peticion.response));
            } catch (error) {
                alert(error);
            }
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/notificarUsuarioRegistro.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`n=${nombre}&p=${paterno}&co=${correo}&u=${usuario}&con=${contraseña}`);
};
