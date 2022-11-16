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

        const cardTitle = document.createElement('h5');
        cardTitle.setAttribute('class', 'card-title');
        const tituloClase = document.createElement('a');
        tituloClase.setAttribute('href', `http://localhost/sas/vistas/PerfilesPsicologicos.php?i=${clases[i].id}`);
        tituloClase.appendChild(document.createTextNode(clases[i].titulo));
        cardTitle.appendChild(tituloClase);

        const cardSubtitle = document.createElement('h6');
        cardSubtitle.setAttribute('class', 'card-subtitle mb-2');
        cardSubtitle.appendChild(document.createTextNode('Código de clase: '));
        const spanCodigo = document.createElement('span');
        spanCodigo.appendChild(document.createTextNode(clases[i].codigo));
        cardSubtitle.appendChild(spanCodigo);
       
        cardBody.append(cardTitle, cardSubtitle);
        clase.appendChild(cardBody);
        divClases.appendChild(clase);
    }
}