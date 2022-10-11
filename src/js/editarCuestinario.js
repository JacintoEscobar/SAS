// Asignamos la función al botón pertinente.
const bEditCuest = document.getElementById('editar');
bEditCuest.addEventListener('click', () => { verificarDatos(); });

/**
 * Verificamos que los datos del formulario sean validos.
 */
const verificarDatos = () => {
    // Obtenemos los campos del formulario.
    const inputTit = document.getElementById('titulo');
    const inputTDesc = document.getElementById('descripcion');
    const inputTip = document.getElementById('tipo');

    if (inputTit != '' && inputTDesc != '' && (inputTip.value == 'abiertas' || inputTip.value == 'cerradas'))
        editarCuestionario(inputTit.value, inputTDesc.value, inputTip.value);
    else
        alert('Llene de manera correcta los datos del formulario para continuar.');
};

/**
 * Crea y envia una peticion de actualizacion a la base de datos.
 * @param titulo
 * @param descripcion
 * @param tipo tipo de preguntas que tendrá el cuestionario: abiertas o cerradas.
 */
const editarCuestionario = (titulo, descripcion, tipo) => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState === 4 && peticion.status === 200) {
            const respuesta = JSON.parse(peticion.response);
            alert(respuesta['RESPUESTA']);
            localStorage.clear();
            window.location.href = 'http://localhost/sas/vistas/Cuestionarios.php';
        }
    };

    peticion.open("POST", 'http://localhost/sas/controladores/editarCuestionario.php', true);
    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    peticion.send(`i=${bEditCuest.getAttribute('data-id')}&t=${titulo}&d=${descripcion}&ti=${tipo}`);
};