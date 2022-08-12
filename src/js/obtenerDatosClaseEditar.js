window.onload = () => { obtenerDatosClase(); };

const obtenerDatosClase = () => {
    const codigoClase = document.getElementById('codigo').value;
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);
            if (respuesta['DATOS']) {
                const clase = respuesta['DATOS'];
                setDatos(clase);
            } else if (respuesta['ERROR_GET']) {
                alert(respuesta['ERROR_GET']);
            } else {
                alert(respuesta['ERROR_DE_CONEXION']);
            }
        }
    };

    peticion.open('GET', `../controladores/obtenerDatosClaseEditar.php?c=${codigoClase}`, true);

    peticion.send();
};

const setDatos = (clase) => {
    const titulo = document.getElementById('titulo');
    titulo.value = clase['nombre'];

    const descripcion = document.getElementById('descripcion');
    descripcion.value = clase['descripcion'];

    const cuatrimestre = document.getElementById('cuatrimestre');
    cuatrimestre.value = clase['cuatrimestre'];

    const carrera = document.getElementById('carrera');
    carrera.value = clase['carrera'];

    const grupo = document.getElementById('grupo');
    grupo.value = clase['grupo'];
};