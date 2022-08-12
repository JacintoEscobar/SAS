// Obtenemos el botón que permite el inicio de sesión
let buttonIniciarSesion = document.getElementById('iniciar-sesion');

// Configuramos el evento a realizar cuando se presione el botón de iniciar sesión
buttonIniciarSesion.addEventListener('click', () => {
    // Obtenemos los elementos html pertenecientes a los campos del formulario
    let usuario = document.getElementById('usuario');
    let contraseña = document.getElementById('contraseña');

    if (usuario.value === '' || contraseña.value === '') {
        alert('Llene el formulario para continuar.');
        usuario.value = '';
        contraseña.value = '';
    } else { iniciarSesion(usuario, contraseña) }
});

const iniciarSesion = (usuario, contraseña) => {
    //Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    //Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            let respuesta = JSON.parse(peticion.response);
            /* console.log(respuesta); */
            if (respuesta['CREDENCIALES_INCORRECTAS']) { alert(respuesta['CREDENCIALES_INCORRECTAS']); }
            if (respuesta['ERROR_DE_CONEXION']) { alert(respuesta['ERROR_DE_CONEXION']); }

            respuesta['tipo'] == 'administrador' ? window.location.href = '../vistas/HomeAdministrador.php' :
                respuesta['tipo'] == 'profesor' ? window.location.href = '../vistas/HomeProfesor.php' :
                    window.location.href = '../vistas/HomeAlumno.php';

            usuario.value = '';
            contraseña.value = '';
        }
    };

    //Establecemos la conexión
    peticion.open('POST', '../controladores/login.php', true);
    peticion.setRequestHeader('content-Type', 'application/x-www-form-urlencoded');

    //Enviamos la información del formulario a la api
    peticion.send(`usuario=${usuario.value}&contraseña=${contraseña.value}`);
}