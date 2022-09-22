/**
 * Elimina los elementos html correspondientes a las ua.
 */
const limpiarUA = () => {
    const containerUsAT = document.getElementById('container-unidades-aprendizaje');
    let ua;

    while (ua = document.getElementById('container-unidad-aprendizaje')) {
        containerUsAT.removeChild(ua);
    }
};