/**
 * Se envia una peticion para eliminar a un usuario.
 * @param usuario objeto usuario
 */
const eliminarUsuario = usuario => {
    let confirmacion = verificarEliminacion(usuario);

    if (confirmacion) {
        const bodyEliminarUsuario = formDataEliminarUsuario(usuario.idUsuario);

        fetch('http://localhost/sas/controladores/eliminar_usuario.php', {
            method: 'POST',
            body: bodyEliminarUsuario
        })
            .then(response => { return response.json(); })
            .then(data => {
                alert(data['RESPUESTA']);
                limpiar_tabla_usuarios();
                usuarios = consulta_usuarios();
                mostrar_usuarios_todo();
            })
            .catch(error => alert(error.message));
    }
};

/**
 * Crea el formdata y asigna el id del usuario que se va a eliminar.
 */
const formDataEliminarUsuario = id => {
    const formData = new FormData();
    formData.append('idUsuario', id);
    return formData;
};

/**
 * Verificamos que el usuario este seguro de la elminacion.
 */
const verificarEliminacion = usuario => {
    return confirm(`¡ATENCIÓN!\nLa siguiente información será eliminada de la base de datos:\n\nID: ${usuario.idUsuario}\nMatrícula: ${usuario.matricula}\nNombre: ${usuario.nombre}\nPaterno: ${usuario.paterno}\nMaterno: ${usuario.materno}\nTipo: ${usuario.tipo}\n\n¿Estás seguro de continuar?`);
};