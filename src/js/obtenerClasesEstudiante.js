// Obtenemos el div en donde se mostrarán las clases del estudiante
const divClases = document.getElementById('clases');

const obtenerClases = () => {
    // Creamos el objeto que permite enviar la solicitud al servidor
    const peticion = new XMLHttpRequest();

    // Definimos las función que se ejecuta cuando se recibe una respuesta del servidor
    peticion.onreadystatechange = () => {
        if (peticion.readyState == 4 && peticion.status == 200) {
            const respuesta = JSON.parse(peticion.response);

            respuesta['ERROR_CONEXION_MYSQL'] ? alert(respuesta['ERROR_CONEXION_MYSQL']) :
                respuesta['ERROR'] ? alert(respuesta['ERROR']) : crearElementosClase(respuesta);
        }
    };

    // Establecemos la conexión
    peticion.open('GET', '../controladores/obtenerClasesEstudiante.php', true);

    // Enviamos la información del formulario a la api
    peticion.send();
};
obtenerClases();

const crearElementosClase = clases => {
    clases.forEach(clase => {
        /* <div class="card" style="width: 18rem;"> */
        const divClase = document.createElement('div');
        divClase.setAttribute('id', clase.idClase);
        divClase.setAttribute('class', 'card');
        divClase.style.width = '18rem';

        /* <div class="card-body"> */
        const cardBody = document.createElement('div');
        cardBody.setAttribute('class', 'card-body');

        /* Definimos el botón que permite darse de baja de una clase */
        const buttonBaja = document.createElement('button');
        buttonBaja.setAttribute('id', 'buttonBaja');
        buttonBaja.setAttribute('type', 'button');
        buttonBaja.appendChild(document.createTextNode('Solicitar baja'));
        buttonBaja.addEventListener('click', () => { solicitarBaja(clase.idClase, clase.nombre) });

        /* <h5 class="card-title">
            <a href="">Seguridad informática</a>
        </h5> */
        const cardTitle = document.createElement('h5');
        cardTitle.setAttribute('class', 'card-title');
        const tituloClase = document.createElement('a');
        tituloClase.setAttribute('href', '#');
        tituloClase.appendChild(document.createTextNode(clase.nombre));
        cardTitle.appendChild(tituloClase);

        /* <h6 class="card-subtitle mb-2">
            Código de clase: <span>SEGICA9ITIA</span>
        </h6> */
        const cardSubtitle = document.createElement('h6');
        cardSubtitle.setAttribute('class', 'card-subtitle mb-2');
        cardSubtitle.appendChild(document.createTextNode('Código de clase: '));
        const spanCodigo = document.createElement('span');
        spanCodigo.appendChild(document.createTextNode(clase.descripcion));
        cardSubtitle.appendChild(spanCodigo);

        cardBody.append(cardTitle, cardSubtitle, buttonBaja);
        divClase.appendChild(cardBody);
        divClases.appendChild(divClase);
    });
};