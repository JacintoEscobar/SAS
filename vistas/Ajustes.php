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

    <!--Sección para modificar el usuario, el correo o la contraseña-->
    <div id="container-ajustes" class="container">
        <div class="row">
            <div id="titulo" class="col-12">Ajustes</div>
            <div id="descripcion" class="col">Selecciona el dato que deseas modificar.</div>
        </div>

        <!--Formulario para seleccionar el dato a actualizar-->
        <select style="margin-top: 0.4rem;" id="select-dato" class="form-select" aria-label="Default select example">
            <option selected>Dato</option>
            <option value="1">Correo</option>
            <option value="2">Usuario</option>
            <option value="3">Contraseña</option>
        </select>
    </div>

    <!--Sección para modificar la imagen de perfil-->
    <div class="container">
        <!--Sección para modificar la img de perfil-->
        <hr>
        <div class="container">
            <div class="row">
                <div id="descripcion" class="col">¿Deseas cambiar tu imagen de perfil?</div>
            </div>

            <div class="row">
                <div class="col-2">
                    <!--Obtenemos la imagen que subió el usuario-->
                    <?php include_once '../controladores/getImgPerfil.php'; ?>
                    <img id="img-perfil" src="<?php echo $img; ?>" class="rounded float-start" alt="perfil">
                </div>
                <div class="col">
                    <form id="form-img" action="../controladores/setImgPerfil.php" method="POST" enctype="multipart/form-data">
                        <input class="form-control" type="file" id="img_perfil" name="img_perfil" required>
                        <button type="submit" class="btn btn-primary mb-3">Cambiar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../src/js/seleccionarDato.js"></script>
    <script src="../src/js/cambiarUsuario.js"></script>
    <script src="../src//js//cambiarCorreo.js"></script>
    <script src="../src/js/cambiarContraseña.js"></script>
    <script src="../src/js/salir.js"></script>

</body>

</html>