<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!--Verificamos el id del cuestionario.-->
<?php if (!isset($_GET['iC'])) : ?>
    <?php header('Location: http://localhost/sas/vistas/HomeAlumno.php'); ?>
    <?php die(); ?>
<?php else : ?>
    <?php $idCuestionario = htmlspecialchars($_GET['iC'], ENT_QUOTES, 'UTF-8'); ?>
    <?php $_SESSION['idCuestionario'] = $idCuestionario; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Responder cuestionario</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/cuestionario.css">

    <style>
        body {
            background-image: url('../src/img/fondo_alumno.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas del alumno-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <main>
        <!--Obtenemos el cuestionario.-->
        <?php include_once '../controladores/get_cuestionario_alumno.php'; ?>

        <!--Verificamos que el alumno no haya contestado el cuestionario-->
        <?php include_once '../controladores/verificar_cuestionario_contestado.php'; ?>

        <section>
            <!--Sección del contenido del cuestionario.-->
            <div id="container-titulo" class="container">
                <div class="row">
                    <h1 id="titulo-cuestionario">
                        <?php echo $cuestionario['titulo']; ?>
                    </h1>
                    <p id="descripcion-cuestionario">
                        <?php echo $cuestionario['descripcion']; ?>
                    </p>
                </div>
            </div>

            <div class="container" id="div-preguntas">
                <!--Obtenemos las preguntas del cuestionario-->
                <?php include_once '../controladores/get_preguntas_cuestionario.php'; ?>

                <!--Obtenemos las respuestas de las preguntas-->
                <?php include_once '../controladores/get_respuestas_preguntas.php'; ?>

                <?php if (!$haRespondido) : ?>
                    <!--Creamos el html de las preguntas y las respuestas-->
                    <?php for ($i = 0; $i < $num_preguntas; $i++) : ?>
                        <div id="div-pregunta" data-idpregunta="<?php echo $preguntas[$i]['idPregunta']; ?>">
                            <p id="pPregunta">
                                <?php echo $preguntas[$i]['pregunta']; ?>
                            </p>
                            <div id="div-respuestas">
                                <?php $num_respuestas_pregunta = sizeof($respuestas[$i]); ?>
                                <!--Verificamos el tipo de preguntas que tiene el cuestionario-->
                                <?php if ($cuestionario['tipo'] == 'abiertas') : ?>
                                    <!--Mostramos el campo para que el alumno responda las preguntas.-->
                                    <?php for ($j = 0; $j < $num_respuestas_pregunta; $j++) : ?>
                                        <div class="form-floating">
                                            <textarea data-idrespuesta="<?php echo $respuestas[$i][$j]['idRespuestaMultiple']; ?>" class="form-control" placeholder="Leave a comment here" id="respuestaAbierta"></textarea>
                                            <label for="respuestaAbierta">Respuesta:</label>
                                        </div>
                                    <?php endfor; ?>
                                <?php else : ?>
                                    <!--Mostramos las respuestas de la pregunta.-->
                                    <?php for ($j = 0; $j < $num_respuestas_pregunta; $j++) : ?>
                                        <p id="pRespuesta" data-idrespuesta="<?php echo $respuestas[$i][$j]['idRespuestaMultiple']; ?>"><?php echo $respuestas[$i][$j]['contenido']; ?></p>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <button tipo_cuest="<?php echo $cuestionario['tipo']; ?>" id-cuest="<?php echo $cuestionario['idCuestionario']; ?>" type="button" id="enviar-cuestionario" class="btn btn-success">Enviar cuestionario</button>
                <?php else : ?>
                    <div class="alert alert-info" role="alert">
                        Ya has respondido este cuestionario!
                    </div>
                    <button id="bVolverClases" type="button" class="btn btn-success">Volver a las clases</button>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php if (!$haRespondido) : ?>
        <script src="../src/js/getRespuestasAbiertas.js"></script>
        <script src="../src/js/seleccionar_respuesta.js"></script>
        <script src="../src/js/contestar_cuestionario.js"></script>
    <?php else : ?>
        <script type="text/javascript">
            document.getElementById('bVolverClases').addEventListener('click', () => window.location.href = 'http://localhost/sas/vistas/ClasesEstudiante.php');
        </script>
    <?php endif; ?>

    <script src="../src/js/salir.js"></script>
</body>

</html>