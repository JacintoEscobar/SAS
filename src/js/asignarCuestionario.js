/**
 * Crea el body del init de la petición.
 */
const crearBody = (idCuestionario, fechaCierre) => {
    const body = new FormData();
    body.append('idCuestionario', idCuestionario);
    body.append('fechaCierra', fechaCierre);
    return body;
};

/**
 * Crea el init de la petición.
 */
const crearInit = (idCuestionario, fechaCierre) => {
    return {
        method: 'POST',
        body: crearBody(idCuestionario, fechaCierre)
    }
};

/**
 * Envia una petición para crear la asignación de un cuestionario.
 */
const asignarCuestionario = (idCuestionario, titulo, fechaCierre) => {
    fetch('http://localhost/sas/controladores/asignar_cuestionario.php', crearInit(idCuestionario, fechaCierre))
        .then(response => { return response.json(); })
        .then(data => {
            alert(data['EXITO']);
            notificarCuestAsignado(idCuestionario, titulo);
        })
        .catch(error => alert(error.message));
};

/**
 * Permite que el profesor elija una fecha de cierre para el cuestionario.
 */
const selecFechaCierre = () => {
    const fechaVencimiento = inputDate.value;
    asignarCuestionario(buttonListo.getAttribute('data-idCuestionario'), buttonListo.getAttribute('data-titulo'), fechaVencimiento);
};

/**
 * Se pide la confirmación de asignación de un cuestionario seleccionado.
 */
const confirmarAsignacion = pCuestionario => {
    const confirmacion = confirm(`¿Estás seguro que deseas asignar ${pCuestionario.textContent}?`);
    if (confirmacion) {
        document.getElementById('modal').style.display = 'block';
        buttonListo.setAttribute('data-idCuestionario', pCuestionario.getAttribute('idC'));
        buttonListo.setAttribute('data-titulo', pCuestionario.getAttribute('t'));
    }
};

// A cada <p id="pCuestionario"> asignamos el evento click.
// Esto para confirmar la asignación del cuestionario
// y enviar la solicitud de asignación.
const psCuestionario = document.querySelectorAll('#pCuestionario');
psCuestionario.forEach(pCuestionario => {
    pCuestionario.addEventListener('click', event => { confirmarAsignacion(event.target); });
});

const fecha = new Date(Date.now());
const inputDate = document.getElementById('input-date');
inputDate.setAttribute('value', `${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}`);
inputDate.setAttribute('min', `${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}`);

const buttonListo = document.getElementById('button-listo');
buttonListo.addEventListener('click', () => { selecFechaCierre(); });
