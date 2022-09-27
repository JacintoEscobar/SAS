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

            <button type="button" id="forget-user" credencial="usuario">Olvidé mi usuario</button>
            <button type="button" id="forget-pass" credencial="contraseña">Olvidé mi contraseña</button>
        </section>

        <!--Sección del contenedor de la imagen del login-->
        <div class="logo">

        </div>

        <!--Sección del formulario para verificar el correo del usuario-->
        <div id="form-verificar-email" class="mb-3" style="visibility: hidden;">
            <button type="button" id="cerrar-form-verificar-email">Cerrar</button>
            <label for="correo" class="form-label">Ingresa tu correo:</label>
            <input type="email" class="form-control" id="correo-verificar" placeholder="name@example.com">
            <button type="button" id="verificar-email">Verificar</button>
        </div>

        <!--Sección para el formulario de restablecer credencial-->
        <form id="form-rest-credencial" style="visibility: hidden;">
            <label for="input-credencial" id="label-credencial"></label>
            <input type="" name="" id="input-credencial">
            <button type="button" id="button-cambiar-credencial">Cambiar</button>
        </form>
    </div>

    <script src="../src/js/login.js"></script>
    <script src="../src/js/restablecerUsuarioContra.js"></script>
    <script src="../src/js/actualizarCredencial.js"></script>
</body>

</html>