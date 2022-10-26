<?php include '../templates/redirects/redirect_administrador.php'; ?>

<?php if (isset($_GET['a'])) : ?>
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
            <!--Verificamos que el archivo se haya subida de manera correcta-->
            <?php if (isset($_GET['subida'])) : ?>
                <?php if (htmlspecialchars($_GET['subida'], ENT_QUOTES, 'UTF-8') == 'true') : ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Yei!</strong> Carga del archivo exitosa.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <!--Mostramos el formulario para la confirmación de la restauración-->
                    <div class="mb-3">
                        <!--Preparamos el codigo a ser ingresado.-->
                        <?php $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz'; ?>
                        <?php $codigo = substr(str_shuffle($permitted_chars), 0, 10); ?>

                        <form action="../controladores/restaurar_bd.php" method="POST" class="row g-3">
                            <div class="mb-3">
                                <label style="color: #fff;" for="codigo_sas" class="form-label">Ingresa el sig. Código para confirmar tu acción:</label>
                                <input type="text" class="form-control" id="codigo_sas" name="codigo_sas" value="<?php echo $codigo; ?>" placeholder="<?php echo $codigo; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="codigo_usuario" name="codigo_usuario" placeholder="código">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3">Restaurar base de datos</button>
                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Yei!</strong> Ocurrió un error al realizar la carga del archivo.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!--Verificamos si la restauracion se realizó correctamente-->
            <?php if (isset($_GET['r'])) : ?>
                <?php if (htmlspecialchars($_GET['r'], ENT_QUOTES, 'UTF-8') == 'true') : ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Yei!</strong> Restauración de la base de datos exitosa.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Yei!</strong> Ocurrió un error al realizar la restauración de la base de datos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!--Botones de restauración o respaldo-->
            <button id="button-respaldo" type="button" class="btn btn-primary">Generar respaldo</button>
            <button id="button-restauracion" type="button" class="btn btn-secondary">Subir archivo de restauracion</button>

            <?php if (isset($a)) : ?>
                <form enctype="multipart/form-data" action="../controladores/subir_restauracionBD.php" method="post">
                    <div id="div_input_file" class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control" name="archivo_restauracion" id="inputGroupFile01">
                    </div>
                    <button style="margin: 0px; border: none;" id="button_submit" type="submit" class="btn btn-success">Restaurar</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="../src/js/salir.js"></script>
    <script src="../src/js/respaldoBD.js"></script>

    <!--SweerAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>