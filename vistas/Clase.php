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

        </div>

        <button id="agregar-unidad">Agregar unidad de aprendizaje</button>

        <!--Sección del formulario para crear una ua.-->
        <section id="section-addUA" style="visibility: hidden;">

            <!--Sección para el encabezado del formulario.-->
            <header id="section-addUA__header">
                <h2 id="section-addUA__header__titulo">Creación de unidad de aprendizaje</h2>
                <p id="section-addUA__header__p">Llena el formulario para dar de alta la nueva unidad de aprendizaje.</p>
            </header>

            <!--Formulario para crear una ua.-->
            <form id="section-addUA__form" action="">
                <label for="titulo">Título:</label>
                <input type="text" id="input-titulo">

                <label for="descripcion">Descripcion:</label>
                <input type="text" id="input-descripcion">

                <button id="input-addUA" type="button">Agregar</button>
            </form>
        </section>
    </div>

    <script src="../src/js/obtenerUnidadesAprendizaje.js"></script>
    <script src="../src/js/obtenerTopicos.js"></script>
    <script src="../src/js/crearUATopicos.js"></script>
    <script src="../src/js/agregarUA.js"></script>
    <script src="../src/js/limpiarUA.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>