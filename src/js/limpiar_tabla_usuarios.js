/**
 * Elimina todos los registros mostrados en la tabla para mostrar otros segun el filtro seleccionado.
 */
const limpiar_tabla_usuarios = () => {
    if (tabla_usuarios.hasChildNodes()) {
        let registro;
        while (registro = tabla_usuarios.querySelector('tr')) {
            tabla_usuarios.removeChild(registro);
        }
    }
};