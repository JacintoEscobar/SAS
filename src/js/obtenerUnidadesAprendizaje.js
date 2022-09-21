/**
 * Posibles errores devueltos por la petición.
 */
const respuestas = {
    ERROR_DE_CONEXION: 'Ocurrió un error al conectar con la base de datos. Notificar esto a sistemas.',
    ERROR_SQL: 'Ocurrió un error al realizar la consulta con la base de datos.'
};

/**
 * Se envía una petición para poder obtener las unidades de aprendizaje ligadas a una clase.
 */
const obtenerUA = () => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);

            typeof respuesta['U\'sA'] === 'undefined' ?
                typeof respuestas[respuesta] === 'undefined' ?
                    alert(respuesta['ERROR']) : alert(respuestas[respuesta])
                : obtenerTopicos(respuesta['U\'sA']);
        }
    };

    peticion.open('GET', '../controladores/obtenerUnidadesAprendizaje.php', true);

    peticion.send();
};

window.onload = () => { obtenerUA(); };