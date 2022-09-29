<?php include '../templates/redirects/redirect_login.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAS-Login</title>
    <link rel="stylesheet" href="../src/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
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

            <button type="button" id="forget-user" credencial="usuario" class="btn btn-primary" type="submit">Olvidé mi usuario</button>
            <button type="button" id="forget-pass" credencial="contraseña" class="btn btn-primary" type="submit">Olvidé mi contraseña</button>
        </section>

        <!--Sección del formulario para verificar el correo del usuario-->
        <div id="form-verificar-email" class="container" style="visibility: hidden;">
            <button type="button" id="cerrar-form-verificar-email" class="btn btn-danger" style="margin-bottom: 0.8rem;">Cerrar</button> <br>

            <label for="correo" class="form-label">Ingresa tu correo:</label>
            <input type="email" class="form-control" id="correo-verificar" placeholder="name@example.com">
            <!-- <button type="button" ></button> -->
            <div class="col-auto">
                <button type="button" id="verificar-email" class="btn btn-primary mb-3" style="margin-top: 0.8rem;">Verificar</button>
            </div>

        </div>

        <!--Sección para el formulario de restablecer credencial-->
        <form id="form-rest-credencial" style="visibility: hidden;">
            <label for="input-credencial" id="label-credencial" class="form-label"></label>
            <input class="form-control" type="" name="" id="input-credencial" style="margin-bottom: 0.5rem;">

            <button type="button" id="button-cambiar-credencial" class="btn btn-warning">Cambiar</button>
        </form>
    </div>

    <script src="../src/js/login.js"></script>
    <script src="../src/js/restablecerUsuarioContra.js"></script>
    <script src="../src/js/actualizarCredencial.js"></script>
</body>

</html>