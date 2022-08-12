<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Clases Estudiante</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/clases-estudiante.css">

    <style>
        body {
            background-image: url('../src/img/fondo_alumno.png');
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
        <div class="row">
            <div id="titulo" class="col-12">Clases</div>
            <div id="descripcion" class="col">Visualiza las clases en las que estás inscrito.</div>
        </div>

        <!--Sección de las clases-->
        <div id="clases" class="container">
            <!--Clases del alumno-->

            <!-- Modal -->
            <div class="modal fade" id="modalUnirseClase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Inscribirse a una clase</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input id="codigoClase" class="form-control" type="text" placeholder="Código de clase" aria-label="default input example">
                        </div>
                        <div class="modal-footer">
                            <button id="cerrarModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="buttonSolicitarUnirse" type="button" class="btn btn-primary">Unirse</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Button trigger modal-->
            <button id="button_inscribirse" type="button" data-bs-toggle="modal" data-bs-target="#modalUnirseClase">
                <img src="../src/img/unirseClase-icon.png" class="card-img-top" alt="crear-clase">
                Inscríbete en una nueva clase
            </button>
        </div>
    </div>

    <script src="../src/js/obtenerClasesEstudiante.js"></script>
    <script src="../src/js/unirseClase.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>