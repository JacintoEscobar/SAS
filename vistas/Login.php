<?php include '../templates/redirects/redirect_login.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAS-Login</title>
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <!--Sección del contenedor principal-->
    <div class="contenedor">

        <!--Sección del contenedor del formulario-->
        <section class="formulario">
            <header>
                <h1>BIENVENIDO</h1>
            </header>

            <div class="campos-formulario">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario">

                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña">

                <button id="iniciar-sesion">ENTRAR</button>
            </div>

        </section>

        <!--Sección del contenedor de la imagen del login-->
        <div class="logo">

        </div>
    </div>

    <script src="../src/js/login.js"></script>
</body>

</html>