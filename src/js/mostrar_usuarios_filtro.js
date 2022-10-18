const filtro = document.getElementById('select-filtro');
filtro.addEventListener('change', () => {
    limpiar_tabla_usuarios();

    filtro.value === 'todo' ? mostrar_usuarios_todo() :
        filtro.value === 'administrador' ? filtrar_administrador() :
            filtro.value === 'profesor' ? filtrar_profesor() : filtrar_alumno();
});

/**
 * Muestra a los usuarios que son de tipo administrador.
 */
const filtrar_administrador = () => { };

/**
 * Muestra a los usuarios que son de tipo profesor.
 */
const filtrar_profesor = () => { };

/**
* Muestra a los usuarios que son de tipo alumno.
*/
const filtrar_alumno = () => { };
