const actuMailButton = document.getElementById('cambiarCorreoButton');
actuMailButton.addEventListener('click', () => {
    const nuevoMail = document.getElementById('nuevoCorreo');

    verificarCampo(nuevoMail) ? cambiarCorreo(nuevoMail.value) : alert('Llene el formulario para continuar.');
});

/**
 * 
 */
const cambiarCorreo = nuevoCorreo => {
    const peticion = new XMLHttpRequest();

    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            alert(JSON.parse(peticion.response));
            window.location.href = 'http://localhost/sas/vistas/Ajustes.php';
        }
    };

    peticion.open('POST', 'http://localhost/sas/controladores/cambiarCorreo.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticion.send(`c=${nuevoCorreo}`);
};