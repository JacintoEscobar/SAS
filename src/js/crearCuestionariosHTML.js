/**
 * Crea y configura los elementos HTML referentes a cada cuestionario.
 * @param cuestionarios Arreglo de cuestionarios obtenidos de la bd.
 */
const crearCuestionariosHTML = cuestionarios => {
    // Obtenemos el container donde se agregaran los elementos de los cuestionarios.
    const divContCuestionarios = document.getElementById('cuestionarios');

    // Recorremos los cuestionarios y creamos los elementos html para cada uno.
    for (let i = 0; i < cuestionarios.length; i++) {
        /**
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="">PruebaCuestionario2</a>
                </h5>
                <button id="button-editar-cuestionario" type="button" class="btn btn-outline-success">
                    <img src="../src/img/editarCuestionario.png" alt="editar cuestionario">
                </button>
                <button id="button-eliminar-cuestionario" type="button" class="btn btn-outline-warning">
                    <img src="../src/img/eliminarCuestionario.png" alt="eliminar cuestionario">
                </button>
            </div>
        </div>
        */
        // Div card del cuestionario.
        const cardCuestionario = document.createElement('div');
        cardCuestionario.setAttribute('class', 'card');
        cardCuestionario.setAttribute('id', 'cardCuestionario');
        cardCuestionario.style.width = '18rem';

        // Div del título del cuestionario.
        const cardBodyCuestionario = document.createElement('div');
        cardBodyCuestionario.setAttribute('class', 'card-body');

        // Titulo del cuestionario.
        const cardTitleCuestionario = document.createElement('h5');
        cardTitleCuestionario.setAttribute('class', 'card-title');

        // a para enviar a la página de edición de la información del cuestionario.
        const aCuestionario = document.createElement('a');
        aCuestionario.setAttribute('href', '');

        aCuestionario.appendChild(document.createTextNode(cuestionarios[i].titulo));
        cardTitleCuestionario.appendChild(aCuestionario);

        // Botón para editar la información del cuestionario.
        const bEditCuestionario = document.createElement('button');
        bEditCuestionario.setAttribute('id', 'button-editar-cuestionario');
        bEditCuestionario.setAttribute('type', 'button');
        bEditCuestionario.setAttribute('class', 'btn btn-outline-success');

        // Imagen del botón de editar información del cuestionario.
        const imgEditCuestionario = document.createElement('img');
        imgEditCuestionario.setAttribute('src', '../src/img/editarCuestionario.png');
        imgEditCuestionario.setAttribute('alt', 'editar cuestionario');

        bEditCuestionario.appendChild(imgEditCuestionario);

        // Botón para eliminar el cuestionario.
        const bElimCuestionario = document.createElement('button');
        bElimCuestionario.setAttribute('id', 'button-eliminar-cuestionario');
        bElimCuestionario.setAttribute('type', 'button');
        bElimCuestionario.setAttribute('class', 'btn btn-outline-warning');
        bElimCuestionario.addEventListener('click', () => {
            const bmConfiElimi = document.getElementById('bm-confir-elimi');
            bmConfiElimi.click();
            // Asignamos el id como un atributo al boton del modal que confirma la eliminacion del cuestionario.
            const bModalEliminar = document.getElementById('button-confir-elimi');
            bModalEliminar.setAttribute('data-id', cuestionarios[i].idCuestionario);
        });

        // Imagen del botón de eliminar información del cuestionario.
        const imgElimCuestionario = document.createElement('img');
        imgElimCuestionario.setAttribute('src', '../src/img/eliminarCuestionario.png');
        imgElimCuestionario.setAttribute('alt', 'eliminar cuestionario');

        bElimCuestionario.appendChild(imgElimCuestionario);

        cardBodyCuestionario.append(cardTitleCuestionario, bEditCuestionario, bElimCuestionario);
        cardCuestionario.appendChild(cardBodyCuestionario);
        divContCuestionarios.appendChild(cardCuestionario);
    }

    // Creamos y diseñamos el boton para crear un cuestionario.
    const crearCuestionario = document.createElement('div');
    crearCuestionario.setAttribute('id', 'crearCuestionario')
    crearCuestionario.setAttribute('class', 'card');
    const CrearCuestionarioCardBody = document.createElement('div');
    CrearCuestionarioCardBody.setAttribute('class', 'card-body');
    const crearCuestionarioCardTitle = document.createElement('h5');
    crearCuestionarioCardTitle.setAttribute('class', 'card-title');
    const crearCuestionarioA = document.createElement('a');
    crearCuestionarioA.setAttribute('href', './CrearCuestionario.php');
    const crearCuestionarioImg = document.createElement('img');
    crearCuestionarioImg.setAttribute('src', '../src/img/crearCuestionario-icon.png');
    crearCuestionarioImg.setAttribute('class', 'card-img-top');
    crearCuestionarioImg.setAttribute('alt', 'crear-cuestionario');

    crearCuestionarioA.append(crearCuestionarioImg, document.createTextNode('Crear nuevo cuestionario'));
    crearCuestionarioCardTitle.appendChild(crearCuestionarioA);
    CrearCuestionarioCardBody.appendChild(crearCuestionarioCardTitle);
    crearCuestionario.appendChild(CrearCuestionarioCardBody);
    divContCuestionarios.appendChild(crearCuestionario);
};