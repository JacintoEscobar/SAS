/**
 * 
 */
const respuestas = {
    ERROR_DE_REGISTRO: 'Ocurrió un error al registrar el alumno. Favor de reportar la falla.',
    REGISTRO_EXITOSO: 'El alumno se ha registrado de manera exitosa.'
};

/**
 * Asignamos el evento del botón de registrar alumno
 */
const buttonRegistrarAlumno = document.getElementById('registrarAlumno');
buttonRegistrarAlumno.addEventListener('click', () => { validarDatos(); });

/**
 * Obtenemos los elementos html de los campos del formulario
 */
let nombre = document.getElementById('nombre');
let paterno = document.getElementById('paterno');
let materno = document.getElementById('materno');
let correo = document.getElementById('correo');
let usuario = document.getElementById('usuario');
let contraseña = document.getElementById('contraseña');

/**
 * Función que verifica los datos del formulario
 * Devuélve false si algún dato falta o está erróneo o true de lo contrario
 */
const validarDatos = () => {
    nombre.value != '' && paterno.value != '' && materno.value != '' &&
        correo.value != '' && usuario.value != '' && contraseña.value != '' ? registrarAlumno() : mostrarErrorFormulario();
};

/**
 * Función que envia una solicitud para insertar al nuevo alumno en la base de datos
 * Recibe la información del alumno a insertar en la base de datos
 */
const registrarAlumno = () => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);
            alert(respuestas[respuesta]);

            // Llamamos a la función para notificar al alumno sobre su registro.
            notificarAlumnoRegistro(nombre.value, paterno.value, correo.value, usuario.value, contraseña.value);

            limpiarCampos();
        }
    };

    // Establecemos la conexión
    peticion.open('POST', '../controladores/registrarAlumno.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`n=${nombre.value}&p=${paterno.value}&m=${materno.value}&co=${correo.value}&u=${usuario.value}&con=${contraseña.value}`);
};

/**
 * Muestra un mensaje de error en los datos y limpia los elementos html del formulario
 */
const mostrarErrorFormulario = () => {
    limpiarCampos();
    alert('Verifica los datos ingresados.');
};

/**
 * Función que limpia los campos del formulario
 */
const limpiarCampos = () => {
    nombre.value = '';
    paterno.value = '';
    materno.value = '';
    correo.value = '';
    usuario.value = '';
    contraseña.value = '';
};
