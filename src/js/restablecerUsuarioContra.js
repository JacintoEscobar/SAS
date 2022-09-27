/**
 * Muestra el formulario para restablecer la credencial.
 * @param id Id del usuario.
 */
const formRestCredencial = id => {
    formRestCred.style.visibility = 'visible';

    if (buttonVerificar.getAttribute('credencial') === 'usuario') {
        labelCred.textContent = `Ingresa tu nuevo ${buttonVerificar.getAttribute('credencial')}`;
        inputCred.setAttribute('type', 'text');
    } else {
        labelCred.textContent = `Ingresa tu nueva ${buttonVerificar.getAttribute('credencial')}`;
        inputCred.setAttribute('type', 'password');
    }

    inputCred.setAttribute('name', buttonVerificar.getAttribute('credencial'));
    buttonActuaCred.setAttribute('id-user', id);
};

// Obtenemos el botón que envía la petición para actualizar la base de datos.
const buttonActuaCred = document.getElementById('button-cambiar-credencial');
buttonActuaCred.addEventListener('click', () => {
    if (inputCred.value == '') {
        alert('Llene le formulario para continuar.');
    } else {
        actualizarCredencial(
            buttonVerificar.getAttribute('credencial'),
            inputCred.value
        );
    }
});

// Obtenemos el formulario de restablecimiento y sus campos.
const formRestCred = document.getElementById('form-rest-credencial');
const labelCred = document.getElementById('label-credencial');
const inputCred = document.getElementById('input-credencial');

/**
 * Envía una petición para consultar el correo ingresado
 * y permitir el restablercer una credencial del usuario
 */
const verificarCorreo = () => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);

            if (respuesta['idUsuario']) {
                formRestCredencial(respuesta['idUsuario']);
            } else {
                alert(respuesta['error']);
                inputCorreo.value = '';
            }
        }
    };

    // Establecemos la conexión
    peticion.open('POST', 'http://localhost/sas/controladores/verificarCorreo.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`c=${inputCorreo.value}`);
};

/**
 * Muestra el formulario para verificar el correo del usuario.
 * @param credencial Credencial que se va a restablecer: user o password.
 */
const mostrarVeriUser = credencial => {
    formVeriCredencial.style.visibility = 'visible';
    buttonVerificar.setAttribute('credencial', credencial);
    inputCorreo.value = '';
    formRestCred.style.visibility = 'hidden';
    inputCred.value = '';
    labelCred.textContent = '';
};

// Obtenemos el botón para ocultar el formulario de verificación de correo.
const bCerrarForm = document.getElementById('cerrar-form-verificar-email');
bCerrarForm.addEventListener('click', () => {
    formVeriCredencial.style.visibility = 'hidden';
    inputCorreo.value = '';
    buttonVerificar.removeAttribute('credencial');
    formRestCred.style.visibility = 'hidden';
    labelCred.textContent = '';
    inputCred.value = '';
    inputCred.removeAttribute('type');
    inputCred.removeAttribute('name');
});

// Obtenemos el botón que manda la petición para verificar el correo.
const buttonVerificar = document.getElementById('verificar-email');
buttonVerificar.addEventListener('click', () => {
    if (inputCorreo.value == '') {
        alert('Ingrese su correo electrónico para continuar.');
    } else {
        verificarCorreo();
    }
});

// Obtenemos el input del correo.
const inputCorreo = document.getElementById('correo-verificar');

// Obtenemos el formulario de verificación de correo.
const formVeriCredencial = document.getElementById('form-verificar-email');

// Obtenemos los botones de opción para restablecer una credencial.
const bForgetUser = document.getElementById('forget-user');
const bForgetPass = document.getElementById('forget-pass');
bForgetUser.addEventListener('click', () => { mostrarVeriUser('usuario'); });
bForgetPass.addEventListener('click', () => { mostrarVeriUser('contraseña'); });