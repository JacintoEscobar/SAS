<?php if (isset($_GET['r'])) : ?>
    <?php include_once '../modelos/BD.php'; ?>
    <?php $baseDatos = new BD(); ?>

    <?php if (!$baseDatos->conectar()) : ?>
        <?php echo "<script> alert('Ocurrió un error al intentar conectar con la base de datos'); </script>"; ?>
        <?php header("Location: ./GestionBD.php"); ?>
    <?php endif; ?>

    <?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'sas';

    $fecha = date('d-m-Y');
    $nombreArchivoSQL = $database . '_' . $fecha . '.sql';

    $dump = "mysqldump -h$host -u$user -p$password --opt $database > $nombreArchivoSQL";

    system($dump, $output);

    $zip = new ZipArchive();
    $nombreArchivoZIP = $database . '' . $fecha . '.zip';

    if (!$zip->open($nombreArchivoSQL, ZIPARCHIVE::CREATE)) {
        return 0;
    }

    $zip->addFile($nombreArchivoSQL);
    $zip->close();
    unlink($nombreArchivoSQL);

    header("Location: $nombreArchivoZIP");
    ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Gestión de BD</title>
    <link rel="stylesheet" href="../src/css/gestionBD.css">
</head>

<body>
    <a id="respaldarBD" href="./GestionBD.php?r=true">Respaldar base de datos.</a>
</body>

</html>