const verificarDatos = (titulo, descripcion, cuatrimestre, carrera, grupo) => {
    return titulo == '' || descripcion == '' || cuatrimestre == '' || carrera == '' || grupo == '';
}