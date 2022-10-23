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

        let span_button_baja;
        const cardTitle = document.createElement('h5');
        cardTitle.setAttribute('class', 'card-title');
        let tituloClase;
        if (clase.estado == 'activo') {
            /* Definimos el botón que permite darse de baja de una clase */
            span_button_baja = document.createElement('button');
            span_button_baja.setAttribute('id', 'buttonBaja');
            span_button_baja.setAttribute('type', 'button');
            span_button_baja.appendChild(document.createTextNode('Solicitar baja'));
            span_button_baja.addEventListener('click', () => { solicitarBaja(clase.idClase, clase.nombre) });

            /* <h5 class="card-title">
                <a href="">Seguridad informática</a>
            </h5> */
            tituloClase = document.createElement('a');
            tituloClase.setAttribute('href', `./ClaseEstudiante.php?idC=${clase.idClase}&nom=${clase.nombre}`);
        } else {
            /*  <span id="labelBajaPendiente">
                    <strong> Esta clase está en proceso de baja. </strong>
                </span>
             */
            /* Definimos un label que informe que la clase se encuentra en proceso de baja */
            span_button_baja = document.createElement('span');
            span_button_baja.setAttribute('id', 'labelBajaPendiente');
            const strongMensaje = document.createElement('strong');
            strongMensaje.appendChild(document.createTextNode('Esta clase está en proceso de baja.'));
            strongMensaje.style.fontSize = '0.9em';
            span_button_baja.appendChild(strongMensaje);

            /* <h5 class="card-title">
                <span>Seguridad informática</span>
            </h5> */
            tituloClase = document.createElement('span');
        }
        tituloClase.appendChild(document.createTextNode(clase.nombre));
        cardTitle.appendChild(tituloClase);

        /* <h6 class="card-subtitle mb-2">
            Código de clase: <span>SEGICA9ITIA</span>
        </h6> */
        const cardSubtitle = document.createElement('h6');
        cardSubtitle.setAttribute('class', 'card-subtitle mb-2');
        cardSubtitle.appendChild(document.createTextNode('Código de clase: '));
        const spanCodigo = document.createElement('span');
        spanCodigo.appendChild(document.createTextNode(clase.codigo));
        cardSubtitle.appendChild(spanCodigo);

        cardBody.append(cardTitle, cardSubtitle, span_button_baja);
        divClase.appendChild(cardBody);
        divClases.appendChild(divClase);
    });
};