<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Editar clase</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <!--CSS propio para el formulario de edición y creación de clase-->
    <link rel="stylesheet" href="../src/css/crear_editarClase.css">

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
            <header>
                <h1 id="tituloH1">Llena el formulario para modificar la información de la clase</h1>
            </header>

                <!--Incluimos el formulario para crear o editar una clase-->
                <?php include '../templates/forms/formularioCrearEditarClase.php' ?>

                <div class="button-registrar-editar">
                    <button id="editar">EDITAR</button>
                </div>
            </div>
        </section>
    </main>

    <script src="../src/js/verificarDatos_CrearEditarClase.js"></script>
    <script src="../src/js/editarClase.js"></script>
    <script src="../src/js/salir.js"></script>
    <script src="../src/js/obtenerDatosClaseEditar.js"></script>
</body>

</html>