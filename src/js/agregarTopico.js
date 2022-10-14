/**
 * Se envía una petición para insertar un tópico en la bd.
 */
const agregarTopico = () => {
    // Obtenemos los elementos html del formulario.
    const tituloTopico = document.getElementById('input-titulo-topico');
    const descripcionTopico = document.getElementById('input-descripcion-topico');

    // Verificamos la información obtenida por el formulario.
    if (tituloTopico.value === '' || descripcionTopico === '') {
        alert('Llene el formulario para continuar');
    } else {
        // Obtenemos el id de la ua a la que se le agregará el tópico.
        const idUA = document.getElementById('titulo-addT').getAttribute('id-data-ua');

        // Enviamos la petición
        const peticion = new XMLHttpRequest();

        peticion.open('POST', 'http://localhost/sas/controladores/agregarTopico.php', true);

        peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        peticion.send(`idUA=${idUA}&titulo=${tituloTopico.value}&descripcion=${descripcionTopico.value}`);

        peticion.onreadystatechange = () => {
            if (peticion.status === 200 && peticion.readyState === 4) {
                const respuesta = JSON.parse(peticion.response);
                if (respuesta == 'EXITO') {
                    alert('El tópico se registró correctamente.');

                    // Limpiamos los elementos html de las ua.
                    limpiarUA();

                    // Obtenemos nuevamente las ua y los tópicos.
                    obtenerUA();

                    // Limpiamos los campos del modal.
                    const inpTitulo = document.getElementById('input-titulo-topico');
                    inpTitulo.value = '';
                    const inpDesc = document.getElementById('input-descripcion-topico');
                    inpDesc.value = '';

                    // Cerramos el modal del formulario para crear un tópico.
                    document.getElementById('buttonCancelarAdd').click();
                } else {
                    alert(respuesta);
                }
            }
        };
    }
};

const bAddT = document.getElementById('buttonAddT');
bAddT.addEventListener('click', () => agregarTopico());