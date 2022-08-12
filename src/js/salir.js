const salir = document.getElementById('salir');
salir.addEventListener('click', () => { cerrarSesion(); });

const cerrarSesion = () => {
    //Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    //Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            let respuesta = JSON.parse(peticion.response);

            if (respuesta['EXITO']) {
                alert(respuesta['EXITO']);
                window.location.href = '../vistas/Login.php';
            }
        }
    };

    //Establecemos la conexión
    peticion.open('GET', '../controladores/salir.php', true);

    //Enviamos la información del formulario a la api
    peticion.send();
};