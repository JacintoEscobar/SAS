<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!--Verificamos la petición GET-->
<?php if (!isset($_GET['idc']) || !isset($_GET['nom'])) : ?>
    <?php header("Location: http://localhost/sas/vistas/HomeAlumno.php") ?>
    <?php die(); ?>
<?php endif; ?>

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

        <!--Obtenemos el material educativo del alumno-->
        <?php include_once '../controladores/getMaterialAlumno.php'; ?>
        <?php $materiales = getMaterial($_SESSION['i'], htmlspecialchars($_GET['idc'], ENT_QUOTES, 'UTF-8')); ?>

        <!--Verificamos que no haya ocurido algún error.-->
        <?php if (!isset($materiales['ERROR'])) : ?>
            <?php if (!empty($materiales)) : ?>
                <!--Mostramos los materiales educativos al alumno.-->
                <div style="margin-top: 1rem;" id="materiales" class="container">
                    <div class="row">
                        <?php foreach ($materiales as $material) : ?>
                            <div class="col-sm-6">
                                <div style="margin: 1rem;" class="card">
                                    <div class="card-body">
                                        <?php if ($material->Tipo == 'archivo') : ?>
                                            <?php $_SESSION['dir'] = $material->Direccion; ?>
                                        <?php endif; ?>
                                        <h5 id="material" data-tipo="<?php print $material->Tipo; ?>" class="card-title"><?php print $material->Material; ?></h5>
                                        <p class="card-text">
                                            <strong>Tipo: </strong> <span><?php print $material->Tipo; ?></span> <br>
                                            <?php if ($material->Tipo == 'enlace') : ?>
                                                <strong>Dirección: </strong> <span id="direccion"><?php print $material->Direccion; ?></span> <br>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <div style="margin-top: 0.8rem;" class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Todo bien!</strong> Aún no tienes material educativo asignado en esta clase.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div style="margin-top: 0.8rem;" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> <?php print $materiales['ERROR']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </main>

    <script src="../src/js/abrirMaterial.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>