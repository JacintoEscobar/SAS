const bConfirElimi = document.getElementById('button-confir-elimi');
bConfirElimi.addEventListener('click', () => eliminarCuestionario(bConfirElimi.getAttribute('data-id')));

/**
 * Crea y envia la peticion para eliminar
 * el cuestionario de la base de datos.
 * @param id id del cuestionario a eliminar.
 */
const eliminarCuestionario = id => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState === 4 && peticion.status === 200) {
            const respuesta = JSON.parse(peticion.response);
            alert(respuesta['RESPUESTA']);
            const bCerrarModal = document.getElementById('button-cerrar-md');
            bCerrarModal.click();
            limpiarCuestionarios();
            obtenerCuestionarios();
        }
    };

    peticion.open('POST', 'http://localhost/sas/controladores/eliminarCuestionario.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`i=${id}`);
};