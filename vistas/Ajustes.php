<?php if (isset($_GET) && isset($_GET['t'])) : ?>
    <?php if ($_GET['t'] == 'administrador') : ?>
        <?php include '../templates/redirects/redirect_administrador.php'; ?>
    <?php elseif ($_GET['t'] == 'profesor') : ?>
        <?php include '../templates/redirects/redirect_profesor.php'; ?>
    <?php else : ?>
        <?php include '../templates/redirects/redirect_alumno.php'; ?>
    <?php endif; ?>
<?php else : ?>
    <?php header("Location: ./Login.php"); ?>
    <?php die(); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Ajustes</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>
    <link rel="stylesheet" href="../src/css/cambiarContraseña.css">

    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <?php if ($_SESSION['t'] == 'administrador') : ?>
        <style>
            body {
                background-image: url('../src/img/fondo_administrador.png');
            }
        </style>
    <?php elseif ($_SESSION['t'] == 'profesor') : ?>
        <style>
            body {
                background-image: url('../src/img/fondo_profesor.png');
            }
        </style>
    <?php else : ?>
        <style>
            body {
                background-image: url('../src/img/fondo_alumno.png');
            }
        </style>
    <?php endif; ?>
</head>

<body>
    <!--Incluimos el header de todas las páginas-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <div id="container-ajustes" class="container">
        <div class="row">
            <div id="titulo" class="col-12">Ajustes</div>
            <div id="descripcion" class="col">Selecciona el dato que deseas modificar.</div>
        </div>

        <!--Formulario para seleccionar el dato a actualizar-->
        <select id="select-dato" class="form-select" aria-label="Default select example">
            <option selected>Dato</option>
            <option value="1">Correo</option>
            <option value="2">Usuario</option>
            <option value="3">Contraseña</option>
        </select>

        <!--Formulario para actualizar el correo-->
        <form id="form-act-mail" style="visibility: hidden;">
            <div class="mb-3">
                <label for="nuevoCorreo" class="form-label">Nuevo correo</label>
                <input type="email" class="form-control" id="nuevoCorreo">
            </div>
            <button type="button" id="cambiarCorreoButton" class="btn btn-primary">Actualizar correo</button>
        </form>

        <!--Formulario para actualizar el usuario-->
        <form id="form-act-user" style="visibility: hidden;">
            <div class="mb-3">
                <label for="nuevoUsuario" class="form-label">Nuevo usuario</label>
                <input type="text" class="form-control" id="nuevoUsuario">
            </div>
            <button type="button" id="cambiarUsuarioButton" class="btn btn-primary">Actualizar usuario</button>
        </form>

        <!---Formulario para actualizar la contraseña-->
        <form id="form-act-pass" style="visibility: hidden;">
            <div class="mb-3">
                <label for="contraseñaActual" class="form-label">Contraseña actual:</label>
                <input type="password" class="form-control" id="contraseñaActual">
            </div>
            <div class="mb-3">
                <label for="contraseñaNueva" class="form-label">Contraseña nueva:</label>
                <input type="password" class="form-control" id="contraseñaNueva">
            </div>
            <div class="mb-3">
                <label for="confirmacionContraseña" class="form-label">Confirma nueva contraseña:</label>
                <input type="password" class="form-control" id="confirmacionContraseña">
            </div>
            <button type="button" id="cambiarContraseñaButton" class="btn btn-primary">Actualizar contraseña</button>
        </form>
    </div>

    <script src="../src/js/seleccionarDato.js"></script>
    <script src="../src/js/cambiarUsuario.js"></script>
    <script src="../src//js//cambiarCorreo.js"></script>
    <script src="../src/js/cambiarContraseña.js"></script>
    <script src="../src/js/salir.js"></script>

</body>

</html>