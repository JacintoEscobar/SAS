/**
 * Enviamos una peticion para obtener
 * los cuestionarios del profesor.
 */
const obtenerCuestionarios = () => {
    // Creamos una peticion.
    const peticion = new XMLHttpRequest();

    // Definimos la funcion para cuando se responde la peticion.
    peticion.onreadystatechange = () => {
        if (peticion.readyState === 4 && peticion.status === 200) {
            const respuesta = JSON.parse(peticion.response)['RESULTADO'];

            // Verificamos que la respuesta sea los cuestionarios y no un mensaje de error
            // y llamamos a la funcion que crea y agrega los elementos html de los cuestionarios.
            typeof respuesta !== 'string' ? crearCuestionariosHTML(respuesta) : alert(respuesta);
        }
    };

    // Abrimos el canal de conexion,
    peticion.open('GET', 'http://localhost/sas/controladores/obtenerCuestionarios.php', true);

    // Enviamos la peticion.
    peticion.send();
};

obtenerCuestionarios();