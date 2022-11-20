<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!---Verificamos que los datos de la clase se han definidos sino redirigimos a la página principal.-->
<?php if (!isset($_GET['idC']) || !isset($_GET['titC'])) : ?>
    <?php header("Location: http://localhost/sas/vistas/HomeProfesor.php"); ?>
    <?php die(); ?>
<?php else : ?>
    <?php $_SESSION['idC'] = htmlspecialchars($_GET['idC'], ENT_QUOTES, 'UTF-8'); ?>
    <?php $_SESSION['titC'] = htmlspecialchars($_GET['titC'], ENT_QUOTES, 'UTF-8'); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - <?php echo $_SESSION['titC']; ?></title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/graficos.css">

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

    <!--Buscamos los cuestionarios que han sido aplicados a la clase-->
    <?php include_once '../controladores/consultaCuestionarios.php'; ?>

    <div class="container">

        <!--Encabezado con el título de la clase-->
        <div id="container-titulo" class="container">
            <div class="row">
                <h1 id="h1-titulo"><?php echo $_SESSION['titC']; ?></h1>
                <h5 id="h5-subtitulo">Reportes Gráficos</h5>
            </div>
        </div>


        <!--Filtro para selección del cuestionario del que se desea examinar un reporte gráfico*-->
        <div id="filtro" class="container-md">
            <form method="POST" action="../vistas/consultaResultadosCuestionarios.php">
                <select id="select-filtro" name="cuestionario" class="form-select" aria-label="Default select example" >
                    <?php $num_cuestionarios = sizeof($cuestionarios); ?>
                    <?php for ($i = 0; $i < $num_cuestionarios; $i++) : ?>
                    <option value="<?php echo $cuestionarios[$i]['idCuestionario'];?>"> <?php echo $cuestionarios[$i]['titulo']; ?></option>
                    <?php endfor; ?>
                </select>

                <button type="submit" class="btn btn-warning" style="margin-top:1rem;">Generar reporte</button>
            </form>
        </div>
    </div>

    <script src="../src/js/salir.js"></script>
</body>

</html>
