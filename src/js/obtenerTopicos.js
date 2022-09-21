/**
 * Se envía una petición para obtener los tópicos ligados a una ua.
 * @param unidadesAprendizaje
 */
const obtenerTopicos = unidadesAprendizaje => {
    /* console.log(`Unidades de aprendizaje: ${unidadesAprendizaje}`); */
    // Por cada unidad de aprendizaje obtenemos sus tópicos.
    for (const ua of unidadesAprendizaje) {
        const peticion = new XMLHttpRequest();

        peticion.onreadystatechange = () => {
            if (peticion.readyState == 4 && peticion.status == 200) {
                const respuesta = JSON.parse(peticion.response);

                typeof respuesta['topicos'] === 'undefined' ?
                    typeof respuestas[respuesta] === 'undefined' ?
                        alert(respuesta['ERROR']) : alert(respuestas[respuesta])
                    : crearUATopicos(ua, respuesta['topicos']);
            }
        };

        peticion.open('GET', `../controladores/obtenerTopicos.php?iau=${ua.idUnidadAprendizaje}`, true);

        peticion.send();
    }
};