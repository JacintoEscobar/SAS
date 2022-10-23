<?php include '../templates/redirects/redirect_alumno.php'; ?>

<?php if (!isset($_GET['idC']) || !isset($_GET['nom'])) : ?>
    <?php header('Location: http://localhost/sas/vistas/ClasesEstudiante.php'); ?>
    <?php die(); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - </title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/clase-estudiante.css">

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

    <div class="container">
        <!--Obtenemos los cuestionarios asignados a la clase.-->
        <?php include_once '../controladores/get_cuestionarios_disponibles.php'; ?>

        <!--Encabezado de la sección de crear clase-->
        <div class="row">
            <div id="titulo" class="col-12"> <?php echo htmlspecialchars($_GET['nom'], ENT_QUOTES, 'UTF-8'); ?> </div>
            <div id="descripcion" class="col">Cuestionarios disponibles.</div>
        </div>

        <!--Sección de los cuestionarios disponibles-->
        <div id="div-cuestionarios-disponibles" class="row">
            <?php $num_cuestionarios = sizeof($cuestionarios); ?>
            <?php for ($i = 0; $i < $num_cuestionarios; $i++) : ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"> <?php echo $cuestionarios[$i]['titulo']; ?> </div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $cuestionarios[$i]['descripcion']; ?> </h5>
                            <p class="card-text">Fecha de cierre: <strong><?php echo $cuestionarios[$i]['fechaCierre']; ?></strong></p>
                            <a data-id-cuest="<?php echo $cuestionarios[$i]['idCuestionario']; ?>" href="#" class="btn btn-primary">Responder</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <script src="../src/js/salir.js"></script>
</body>

</html>