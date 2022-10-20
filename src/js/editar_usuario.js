/**
 * Obtenemos los input del formulario para editar para cargar los datos en el mismo.
 */
const obtenerInputs = () => {
    const inputs = {
        'idUsuario': document.getElementById('id'),
        'matricula': document.getElementById('matricula'),
        'nombre': document.getElementById('nombre'),
        'paterno': document.getElementById('paterno'),
        'materno': document.getElementById('materno'),
        'correo': document.getElementById('correo'),
        'usuario': document.getElementById('usuario'),
        'contraseña': document.getElementById('contraseña'),
        'tipo': document.getElementById('tipo_usuario')
    };
    return inputs;
};

// Obtenemos los input del formulario de editar usuario.
const inputs = obtenerInputs();

/**
 * Cargamos los datos del usuario seleccionado en el formulario para editar.
 */
const cargarDatos = usuario => {
    for (const input in inputs) {
        inputs[input].value = usuario[input];
    }
};

/**
 * Verificamos que los campos del formulario sean validos.
 */
const verificarCamposEditar = () => {
    for (const input in inputs) {
        if (inputs[input].value == '') {
            return false;
        }
    }
    return true;
};

/**
 * Crea el formData con los datos del formulario.
 */
const generarFormDataEditUser = () => {
    const formData = new FormData();
    formData.append('idUsuario', inputs['idUsuario'].value);
    formData.append('matricula', inputs['matricula'].value);
    formData.append('nombre', inputs['nombre'].value);
    formData.append('paterno', inputs['paterno'].value);
    formData.append('materno', inputs['materno'].value);
    formData.append('correo', inputs['correo'].value);
    formData.append('usuario', inputs['usuario'].value);
    formData.append('contraseña', inputs['contraseña'].value);
    formData.append('tipo', inputs['tipo'].value);
    return formData;
};

/**
 * Envia una peticion para actualizar la informacion de un usuario.
 */
const editarUsuario = () => {
    const bodyEditUser = generarFormDataEditUser();
    fetch('http://localhost/sas/controladores/editar_usuario.php', {
        method: 'POST',
        body: bodyEditUser
    })
        .then(response => { return response.json(); })
        .then(data => {
            console.log(data['RESPUESTA']);
            window.location.href = 'http://localhost/sas/vistas/ConsultaUsuarios.php';
        })
        .catch(error => alert(error.message));
};

// Asignamos la función de editar al boton pertinente.
const bEdit = document.getElementById('bEdit');
bEdit.addEventListener('click', () => {
    const confirmacion = confirm('¿Estás seguro de continuar con los cambios realizados?');
    if (confirmacion) {
        verificarCamposEditar() ? editarUsuario() : alert('Llene el formulario para continuar.');
    }
});
