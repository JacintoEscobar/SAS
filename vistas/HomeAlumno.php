<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - HomeAlumno</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <!--Incluimos los diseño del menú de funcionalidades-->
    <link rel="stylesheet" href="../src/css/funcionalidades.css">

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

    <div class="container">
        <div class="row">
            <div id="bienvenida" class="col-12">Bienvenido <?php echo $_SESSION['u']; ?></div>
            <div id="funcionalidades-titulo" class="col-12">Funcionalidades:</div>
        </div>
    </div>

    <?php include '../templates/funcionalidades.php'; ?>

    <script src="../src/js/salir.js"></script>
</body>

</html>