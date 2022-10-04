/**
 * Se envía una petición para eliminar el registro
 * de la unidad de aprendizaje del la base de datos.
 * @param id id de la unidad de aprendizaje a eliminar.
 */
const eliminarUA = id => {
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

    peticion.open('POST', 'http://localhost/sas/controladores/eliminarUA.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`i=${id}`);
};