/**
 * Se envía una petición para eliminar el registro
 * del tópico de la base de datos.
 * @param idUA id de la unidad de aprendizaje a la que pertenece el tópico
 * @param titulo título del tópico
 * @param descripcion descripción del tópico
 */
const eliminarTopico = (idUA, titulo, descripcion) => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            alert(JSON.parse(peticion.response)['RESULTADO']);

            // Limpiamos los elementos html de las ua.
            limpiarUA();

            // Obtenemos de nuevo las ua y sus tópicos.
            obtenerUA();
        }
    };

    peticion.open('POST', 'http://localhost/sas/controladores/eliminarTopico.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`i=${idUA}&t=${titulo}&d=${descripcion}`);
};