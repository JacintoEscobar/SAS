<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Cuestionarios evaluados</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/cuestionarios_evaluados.css">

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

    <!--Sección donde se visualizarán los cuestionarios evaluados-->
    <main class="container">
        <!--Encabezado de la sección de crear clase-->
        <section class="row">
            <header>
                <h2 id="titulo" class="col-12">Resultados</h2>
            </header>
        </section>

        <!--Sección de las clases-->
        <section id="resultados" class="container">
            <header class="row">
                <h4 id="descripcion" class="col">Da clic en un cuestionario para ver tus resultados.</h4>
            </header>

            <!--Obtenemos las evaluaciones del alumno.-->
            <?php include_once '../controladores/getEvaluaciones.php'; ?>
            <?php if (!empty($evaluaciones)) : ?>
                <?php foreach ($evaluaciones as $evaluacion) : ?>
                    <div style="margin: 0.5rem;" class="container">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= print $evaluacion['id']; ?>" aria-expanded="false" aria-controls="collapse<?= print $evaluacion['id']; ?>">
                            <?php print $evaluacion['cuestionario']; ?>
                        </button>
                        <div style="margin: 0.5em;" class="collapse" id="collapse<?= print $evaluacion['id']; ?>">
                            <div id="resumen" class="card card-body">
                                <strong>Título del cuestionario:</strong> <span><?php print $evaluacion['cuestionario']; ?></span> <br>
                                <strong>Puntaje obtenido:</strong> <span><?php print $evaluacion['puntaje']; ?></span> <br>
                                <strong>Etiqueta asignada:</strong> <span><?php print $evaluacion['etiqueta']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-success" role="alert">
                    Aún no tienes cuestionarios evaluados.
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script src="../src/js/salir.js"></script>
</body>

</html>