<?php
    include '../templates/redirects/redirect_profesor.php'; 

    $idCuestionario=$_REQUEST['cuestionario'];
?>

<!DOCTYPE html>
<html lang="es">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Reporte Gráfico</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <!--Se incluye la hoja de estilo de la vista-->
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

    <!--Realizamos petición de resultados-->
    <?php include_once '../controladores/consultaResultadosCuestionarios.php'; ?>

    <div class="container">

        <!--Encabezado-->
        <div id="container-titulo" class="container">
            <div class="row">
                <h1 id="h1-titulo">Reporte gráfico</h1>
            </div>
        </div>
        <!--Configuración del gráfico de barras-->
        <figure id="container-grafico">
            <div class="card-header">
                <h5 id="titulo-barras"></h5>
            </div>
            <div class="chart-box">
                <canvas id="grafico-barras"></canvas>
            </div>
        </figure>
        <!--Configuración del gráfico de pastel-->
        <figure id="container-grafico">
            <div class="card-header">
                <h5 id="titulo-pastel"></h5>
            </div>
            <div class="chart-box">
                <canvas id="grafico-pastel"></canvas>
            </div>
        </figure>
    </div>

</body>

    <script>
        
        let etiqueta = [];
        let total = [];
        let porcentaje = [];
        let titulo;

        <?php $num_res = sizeof($resultados); ?>
        <?php for ($i = 0; $i < $num_res; $i++) : ?>
            etiqueta.push(`<?php echo $resultados[$i]['etiqueta'];?>`);
            total.push(`<?php echo $resultados[$i]['total'];?>`);
            porcentaje.push(`<?php echo $resultados[$i]['porcentaje'];?>`);
            titulo=`<?php echo $resultados[$i]['titulo'];?>`;
        <?php endfor; ?>

        document.getElementById('titulo-barras').innerHTML='Gráfica de barras del '+titulo;

        document.getElementById('titulo-pastel').innerHTML='Gráfica de pastel del '+titulo;

        const ctx = document.getElementById('grafico-barras');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: etiqueta,
                datasets: [{
                label: 'Cantidad de alumnos que han obtenido esta etiqueta',
                data: total,
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('grafico-pastel');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: etiqueta,
                datasets: [{
                label: 'Porcentaje',
                data: porcentaje,
                borderWidth: 3
                }]
            },
            options: {
                plugins:{
                    legend:{ position: 'left' }
                }
            }
        });
    </script>
    <script src="../src/js/salir.js"></script>
</body>

</html>