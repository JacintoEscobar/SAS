// Obtenemos el botón de registrar clase
const registrar = document.getElementById('registrar');
registrar.addEventListener('click', () => {
    // Obtenemos los elementos que contienen los datos del formulario
    const titulo = document.getElementById('titulo');
    const descripcion = document.getElementById('descripcion');
    const cuatrimestre = document.getElementById('cuatrimestre');
    const carrera = document.getElementById('carrera');
    const grupo = document.getElementById('grupo');

    if (verificarDatos(titulo.value, descripcion.value, cuatrimestre.value, carrera.value, grupo.value)) {
        alert('Llene el formulario para continuar con el registro.');
    } else {
        // Creamos el objeto que nos permite realizar la petición
        let peticion = new XMLHttpRequest();

        peticion.onreadystatechange = () => {
            if (peticion.readyState === 4 && peticion.status === 200) {
                let respuesta = JSON.parse(peticion.response);

                if (respuesta['ERROR_POST']) {
                    alert(respuesta['ERROR_POST']);
                } else if (respuesta['ERROR_POST_DATOS']) {
                    alert(respuesta['ERROR_POST_DATOS']);
                } else if (respuesta['ERROR_CONEXION']) {
                    alert(respuesta['ERROR_POST_DATOS']);
                } else if (respuesta['ERROR_EJECUCION']) {
                    alert(respuesta['ERROR_EJECUCION']);
                } else {
                    alert(respuesta['EXITO']);
                    window.location.href = '../vistas/Clases.php';
                }

                titulo.value = '';
                descripcion.value = '';
                cuatrimestre.value = '';
                carrera.value = '';
                grupo.value = '';
            }
        };

        peticion.open("POST", '../controladores/crearClase.php', true);
        peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        peticion.send(`titulo=${titulo.value}&descripcion=${descripcion.value}&cuatrimestre=${cuatrimestre.value}&carrera=${carrera.value}&grupo=${grupo.value}`);
    }
});
