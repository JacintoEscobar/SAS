/**
 * Envía una petición para actualizar la credencial del usuairo en la bd.
 * @param tipoCredencial Credencial a actualiar: usuario o contraseña.
 * @param credencial Valor de la nueva credencial.
 */
const actualizarCredencial = (tipoCredencial, credencial) => {
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);
            alert(respuesta);
            bCerrarForm.click();
        }
    };

    // Establecemos la conexión
    peticion.open('POST', 'http://localhost/sas/controladores/actualizarCredencial.php', true);

    peticion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Enviamos la información del formulario a la api
    peticion.send(`t=${tipoCredencial}&c=${credencial}&i=${buttonActuaCred.getAttribute('id-user')}`);
};