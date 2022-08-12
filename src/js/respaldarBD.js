// Asignamos el evento al botón de respaldo.
const buttonRespaldar = document.getElementById('respaldarBD');
buttonRespaldar.addEventListener('click', () => respaldarBD());

/**
 * Función que realiza la petición para respaldar la base de datos.
 */
const respaldarBD = () => {
    const peticionRespaldo = new XMLHttpRequest();

    peticionRespaldo.onreadystatechange = () => {
        if (peticionRespaldo.status == 200 && peticionRespaldo.readyState == 4) {
            const respuesta = JSON.parse(peticionRespaldo.response);
            console.log(respuesta);
        }
    };

    peticionRespaldo.open('GET', '../controladores/respaldarBD.php', true);

    peticionRespaldo.send();
};
