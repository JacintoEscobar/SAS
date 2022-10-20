const url = 'http://localhost/sas/controladores/consulta_usuarios.php';
const request = { method: 'GET' }

/**
 * Se envía una petición para obtener a todos los usuarios registrados en sas.
 * Retorna una promesa con el arreglo de usuarios registrados.
 */
const consulta_usuarios = async () => {
    return await fetch(url, request)
        .then(response => { return response.json(); })
        .catch(error => console.log(error.message));
};

let usuarios = consulta_usuarios();
