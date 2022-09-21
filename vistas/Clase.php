<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!---Verificamos que los datos de la clase se han definidos sino redirigimos a la página principal.-->
<?php if (!isset($_GET['i']) || !isset($_GET['t'])) : ?>
    <?php header("Location: http://localhost/sas/vistas/HomeProfesor.php"); ?>
    <?php die(); ?>
<?php else : ?>
    <?php $_SESSION['idC'] = htmlentities($_GET['i']); ?>
    <?php $_SESSION['titC'] = htmlentities($_GET['t']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - <?php echo $_SESSION['titC']; ?></title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/clase.css">

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

    <div class="container">
        <!--Encabezado con el título de la clase-->
        <div id="container-titulo" class="container">
            <div class="row">
                <h1 id="h1-titulo"><?php echo $_SESSION['titC']; ?></h1>
            </div>
        </div>

        <!--Sección de las unidades de aprendizaje-->
        <div id="container-unidades-aprendizaje" class="container">
            <!--Sección de una unidad de aprendizaje en específico-->
            <div id="container-unidad-aprendizaje" class="container">
                <!--Sección del título de la unidad de aprendizaje-->
                <div id="row-unidad-aprendizaje" class="row">
                    <span id="unidad-aprendizaje">Unidad de aprendizaje</span>
                </div>
                <!--Sección de los tópicos-->
                <div id="container-topicos" class="container">
                    <a href="">Colota1</a>
                    <a href="">Colita1</a>
                    <a href="">Cola1</a>
                    <button id="agregar-topico">
                        <span>
                            <strong>+</strong>
                        </span>Agregar tópico
                    </button>
                </div>
            </div>

            <div id="container-unidad-aprendizaje" class="container">
                <!--Sección del título de la unidad de aprendizaje-->
                <div id="row-unidad-aprendizaje" class="row">
                    <span id="unidad-aprendizaje">Unidad de aprendizaje</span>
                </div>
                <!--Sección de los tópicos-->
                <div id="container-topicos" class="container">
                    <a href="">Colota2</a>
                    <a href="">Colita2</a>
                    <a href="">Cola2</a>
                    <button id="agregar-topico">
                        <span>
                            <strong>+</strong>
                        </span>Agregar tópico
                    </button>
                </div>
            </div>
        </div>

        <button id="agregar-unidad">Agregar unidad de aprendizaje</button>
    </div>

    <script src="../src/js/obtenerUnidadesAprendizaje.js"></script>
    <script src="../src/js/obtenerTopicos.js"></script>
    <script src="../src/js/crearUATopicos.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>