const filtro = document.getElementById('select-filtro');
filtro.addEventListener('change', () => {
    limpiar_tabla_usuarios();

    filtro.value === 'todo' ? mostrar_usuarios_todo() :
        filtro.value === 'administrador' ? filtrar_administrador() :
            filtro.value === 'profesor' ? filtrar_profesor() : filtrar_alumno();
});

/**
 * Muestra a los usuarios que son de tipo administrador.
 */
const filtrar_administrador = () => {
    usuarios.then(data => {
        const num_usuarios = data.length;
        for (let i = 0; i < num_usuarios; i++) {
            if (data[i].tipo === 'administrador') {
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
                bEliminarUsuario.addEventListener('click', () => { eliminarUsuario(data[i].idUsuario); });

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
};

/**
 * Muestra a los usuarios que son de tipo profesor.
 */
const filtrar_profesor = () => {
    usuarios.then(data => {
        const num_usuarios = data.length;
        for (let i = 0; i < num_usuarios; i++) {
            if (data[i].tipo === 'profesor') {
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
                bEliminarUsuario.addEventListener('click', () => { eliminarUsuario(data[i].idUsuario); });

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
};

/**
* Muestra a los usuarios que son de tipo alumno.
*/
const filtrar_alumno = () => {
    usuarios.then(data => {
        const num_usuarios = data.length;
        for (let i = 0; i < num_usuarios; i++) {
            if (data[i].tipo === 'alumno') {
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
};
