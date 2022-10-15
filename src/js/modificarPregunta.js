/**
 * Muestra un promt para recibir la modificacion de una pregunta.
 * @return nueva pregunta o false si se cancelo la modificacion.
 */
const modificarPregunta = () => {
    preguntaModificada = prompt('Modifca tu pregunta:');
    if (preguntaModificada != '')
        return preguntaModificada;
    return false;
}