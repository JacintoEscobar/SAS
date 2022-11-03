<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Cuestionario contenido</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <!--CSS propio para el formulario de edición y creación de clase-->
    <link rel="stylesheet" href="../src/css/crearContenidoCuestionario.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('../src/img/fondo_profesor.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas de profesor-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <main>
        <section>
            <div id="container-titulo" class="container">
                <div class="row">
                    <h1 id="titulo-cuestionario"></h1>
                    <p id="descripcion-cuestionario"></p>
                </div>
            </div>

            <div class="container">
                <button type="button" id="addPregunta" class="btn btn-info">Agregar pregunta</button>

                <button type="button" id="guardarCambios" class="btn btn-warning">Guardar cambios.</button>
            </div>

            <!--Seccion de preguntas-->
            <div class="container" id="div-preguntas"></div>

            <!-- Seccion del modal que permite crear preguntas y respuestas, ademas de editar preguntas y respuestas -->
            <button id="buttMostrModal" style="visibility: hidden;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>

            <!-- Modal -->
            <div button-pressed="" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button id="buttClosModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="form-modal" class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button id="buttCancModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!--Script para obtener y mostrar los datos del formulario-->
    <script src="../src/js/getCuestDatos.js"></script>

    <!--Scripts para crear y mostrar los elementos html de las preguntas obtenidas de la bd-->
    <script src="../src/js/addPregunta.js"></script>
    <script src="../src/js/addRespuesta.js"></script>

    <!--Script para obtener de la bd las preguntas y respuestas del cuestionario-->
    <script src="../src/js/getCuestConte.js"></script>

    <!--Script para editar o eliminar una pregunta-->
    <script src="../src/js/eliminarPregunta.js"></script>
    <script src="../src/js/modificarPregunta.js"></script>

    <!--Script para configurar el click de los botones addPRegunta, asignarCuestionario y guardarCambios-->
    <script src="../src/js/confButtonAddPreg.js"></script>

    <!--Script para guardar los cambios de las preguntas y respuestas en la base de datos-->
    <script src="../src/js/guardarCambios.js"></script>

    <!--Script para redirigir a la página de resultados en caso de que el cuestionario ya se encuentre asignado a los alumno-->
    <script src="../src/js/verificarCuestiAsignado.js"></script>

    <script src="../src/js/salir.js"></script>
</body>

</html>