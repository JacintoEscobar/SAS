<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Cuestionario contenido</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <!--CSS propio para el formulario de edición y creación de clase-->
    <link rel="stylesheet" href="../src/css/crearContenidoCuestionario.css">


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
                <!--Seccion de preguntas individuales-->
                <button type="button" id="addPregunta" class="btn btn-primary">Agregar pregunta</button>

                <!--Seccion de asignar cuestionario-->
                <button type="button" id="asignarCuestionario" class="btn btn-warning">Asignar cuestionario</button>

                <button type="button" id="guardarCambios" class="btn btn-light">Guardar cambios.</button>
            </div>

            <div id="container"></div>

            <!--Seccion de preguntas-->
            <div class="container" id="div-preguntas">
            </div>

            <!-- Seccion del modal que permite crear las preguntas. -->
            <button style="visibility: hidden;" id="mostrarFormCrearCuest" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Creación de preguntas</h1>
                            <button id="cerrarModalCrePX" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--Formulario de creacion de preguntas-->
                            <form id="formCrearPregunta">
                                <label for="inpPregunta">Ingresa la pregunta:</label>
                                <input type="text" name="inpPregunta" id="inpPregunta">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarModalCreP">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="crearPregunta">Crear</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seccion del modal que permite crear las preguntas. -->
            <!-- Button trigger modal -->
            <button style="visibility: hidden;" id="mostrarFormCrearResp" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Launch static backdrop modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Creación de respuestas</h1>
                            <button id="cerrarModalCreRX" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--Formulario de creacion de respuestas-->
                            <form id="formCrearRespuesta">
                                <label for="inpRespuesta">Ingresa la respuesta:</label>
                                <input type="text" name="inpRespuesta" id="inpRespuesta">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarModalCreR">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="crearRespuesta">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../src/js/getCuestCreaContenido.js"></script>
    <script src="../src/js/asignarCuestionario.js"></script>
    <script src="../src/js/guardarCambios.js"></script>
    <script src="../src/js/mostrarOcultarFormCrearPregunta.js"></script>
    <script src="../src/js/verificarRespuesta.js"></script>
    <script src="../src/js/verificarPregunta.js"></script>
    <script src="../src/js/addRespuesta.js"></script>
    <script src="../src/js/addPregunta.js"></script>
    <script src="../src/js/salir.js"></script>
    <script type="text/javascript">
        document.getElementById('cerrarModalCreP').addEventListener('click', () => {
            document.getElementById('inpPregunta').value = '';
        });

        document.getElementById('cerrarModalCrePX').addEventListener('click', () => {
            document.getElementById('cerrarModalCreP').click();
        });
    </script>
    <script type="text/javascript">
        document.getElementById('cerrarModalCreR').addEventListener('click', () => {
            document.getElementById('inpRespuesta').value = '';
            document.getElementById('crearRespuesta').removeAttribute('data-pregunta-refer');
        });

        document.getElementById('cerrarModalCreRX').addEventListener('click', () => {
            document.getElementById('cerrarModalCreR').click();
        });
    </script>
</body>

</html>