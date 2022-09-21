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
    const spanTituloUA = document.createElement('span');
    rowUA.setAttribute('id', 'row-unidad-aprendizaje');
    rowUA.setAttribute('class', 'row');
    spanTituloUA.setAttribute('id', 'unidad-aprendizaje');
    spanTituloUA.appendChild(document.createTextNode('Unidad de aprendizaje'));

    // Sección de los tópicos
    // <div id="container-topicos" class="container">
    //  <a href="">Colota1</a>
    //  <button id="agregar-topico">
    //   <span>
    //    <strong>+</strong>
    //   Agregar tópico
    
};