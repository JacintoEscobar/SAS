<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!---Verificamos que los datos de la clase se han definidos sino redirigimos a la página principal.-->
<?php if (!isset($_GET['i']) || !isset($_GET['t'])) : ?>
    <?php header("Location: http://localhost/sas/vistas/HomeProfesor.php"); ?>
    <?php die(); ?>
<?php else : ?>
    <?php $_SESSION['idC'] = htmlspecialchars($_GET['i'], ENT_QUOTES, 'UTF-8'); ?>
    <?php $_SESSION['titC'] = htmlspecialchars($_GET['t'], ENT_QUOTES, 'UTF-8'); ?>
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
        <!--Obtenemos los cuestionarios del profesor-->
        <?php include '../templates/obtenerCuestionarios.php'; ?>

        <!--Encabezado con el título de la clase-->
        <div id="container-titulo" class="container">
            <div class="row">
                <h1 id="h1-titulo"><?php echo $_SESSION['titC']; ?></h1>
            </div>
        </div>

        <!--Sección de las unidades de aprendizaje-->
        <div id="container-unidades-aprendizaje" class="container">
            <!-- Button trigger modal -->
            <button id="asignarCuestionario" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Asignar cuestionario</button>

            <!--Botón para mostrar el formulario de crear unidad de aprendizaje.-->
            <button id="agregar-unidad" type="button" class="btn btn-warning">Agregar unidad de aprendizaje</button>
        </div>

        <!-- Modal que permite asignar un cuestionario -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Elige un cuestionario para asignar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--Asignamos el html de los cuestionarios-->
                        <?php include_once '../templates/mostrarCuestionarios.php'; ?>
                    </div>
                    <div class="modal-footer">
                        <button id="buttonCerrarModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

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

        <!--Sección para el formulario para crear un tópico.-->
        <!-- Modal -->
        <div class="modal fade" id="div-form-addT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="titulo-addT" class="modal-title" id="exampleModalLabel"></h5>
                        <button id="buttonCancelarAdd" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <section>
                            <header>
                                <span>Llene el formulario para registrar un nuevo tópico.</span>
                            </header>

                            <form action="">
                                <div class="form-group">
                                    <label for="input-titulo-topico">Título</label>
                                    <input type="text" class="form-control" id="input-titulo-topico">
                                </div>
                                <div class="form-group">
                                    <label for="input-descripcion-topico">Descripción</label>
                                    <input type="text" class="form-control" id="input-descripcion-topico">
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="buttonAddT" type="button" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal que permite al profesor seleccionar la fecha de cierre.-->
        <div id="modal">
            <div id="modal-content">
                <span id="close-modal">
                    <img src="../src/img/close.png" alt="close">
                </span>
                <h4 id="modal-title">Selecciona la fecha de cierre para el cuestionario</h4>
                <form id="modal-form">
                    <input id="input-date" name="input-date" type="date" value="" min="" max="2022-12-31">
                    <button id="button-listo" type="button">Listo</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../src/js/limpiarUA.js"></script>
    <script src="../src/js/obtenerUnidadesAprendizaje.js"></script>
    <script src="../src/js/obtenerTopicos.js"></script>
    <script src="../src/js/agregarTopico.js"></script>
    <script src="../src/js/eliminarTopico.js"></script>
    <script src="../src/js/eliminarUA.js"></script>
    <script src="../src/js/crearUATopicos.js"></script>
    <script src="../src/js/agregarUA.js"></script>
    <script src="../src/js/notificarCuestionarioAsignado.js"></script>
    <script src="../src/js/asignarCuestionario.js"></script>
    <script type="text/javascript">
        document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('modal').style.display = 'none';
        });
    </script>
    <script src="../src/js/salir.js"></script>
</body>

</html>