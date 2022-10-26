<?php include '../templates/redirects/redirect_administrador.php'; ?>

<?php if (isset($_GET['a'])): ?>
<?php $a = htmlspecialchars($_GET['a'], ENT_QUOTES, 'UTF-8'); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Gestión de BD</title>
    <link rel="stylesheet" href="../src/css/gestionBD.css">
    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>
    <style>
        body {
            background-image: url('../src/img/fondo_administrador.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas del administrador-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <div id="container-ajustes" class="container">
        <div class="row">
            <div id="titulo" class="col-12">Gestión de base de datos</div>
            <div id="descripcion" class="col">Selecciona la opción que deseas realizar</div>
        </div>

        <div id="container-buttons" class="container">
            <button id="button-respaldo" type="button" class="btn btn-primary">Generar respaldo</button>
            <button id="button-restauracion" type="button" class="btn btn-secondary">Subir archivo
                de restauracion</button>

            <?php if (isset($a)): ?>
            <?php if ($a == 'respaldo'): ?>
            <?php include_once '../controladores/respaldoBD.php'; ?>
            <?php else: ?>
            <form enctype="multipart/form-data" action="" method="post">
                <input type="file" id="archivo_restauracion" name="archivo_restauracion" accept=".sql">
                <button type="submit" class="btn btn-success">Restaurar</button>
            </form>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_FILES['archivo_restauracion'])): ?>
                <?php include_once '../controladores/restauracionBD.php'; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="../src/js/salir.js"></script>
    <script src="../src/js/respaldoBD.js"></script>

    <!--SweerAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>