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

        <script src="../src/js/crearCuestionariosHTML.js"></script>
        <script src="../src/js/obtenerCuestionarios.js"></script>
        <script src="../src/js/salir.js"></script>
    </div>
</body>

</html>