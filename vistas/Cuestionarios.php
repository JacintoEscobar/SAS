<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Cuestionarios</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/cuestionarios.css">

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

    <div class="container">
        <!--Encabezado de la sección de crear clase-->
        <div id="row-titulo" class="row">
            <div id="titulo" class="col-12">Cuestionarios</div>
            <div id="descripcion" class="col">Visualiza los cuestionarios creados por ti.</div>
        </div>

        <!--Sección de los cuestionarios-->
        <div id="cuestionarios" class="container">

        </div>

        <!-- Button trigger modal -->
        <button style="visibility: hidden;" id="bm-confir-elimi" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar cuestionario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estas seguro de eliminar el cuestionario?</p>
                        <span><strong>Esta accion no se puede deshacer.</strong></span>
                    </div>
                    <div class="modal-footer">
                        <button id="button-cerrar-md" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="button-confir-elimi" type="button" class="btn btn-primary">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../src/js/crearCuestionariosHTML.js"></script>
        <script src="../src/js/limpiarCuestionarios.js"></script>
        <script src="../src/js/eliminarCuestionario.js"></script>
        <script src="../src/js/obtenerCuestionarios.js"></script>
        <script src="../src/js/salir.js"></script>
    </div>
</body>

</html>