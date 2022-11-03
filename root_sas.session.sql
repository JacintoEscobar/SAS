SELECT
    cuestionario.idCuestionario as idC,
    cuestionario.titulo as tituloC,
    pregunta.idPregunta as idP,
    pregunta.pregunta as pregunta,
    respuestamultiple.idRespuestaMultiple as idRMultiple,
    respuestamultiple.contenido as contenidoRMultiple,
    respuestaalumno.idRespuestaAlumno as idRAlumno,
    respuestaalumno.contenido as contenidoRAlumno,
    usuario.idUsuario as idU,
    usuario.nombre as nombreU
FROM usuario
INNER JOIN respuestaalumno ON respuestaalumno.idUsuario = usuario.idUsuario
INNER JOIN respuestamultiple ON respuestaalumno.idRespuestaMultiple = respuestamultiple.idRespuestaMultiple
INNER JOIN pregunta ON respuestamultiple.idPregunta = pregunta.idPregunta
INNER JOIN cuestionario ON pregunta.idCuestionario = cuestionario.idCuestionario;