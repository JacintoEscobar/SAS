const buscar = document.getElementById('busqueda_input');

buscar.addEventListener('keydown', event => {
    if (event.key === 'Enter') {
        event.preventDefault();
        buscarUsuario();
    }
});

buscar.addEventListener('focusout', () => {
    if (buscar.value == '') {
        limpiar_tabla_usuarios();
        consulta_usuarios();
        mostrar_usuarios_todo();
    }
});

/**
 * Muestra a los usuarios cuyo id, matricula o nombre coincide con la busqueda.
 */
const buscarUsuario = () => {
    if (verificarBusqueda()) {
        usuarios.then(data => {
            limpiar_tabla_usuarios();
            const num_usuarios = data.length;
            for (let i = 0; i < num_usuarios; i++) {
                if (data[i].idUsuario == buscar.value || data[i].matricula == buscar.value || data[i].nombre == buscar.value) {
                    const tr = document.createElement('tr');

                    const thId = document.createElement('th');
                    thId.setAttribute('scope', 'row');

                    const tdMatricula = document.createElement('td');
                    const tdNombre = document.createElement('td');
                    const tdPaterno = document.createElement('td');
                    const tdMaterno = document.createElement('td');
                    const tdCorreo = document.createElement('td');
                    const tdUsuario = document.createElement('td');
                    const tdContraseña = document.createElement('td');
                    const tdTipo = document.createElement('td');
                    const bEliminarUsuario = document.createElement('button');

                    thId.textContent = data[i].idUsuario;
                    tdMatricula.textContent = data[i].matricula;
                    tdNombre.textContent = data[i].nombre;
                    tdPaterno.textContent = data[i].paterno;
                    tdMaterno.textContent = data[i].materno;
                    tdCorreo.textContent = data[i].correo;
                    tdUsuario.textContent = data[i].usuario;
                    tdContraseña.textContent = data[i].contraseña;
                    tdTipo.textContent = data[i].tipo;
                    bEliminarUsuario.setAttribute('type', 'button');
                    bEliminarUsuario.setAttribute('class', 'btn btn-danger');
                    bEliminarUsuario.appendChild(document.createTextNode('Eliminar'));
                    bEliminarUsuario.addEventListener('click', () => { eliminarUsuario(data[i]); });

                    tdNombre.setAttribute('id', 'td-nombre');
                    tdNombre.addEventListener('click', () => {
                        document.getElementById('bEditarUsuario').click();
                        cargarDatos(data[i]);
                    });
                    tr.append(thId, tdMatricula, tdNombre, tdPaterno, tdMaterno, tdCorreo, tdUsuario, tdContraseña, tdTipo, bEliminarUsuario);
                    tabla_usuarios.appendChild(tr);
                }
            }
        });
    }
};

/**
 * Verifica el texto ingresado en la barra de búsqueda.
 */
const verificarBusqueda = () => { return buscar.value != '' };