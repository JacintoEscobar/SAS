<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Material educativo</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/material_educativo.css">

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

    <main class="container">
        <!--Encabezado de la sección de crear clase-->
        <header class="row">
            <h2 id="titulo" class="col-12">Material educativo</h2>
            <h4 id="descripcion" class="col">Aquí puedes ver el material educativo de tu clase <?php print $_GET['nom']; ?></h4>
        </header>

        <section class="container">
            <!--Obtenemos el material educativo del alumno-->
        </section>
    </main>

    <script src="../src/js/salir.js"></script>
</body>

</html>