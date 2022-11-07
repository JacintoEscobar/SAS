<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!--Verificamos que se haya redirigido de manera correcta a esta página-->
<?php if (!isset($_GET['i']) || !isset($_GET['c'])) : ?>
    <?php header("Location: http://localhost/sas/vistas/HomeProfesor.php"); ?>
    <?php die(); ?>
<?php endif; ?>

<!--Obtenemos el id y el título del cuestionario-->
<?php $idCuestionario = htmlspecialchars($_GET['i'], ENT_QUOTES, 'UTF-8'); ?>
<?php $tituloCuestionario = htmlspecialchars($_GET['c'], ENT_QUOTES, 'UTF-8'); ?>

<!--Obtenemos el tipo del cuestionario-->
<?php include_once '../controladores/getTipoCuestionario.php'; ?>

<!--Obtenemos las etiquetas creadas y el id máximo-->
<?php include_once '../controladores/get_etiquetas.php'; ?>
<?php $etiquetas = getEtiquetas(); ?>
<?php $maxIdEtiqueta = getMaxId(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Resultados</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/resultados_cuestionario.css">

    <style>
        body {
            background-image: url('../src/img/fondo_profesor.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        /*Diseño del div de la simbología*/
        #div_simbologia {
            background-color: rgb(255, 255, 255);
            padding: 0.5rem;
            border-radius: 3px;
        }

        /*Diseño de los parrafos de las preguntas*/
        strong span,
        strong p,
        #pregunta {
            font-family: 'Quicksand', sans-serif;
        }

        #p_instruccion {
            margin: 0.5em;
        }

        #span_puntaje-obtenido {
            font-family: 'Dosis', sans-serif;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas de profesor-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <div class="container">
        <div class="row">
            <div id="titulo" class="col-12">Resultados de <?php echo $tituloCuestionario; ?></div>
            <div id="descripcion" class="col">Selecciona un alumno para ver sus resultados.</div>
        </div>

        <!--Sección del botón que permite crear una nueva etiqueta-->
        <div style="margin: 0.4rem 0px; padding: 0px;" class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Crear etiqueta</button>
        </div>

        <!--Sección de la simbología-->
        <div style="margin-top: 0.4rem;" id="div_simbologia" class="container">
            <strong><span>Simbología:</span></strong>
            <p id="p_instruccion" style="color: rgb(0, 155, 0);">Respuesta correcta</p>
            <p id="p_instruccion" style="color: rgb(0, 0, 155);">Respuesta del alumno correcta</p>
            <p id="p_instruccion" style="color: rgb(155, 0, 0);">Respuesta del alumno incorrecta</p>
        </div>

        <!--Sección del modal que tiene el formulario para crear etiqueta-->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear nueva etiqueta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controladores/crear_etiqueta.php" method="POST">
                            <div class="mb-3">
                                <label for="id_etiqueta" class="form-label">ID:</label>
                                <input required class="form-control" type="text" id="id_etiqueta" name="id_etiqueta" value="<?php echo ++$maxIdEtiqueta; ?>" aria-label="readonly input example" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_etiqueta" class="form-label">Etiqueta:</label>
                                <input required type="text" class="form-control" id="nombre_etiqueta" name="nombre_etiqueta" aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Sección de los alumnos que respondieron el cuestionario-->
        <div style="margin-top: 1rem;" id="alumnos" class="container">
            <div class="accordion" id="accordionExample">
                <!----------------------------------------------------Obtenemos a los alumnos que respondieron el cuestionario------------------------------------------------------>
                <?php include_once '../controladores/get_alumnos_respondieron.php'; ?>
                <?php foreach ($alumnos as $alumno) : ?>
                    <!--Verificamos que el alumno aún no haya sido evaluado en el cuestionario-->
                    <?php include_once '../controladores/verificarAlumnoEvaluado.php'; ?>
                    <?php if (verificarAlumnoEvaludo($alumno['idU'], $idCuestionario)) : ?>
                        <!--Definimos el contador de puntos obtenidos por el alumno-->
                        <?php $puntaje = 0; ?>
                        <div style="margin: 0.5rem;" class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $alumno['idU']; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $alumno['idU']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $alumno['idU']; ?>">
                                    <?php echo $alumno['alumno'] . ' ' . $alumno['paterno']; ?>
                                    <strong style="margin-left: 2rem; color: rgb(41, 123, 171);"><span>Ver resultados</span></strong>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $alumno['idU']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $alumno['idU']; ?>">
                                <div class="accordion-body">
                                    <div id="preguntas" class="container">
                                        <!------------------------------------------------------Obtenemos las preguntas del cuestionario------------------------------------------------------>
                                        <?php include_once '../controladores/get_preguntas_cuestionario.php'; ?>
                                        <?php foreach ($preguntas as $pregunta) : ?>
                                            <div class="container" id="div-pregunta">
                                                <p data-idPregunta="<?php echo $pregunta['idPregunta']; ?>" id="pregunta" class="fw-light"><?php echo $pregunta['pregunta']; ?></p>

                                                <div class="container" id="div-respuestas">
                                                    <!------------------------------------------------------Obtenemos todas respuestas de la pregunta------------------------------------------------------>
                                                    <?php include_once '../controladores/get_respuestas_preguntas.php'; ?>
                                                    <?php foreach ($respuestas as $respuesta) : ?>
                                                        <?php foreach ($respuesta as $respuestaPregunta) : ?>
                                                            <?php if ($pregunta['idPregunta'] == $respuestaPregunta['idPregunta']) : ?>
                                                                <!--Para cada respuesta multiple obtenemos su registro en respuesta alumno-->
                                                                <!--esto para saber si la respuesta actual es la seleccionada por el alumno.-->
                                                                <?php include_once '../controladores/get_respuestas_alumno.php'; ?>
                                                                <?php if ($tipoCuestionario == 'cerradas') : ?>
                                                                    <?php if ($respuestaPregunta['tipo'] == 'correcta') : ?>
                                                                        <?php if (verificarRespuesta($respuestaPregunta['idRespuestaMultiple'], $alumno['idU'])) : ?>
                                                                            <!--Contamos las respuestas correctas del alumno-->
                                                                            <?php $puntaje++; ?>
                                                                            <strong style="color: rgb(0, 0, 155);" id="respuesta_alumno" data_puntaje="correcta">
                                                                                <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                            </strong>
                                                                        <?php else : ?>
                                                                            <strong style="color: rgb(0, 155, 0);" id="respuesta_sistema" data_puntaje="correcta">
                                                                                <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                            </strong>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if (verificarRespuesta($respuestaPregunta['idRespuestaMultiple'], $alumno['idU'])) : ?>
                                                                            <strong style="color: rgb(155, 0, 0);" id="respuesta_alumno" data_puntaje="correcta">
                                                                                <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                            </strong>
                                                                        <?php else : ?>
                                                                            <strong id="respuesta_sistema" data_puntaje="correcta">
                                                                                <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                            </strong>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <?php if ($respuestaPregunta['contenido'] == getRespuestaAlumno($respuestaPregunta['idRespuestaMultiple'], $alumno['idU'])) : ?>
                                                                        <!--Contamos las respuestas correctas del alumno-->
                                                                        <?php $puntaje++; ?>
                                                                        <strong style="color: rgb(0, 0, 155);" id="respuesta_alumno" data_puntaje="correcta">
                                                                            <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                        </strong>
                                                                    <?php else : ?>
                                                                        <strong style="color: rgb(0, 155, 0);" id="respuesta_alumno" data_puntaje="correcta">
                                                                            <p> ↳ <?php echo $respuestaPregunta['contenido']; ?></p>
                                                                        </strong>
                                                                        <strong style="color: rgb(155, 0, 0);" id="respuesta_alumno" data_puntaje="correcta">
                                                                            <p> ↳ <?php echo getRespuestaAlumno($respuestaPregunta['idRespuestaMultiple'], $alumno['idU']) ?></p>
                                                                        </strong>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!------Sección del puntaje, la asignación de etiqueta y la evaluación del cuestionario al alumno------>
                                    <div class="container">
                                        <div class="form-floating">
                                            <select id="select_etiqueta" name="etiqueta" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="0" selected>Mostrar etiquetas</option>
                                                <?php foreach ($etiquetas as $etiqueta) : ?>
                                                    <option id="option_etiqueta" data-idEtiqueta="<?php echo $etiqueta['idEtiqueta']; ?>" value="<?php echo $etiqueta['nombre']; ?>"><?php echo $etiqueta['nombre']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="floatingSelect">Etiqueta emocional para el alumno</label>

                                            <button data-idAlumo="<?php echo $alumno['idU']; ?>" style="margin: 0.8rem 0px;" id="asignarEtiqueta" type="button" class="btn btn-success">Asignar etiqueta</button>
                                            <button data-puntaje="<?php print $puntaje; ?>" data-idA="<?php print $alumno['idU']; ?>" data-idC="<?php print $idCuestionario; ?>" type="button" class="btn btn-primary" id="evaluar">Evaluar</button>
                                        </div>
                                        <span id="span_puntaje-obtenido" style="font-weight: 600;">Puntaje obtenido: <i><strong><?php print $puntaje; ?></strong></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../src/js/salir.js"></script>
    <script src="../src/js/asignarEtiqueta.js"></script>
    <script src="../src/js/evaluarCuestionario.js"></script>

</body>

</html>