const setEventActContra = () => {
    const cambiarConstraseñaButton = document.getElementById('cambiarContraseñaButton');
    cambiarConstraseñaButton.addEventListener('click', () => { cambiarContraseña(); });
};

const verificarCampos = (ca, cn, cc) => { return ca == '' || cn == '' || cc == ''; };

const verificarContraseñaNueva = (cn, cc) => { return cn == cc; };

const cambiarContraseña = () => {
    // Obtenemos los datos del formulario
    let contraActual = document.getElementById('contraseñaActual');
    let contraNueva = document.getElementById('contraseñaNueva');
    let confirContra = document.getElementById('confirmacionContraseña');

    // Verificamos los datos enviados en el formulario
    if (!verificarCampos(contraActual.value, contraNueva.value, confirContra.value)) {
        // Verificamos que la nueva contraseña se haya confirmado
        if (verificarContraseñaNueva(contraNueva.value, confirContra.value)) {
            //Creamos el objeto que permite enviar la solicitud al servidor
            const peticion = new XMLHttpRequest();

            //Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
            peticion.onreadystatechange = () => {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    let respuesta = JSON.parse(peticion.response);

                    if (respuesta['ERROR_POST']) { alert(respuesta['ERROR_POST']); }
                    else if (respuesta['ERROR_POST_DATOS']) { alert(respuesta['ERROR_POST_DATOS']); }
                    else if (respuesta['ERROR_DE_CONEXION']) { alert(respuesta['ERROR_DE_CONEXION']); }
                    else if (respuesta['ERROR_ACTUALIZACION']) { alert(respuesta['ERROR_ACTUALIZACION']); }
                    else if (respuesta['CONTRASEÑA_ACTUAL_ERRONEA']) { alert(respuesta['CONTRASEÑA_ACTUAL_ERRONEA']); }
                    else {
                        alert('Contraseña actualizada correctamente.');
                        alert('Ahora debes iniciar sesión nuevamente.');
                        fetch('http://localhost/sas/controladores/salir.php');
                        window.location.href = 'http://localhost/sas/vistas/Login.php';
                    }

                }
            };

            //Establecemos la conexión
            peticion.open('POST', '../controladores/cambiarContraseña.php', true);
            peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            //Enviamos la información del formulario a la api
            peticion.send(`ca=${contraActual.value}&cn=${contraNueva.value}`);
        } else {
            alert('La contraseña nueva no coincide.');
        }
    } else {
        alert('Llene los campos para continuar.');
    }
};
