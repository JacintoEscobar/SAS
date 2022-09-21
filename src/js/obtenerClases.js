// Obtenemos el div en el que se mostrarán las clases del profesor
let divClases = document.getElementById('clases');

// Creamos el objeto que permite enviar la solicitud al servidor
const peticion = new XMLHttpRequest();

// Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
peticion.onreadystatechange = () => {
    if (peticion.readyState == 4 && peticion.status == 200) {
        let respuesta = JSON.parse(peticion.response);

        respuesta['ERROR_DE_CONEXION'] ? alert(respuesta['ERROR_DE_CONEXION']) : crearClases(respuesta['CLASES']);
    }
};

// Establecemos la conexión
peticion.open('GET', '../controladores/obtenerClases.php', true);

// Enviamos la información del formulario a la api
peticion.send();

// Función que crea los elementos html para cada clase. Recibe la información de las clases
const crearClases = (clases) => {
    for (let i = 0; i < clases.length; i++) {
        /* <div class="card" style="width: 18rem;"> */
        const clase = document.createElement('div');
        clase.setAttribute('id', clases[i].codigo);
        clase.setAttribute('class', 'card');
        clase.style.width = '18rem';

        /* <div class="card-body"> */
        const cardBody = document.createElement('div');
        cardBody.setAttribute('class', 'card-body');

        /* <h5 class="card-title">
            <a href="">Seguridad informática</a>
        </h5> */
        const cardTitle = document.createElement('h5');
        cardTitle.setAttribute('class', 'card-title');
        const tituloClase = document.createElement('a');
        tituloClase.setAttribute('href', `http://localhost/sas/vistas/Clase.php?i=${clases[i].id}&t=${clases[i].titulo}`);
        tituloClase.appendChild(document.createTextNode(clases[i].titulo));
        cardTitle.appendChild(tituloClase);

        /* <h6 class="card-subtitle mb-2">
            Código de clase: <span>SEGICA9ITIA</span>
        </h6> */
        const cardSubtitle = document.createElement('h6');
        cardSubtitle.setAttribute('class', 'card-subtitle mb-2');
        cardSubtitle.appendChild(document.createTextNode('Código de clase: '));
        const spanCodigo = document.createElement('span');
        spanCodigo.appendChild(document.createTextNode(clases[i].codigo));
        cardSubtitle.appendChild(spanCodigo);

        /* <button type="button" class="btn btn-outline-success">Editar</button> */
        const buttonEditar = document.createElement('button');
        buttonEditar.setAttribute('type', 'button');
        buttonEditar.setAttribute('class', 'btn btn-outline-success');
        buttonEditar.appendChild(document.createTextNode('Editar'));
        buttonEditar.addEventListener('click', () => {
            window.location.href = `../vistas/EditarClase.php?c=${clases[i].codigo}`;
        });

        /* <button type="button" class="btn btn-outline-warning">Eliminar</button> */
        const buttonEliminar = document.createElement('button');
        buttonEliminar.setAttribute('type', 'button');
        buttonEliminar.setAttribute('class', 'btn btn-outline-warning');
        buttonEliminar.appendChild(document.createTextNode('Eliminar'));
        buttonEliminar.addEventListener('click', () => { eliminarClase(clases[i].id, clases[i].codigo); });

        cardBody.append(cardTitle, cardSubtitle, buttonEditar, buttonEliminar);
        clase.appendChild(cardBody);
        divClases.appendChild(clase);
    }

    /* <div id="crearClase" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="./CrearClase.php">
                        <img src="../src/img/crearClase-icon.png" class="card-img-top" alt="crear-clase">
                        Crear nueva clase
                    </a>
                </h5>
            </div>
        </div>*/
    const crearClase = document.createElement('div');
    crearClase.setAttribute('id', 'crearClase')
    crearClase.setAttribute('class', 'card');
    const crearClaseCardBody = document.createElement('div');
    crearClaseCardBody.setAttribute('class', 'card-body');
    const crearClaseCardTitle = document.createElement('h5');
    crearClaseCardTitle.setAttribute('class', 'card-title');
    const crearClaseA = document.createElement('a');
    crearClaseA.setAttribute('href', './CrearClase.php');
    const crearClaseImg = document.createElement('img');
    crearClaseImg.setAttribute('src', '../src/img/crearClase-icon.png');
    crearClaseImg.setAttribute('class', 'card-img-top');
    crearClaseImg.setAttribute('alt', 'crear-clase');

    crearClaseA.append(crearClaseImg, document.createTextNode('Crear nueva clase'));
    crearClaseCardTitle.appendChild(crearClaseA);
    crearClaseCardBody.appendChild(crearClaseCardTitle);
    crearClase.appendChild(crearClaseCardBody);
    divClases.appendChild(crearClase);
}

const eliminarClase = (id, codigo) => {
    const peticionEliminar = new XMLHttpRequest();

    peticionEliminar.onreadystatechange = () => {
        if (peticionEliminar.readyState == 4 && peticionEliminar.status == 200) {
            let respuesta = JSON.parse(peticionEliminar.response);

            if (respuesta['ERROR_POST']) { alert(respuesta['ERROR_POST']) }
            else if (respuesta['ERROR_POST_DATO']) { alert(respuesta['ERROR_POST_DATO']) }
            else if (respuesta['ERROR_CONEXION']) { alert(respuesta['ERROR_CONEXION']) }
            else if (respuesta['ERROR_EJECUCION']) { alert(respuesta['ERROR_EJECUCION']) }
            else {
                alert(respuesta['EXITO']);
                divClases.removeChild(document.getElementById(codigo));
            }
        }
    };

    peticionEliminar.open('POST', '../controladores/eliminarClase.php', true);
    peticionEliminar.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    peticionEliminar.send(`id=${id}`);
}
