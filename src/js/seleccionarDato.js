// Obtenemos los formularios.
const formActMail = document.getElementById('form-act-mail');
const formActUser = document.getElementById('form-act-user');
const formActPass = document.getElementById('form-act-pass');

// Obtenemos el select para mostrar el formulario correspondiente
// al dato que el usuario desea actualizar.
const selectDato = document.getElementById('select-dato');
selectDato.addEventListener('change', () => {
    // Mostramos el formulario para actualizar la el correo
    if (selectDato.value == 1) {
        formActMail.style.visibility = 'visible';
        formActUser.style.visibility = 'hidden';
        formActPass.style.visibility = 'hidden';
    }

    // Mostramos el formulario para actualizar el usuario
    if (selectDato.value == 2) {
        formActMail.style.visibility = 'hidden';
        formActUser.style.visibility = 'visible';
        formActPass.style.visibility = 'hidden';
    }

    // Mostramos el formulario para actualizar la contraseña
    if (selectDato.value == 3) {
        formActMail.style.visibility = 'hidden';
        formActUser.style.visibility = 'hidden';
        formActPass.style.visibility = 'visible';
    }
});