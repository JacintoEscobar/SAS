<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - PerfilesPsicológicos</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/clases.css">

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
        <!--Encabezado de la sección de perfiles psicológicos-->
        <div id="row-titulo" class="row">
            <div id="titulo" class="col-12">Perfiles psicológicos</div>
            <div id="descripcion" class="col">Selecciona la clase en la que está inscrito el estudiante que deseas analizar.</div>
        </div>

        <div id="clases" class="container">
            <!--Obtener clases-->
        </div>
    </div>

    <script src="../src/js/obtenerClasesPerfiles.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>