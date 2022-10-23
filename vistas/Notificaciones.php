<?php include '../templates/redirects/redirect_alumno.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Notificaciones</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/notificaciones.css">

    <style>
        body {
            background-image: url('../src/img/fondo_alumno.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas del alumno-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <div class="container">
        <!--Encabezado de la sección de crear clase-->
        <div class="row">
            <div id="titulo" class="col-12">Notificaciones</div>
            <div id="descripcion" class="col">Visualiza las notificaciones de nuevos cuestionarios.</div>
        </div>

        <!--Obtenemos las notificaciones del alumno.-->
        <?php include_once '../controladores/get_notificaciones.php'; ?>

        <!--Sección en la que se muestran las notificaciones del alumno-->
        <div class="accordion" id="accordionExample">
            <?php for ($i = 0; $i < $num_notificaciones; $i++) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button id="buttonShowNoti" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <?php echo $notificaciones[$i]['mensaje']; ?>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Título:</strong> <?php echo $cuestionarios[$i]['titulo']; ?> <br>
                            <strong>Descripción:</strong> <?php echo $cuestionarios[$i]['descripcion']; ?> <br>
                            <strong>Fecha de cierre:</strong> <?php echo $cuestionarios[$i]['fechaCierre']; ?> <br>
                            <a id="buttonResponderCuest" data-id-cuest="<?php echo $cuestionarios[$i]['idCuestionario']; ?>" href="#" class="btn btn-primary">Responder</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <script src="../src/js/salir.js"></script>
</body>

</html>