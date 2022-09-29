const actuUserButton = document.getElementById('cambiarUsuarioButton');
actuUserButton.addEventListener('click', () => {
    const nuevoUser = document.getElementById('nuevoUsuario');

    verificarCampo(nuevoUser) ? cambiarUsuario(nuevoUser.value) : alert('Llene el formulario para continuar.');
});

/**
 * Valida que el campo contenga información.
 * @param campo Input del dato que el usuario desea actualizar. 
 */
const verificarCampo = campo => { return campo.value != ''; }

/**
 * 
 */
const cambiarUsuario = nuevoUsuario => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            alert(JSON.parse(peticion.response));
            window.location.href = 'http://localhost/sas/vistas/Ajustes.php';
        }
    };

    peticion.open('POST', 'http://localhost/sas/controladores/cambiarUsuario.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`u=${nuevoUsuario}`);
};