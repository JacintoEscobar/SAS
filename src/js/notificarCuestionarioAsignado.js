/**
 * Crea el body del init para enviar el id del cuestionario asignado.
 */
const bodyInit = (id, titulo) => {
    const body = new FormData();
    body.append('idCuestionario', id);
    body.append('titulo', titulo);
    return body;
};

/**
 * Crea el init de la peticion para notificar al alumno.
 */
const initNotificacion = (id, titulo) => {
    return {
        method: 'POST',
        body: bodyInit(id, titulo)
    };
};

/**
 * Envía una petición para notificar por correo electrónico
 * a los alumno sobre un nuevo cuestionario asignado.
 */
const notificarCuestAsignado = (idCuestionario, tituloCuestionario) => {
    fetch('http://localhost/sas/controladores/notificar_nuevo_cuestionario.php', initNotificacion(idCuestionario, tituloCuestionario))
        .then(response => window.location.href = `http://localhost/sas/vistas/Clases.php`);
};
