// Obtenemos el select para mostrar el formulario correspondiente
// al dato que el usuario desea actualizar.
const selectDato = document.getElementById('select-dato');
selectDato.addEventListener('change', () => {
    // Mostramos el formulario para actualizar la el correo o el usuario.
    if (selectDato.value == 1 || selectDato.value == 2) {
        formAct_Correo_Usuario(selectDato.value);
    }

    // Mostramos el formulario para actualizar la contraseña
    if (selectDato.value == 3) {
        formActContraseña();
    }
});

/**
 * Elimina el formulario de actualizacion creado, esto para mostrar el formulario seleccionado.
 */
const limpiarFormAct = () => {
    const containerAjustes = document.getElementById('container-ajustes');
    const form = containerAjustes.getElementsByClassName('form')[0];
    if (typeof form != 'undefined') {
        document.getElementById('container-ajustes').removeChild(document.getElementById('container-ajustes').lastChild);
    }
};

/**
 * Muestra el formulario para actualizar el correo.
 * @param dato 1: correo o 2: usuario.
 * <!--Formulario para actualizar el correo-->
    <form class="form" id="form-act-mail" style="visibility: hidden;">
        <div class="mb-3">
            <label for="nuevoCorreo" class="form-label">Nuevo correo</label>
            <input type="email" class="form-control" id="nuevoCorreo">
        </div>
        <button type="button" id="cambiarCorreoButton" class="btn btn-primary">Actualizar correo</button>
    </form>
 */
const formAct_Correo_Usuario = dato => {
    limpiarFormAct();

    const form = document.createElement('form');
    const div = document.createElement('div');
    const label = document.createElement('label');
    const input = document.createElement('input');
    const button = document.createElement('button');

    form.setAttribute('class', 'form');
    div.setAttribute('class', 'mb-3');
    label.setAttribute('class', 'form-label');
    input.setAttribute('class', 'form-control');
    button.setAttribute('type', 'button');
    button.setAttribute('class', 'btn btn-primary');
    if (dato == 1) {
        form.setAttribute('id', 'form-act-mail');
        label.setAttribute('for', 'nuevoCorreo');
        label.textContent = 'Nuevo correo';
        input.setAttribute('type', 'email');
        input.setAttribute('id', 'nuevoCorreo');
        button.setAttribute('id', 'cambiarCorreoButton');
        button.textContent = 'Actualizar correo';
    } else {
        form.setAttribute('id', 'form-act-user');
        label.setAttribute('for', 'nuevoUsuario');
        label.textContent = 'Nuevo usuario';
        input.setAttribute('type', 'text');
        input.setAttribute('id', 'nuevoUsuario');
        button.setAttribute('id', 'cambiarUsuarioButton');
        button.textContent = 'Actualizar usuario';
    }

    div.append(label, input);
    form.append(div, button);
    document.getElementById('container-ajustes').appendChild(form);

    if (dato == 1) { setEventActCorreo(); } else { setEventActUsuario(); }
};

/**
 * Muestra el formulario para actualizar la contraseña.
 * <!---Formulario para actualizar la contraseña-->
    <form class="form" id="form-act-pass" style="visibility: hidden;">
        <div class="mb-3">
            <label for="contraseñaActual" class="form-label">Contraseña actual:</label>
            <input type="password" class="form-control" id="contraseñaActual">
        </div>
        <div class="mb-3">
            <label for="contraseñaNueva" class="form-label">Contraseña nueva:</label>
            <input type="password" class="form-control" id="contraseñaNueva">
        </div>
        <div class="mb-3">
            <label for="confirmacionContraseña" class="form-label">Confirma nueva contraseña:</label>
            <input type="password" class="form-control" id="confirmacionContraseña">
        </div>
        <button type="button" id="cambiarContraseñaButton" class="btn btn-primary">Actualizar contraseña</button>
    </form>
 */
const formActContraseña = () => {
    limpiarFormAct();

    const form = document.createElement('form');
    form.setAttribute('class', 'form');
    form.setAttribute('id', 'form-act-pass');

    const div1 = document.createElement('div');
    const label1 = document.createElement('label');
    const input1 = document.createElement('input');
    div1.setAttribute('class', 'mb-3');
    label1.setAttribute('for', 'contraseñaActual');
    label1.setAttribute('class', 'form-label');
    label1.textContent = 'Contraseña actual:';
    input1.setAttribute('type', 'password');
    input1.setAttribute('class', 'form-control');
    input1.setAttribute('id', 'contraseñaActual');
    div1.append(label1, input1);

    const div2 = document.createElement('div');
    const label2 = document.createElement('label');
    const input2 = document.createElement('input');
    div1.setAttribute('class', 'mb-3');
    label2.setAttribute('for', 'contraseñaNueva');
    label2.setAttribute('class', 'form-label');
    label2.textContent = 'Contraseña nueva:';
    input2.setAttribute('type', 'password');
    input2.setAttribute('class', 'form-control');
    input2.setAttribute('id', 'contraseñaNueva');
    div2.append(label2, input2);

    const div3 = document.createElement('div');
    const label3 = document.createElement('label');
    const input3 = document.createElement('input');
    div1.setAttribute('class', 'mb-3');
    label1.setAttribute('for', 'confirmacionContraseña');
    label3.setAttribute('class', 'form-label');
    label3.textContent = 'Confirma nueva contraseña:';
    input3.setAttribute('type', 'password');
    input3.setAttribute('class', 'form-control');
    input3.setAttribute('id', 'confirmacionContraseña');
    div3.append(label3, input3);

    const button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.setAttribute('id', 'cambiarContraseñaButton');
    button.setAttribute('class', 'btn btn-primary');
    button.textContent = 'Actualizar contraseña';

    form.append(div1, div2, div3, button);
    document.getElementById('container-ajustes').appendChild(form);

    setEventActContra();
};