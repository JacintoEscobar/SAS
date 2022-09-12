<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Registro individual</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/registro_individual.css">

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
        <div class="row">
            <div id="titulo" class="col-12">Registro individual de alumnos</div>
            <div id="descripcion" class="col-12">Llene el formulario para dar de alta a un alumno.</div>
        </div>

        <!--Sección del formulario-->
        <div id="registro-individual-form" class="container">
            <!--Nombre-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="nombre" class="form-control" type="text" placeholder="Nombre" aria-label="default input example">
                </div>
            </div>
            <!--Paterno-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="paterno" class="form-control" type="text" placeholder="Apellido Paterno" aria-label="default input example">
                </div>
            </div>
            <!--Materno-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="materno" class="form-control" type="text" placeholder="Apellido Materno" aria-label="default input example">
                </div>
            </div>
            <!--Correo-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="correo" class="form-control" type="text" placeholder="Correo Electrónico" aria-label="default input example">
                </div>
            </div>
            <!--Usuario-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="usuario" class="form-control" type="text" placeholder="Usuario" aria-label="default input example">
                </div>
            </div>
            <!--Contraseña-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="contraseña" type="password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <button id="registrarAlumno" type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </div>

    <script src="../src/js/notificarAlumnoRegistro.js"></script>
    <script src="../src/js/registrarAlumno.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>