/**
 * Crea los elementos html para las ua y los tópicos y los agrega al container principal.
 * @param ua
 * @param topicos Topicos pertenecientes a la ua.
 */
const crearUATopicos = (ua, topicos) => {
    const containerUsAT = document.getElementById('container-unidades-aprendizaje');

    // Sección de una unidad de aprendizaje en específico
    // <div id="container-unidad-aprendizaje" class="container">
    const containerUAT = document.createElement('div');
    containerUAT.setAttribute('id', 'container-unidad-aprendizaje');
    containerUAT.setAttribute('class', 'container');

    // Sección del título de la unidad de aprendizaje
    // <div id="row-unidad-aprendizaje" class="row">
    //   <span id="unidad-aprendizaje">Unidad de aprendizaje</span>
    const rowUA = document.createElement('div');
    rowUA.setAttribute('id', 'row-unidad-aprendizaje');
    rowUA.setAttribute('class', 'row');
    rowUA.setAttribute('idUA', ua.idUnidadAprendizaje);

    const spanTituloUA = document.createElement('span');
    spanTituloUA.setAttribute('id', 'unidad-aprendizaje');
    spanTituloUA.appendChild(document.createTextNode(ua.titulo));

    rowUA.appendChild(spanTituloUA);
    containerUAT.appendChild(rowUA);
    containerUsAT.appendChild(containerUAT);

    // Sección de los tópicos
    // <div id="container-topicos" class="container">
    //  <a href="">Colota1</a>
    //  <button id="agregar-topico">
    //   <span>
    //    <strong>+</strong>
    //   Agregar tópico
    const containerT = document.createElement('div');
    for (const topico of topicos) {
        const aTopico = document.createElement('a');
        containerT.setAttribute('id', 'container-topicos');
        containerT.setAttribute('class', 'container');
        aTopico.setAttribute('href', '');
        aTopico.appendChild(document.createTextNode(`${topico.titulo}: ${topico.descripcion}`));
        containerT.append(aTopico);
    }
    const buttonAgregarT = document.createElement('button');
    const spanAdd = document.createElement('span');
    const strongAdd = document.createElement('strong');

    buttonAgregarT.setAttribute('id', 'agregar-topico');
    strongAdd.appendChild(document.createTextNode('+'));
    spanAdd.append(strongAdd, document.createTextNode('Agregar tópico'));
    buttonAgregarT.appendChild(spanAdd);
    containerT.append(buttonAgregarT);
    containerUAT.appendChild(containerT)
};