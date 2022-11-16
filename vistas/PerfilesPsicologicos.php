<?php 
    include '../templates/redirects/redirect_profesor.php'; 
    /*Se reciben el id de la clase*/
    if (isset($_GET['i'])){
        $idClase = htmlentities($_GET['i']); 
        $_SESSION['idClase'] = $idClase;
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Perfiles Psicológicos</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/consulta_usuarios.css">

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

        <!--Obtenemos los cuestionarios asignados a la clase.-->
        <?php include_once '../controladores/consulta_usuarios_perfiles.php'; ?>

        <!--Encabezado de la sección de perfiles psicológicos-->
        <div id="row-titulo" class="row">
            <div id="titulo" class="col-12">Perfiles psicológicos</div>
            <div id="descripcion" class="col">Visualiza los informes de cada estudiante en base los resultados de los cuestionarios.</div>
        </div>

        <!--Tabla de alumnos inscritos a la clase-->
        <div id="usuarios" class="container">
            <table id="tabla-usuarios" class="table">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Paterno</th>
                        <th scope="col">Materno</th>
                        <th scope="col">Opción</th>
                    </tr>
                </thead>
                <?php $num_alumnos = sizeof($alumnos); ?>
                <?php for ($i = 0; $i < $num_alumnos; $i++) : ?>
                    <tr>
                        <td> <?php echo $alumnos[$i]['matricula']; ?></td>
                        <td> <?php echo $alumnos[$i]['nombre']; ?></td>
                        <td> <?php echo $alumnos[$i]['paterno']; ?></td>
                        <td> <?php echo $alumnos[$i]['materno']; ?></td>
                        <td> <button type="button" class="btn btn-info" onclick="location.href=`http://localhost/sas/controladores/generarInforme.php?idUsuario=<?php echo $alumnos[$i]['idUsuario'];?>`">Ver informe</button></td>
                    </tr>
                <?php endfor; ?>
                <tbody id="tabla-usuarios__perfiles"></tbody>
            </table>
        </div>
    </div>

    <!--Script para salir de la sesión-->
    <script src="../src/js/salir.js"></script>
</body>