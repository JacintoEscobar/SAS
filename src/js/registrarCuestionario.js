// Obtenemos el boton de registrar cuestionario y asignamos
// a la funcion que verifica los datos del formulario
const bRegCuest = document.getElementById('registrar');
bRegCuest.addEventListener('click', () => verifDatos());

/**
 * Verifica que los datos del formulario sean validos.
 */
const verifDatos = () => {
    const titulo = document.getElementById('titulo');
    const descripcion = document.getElementById('descripcion');
    const tipo = document.getElementById('tipo');

    titulo.value === '' || descripcion.value === '' || tipo.value === '0' ?
        alert('Llene el formulario para continuar con el registro.') :
        regCuesti(titulo, descripcion, tipo);
};

/**
 * Crea y envia la peticion para registrar el cuestionario en la bd.
 * @param titulo Elemento HTML referente al titulo del cuestionario.
 * @param descripcion Elemento HTML referente al descripcion del cuestionario.
 * @param tipo Elemento HTML referente al tipo del cuestionario.
 */
const regCuesti = (titulo, descripcion, tipo) => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState === 4 && peticion.status === 200) {
            const respuesta = JSON.parse(peticion.response);
            alert(respuesta['RESPUESTA']);
            window.location.href = 'http://localhost/sas/vistas/Cuestionarios.php';
        }
    };

    peticion.open('POST', 'http://localhost/sas/controladores/registrarCuestionario.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`titulo=${titulo.value}&descripcion=${descripcion.value}&tipo=${tipo.value}`);
};