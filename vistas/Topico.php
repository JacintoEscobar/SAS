<?php include '../templates/redirects/redirect_profesor.php'; ?>

<!DOCTYPE html>
<html lang="es">

<!--Verificamos que el id del tópico este definido para redirigir al Home en caso de acceso indebido-->
<?php include_once '../templates/verificarIdTopico.php'; ?>

<!--Obtenemos la información del tópico-->
<?php include_once '../controladores/getTopico.php'; ?>

<!--Guardamos el id del tópico en caso de que el profesor suba un nuevo material educativo-->
<?php $_SESSION['idT'] = $topico['idTopico']; ?>

<!--Obtenemos todas las etiquetas que el profesor puede asignar a un material educativo-->
<?php include '../controladores/get_etiquetas.php'; ?>
<?php $etiquetas = getEtiquetas($_SESSION['i']); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - <?php print $topico['titulo']; ?></title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/topico.css">

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">

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

    <main class="container">
        <section class="row">
            <header class="col">
                <h2 id="titulo">Material educativo</h2>
            </header>
        </section>

        <section>
            <header>
                <h4 id="subtitulo">Aquí puedes administrar tu material educativo</h4>
            </header>

            <div style="margin: 1rem 0px;" class="container">
                <button id="nuevo" type="button" class="btn btn-success">Nuevo</button>
            </div>

            <!-------------------------Sección donde se muestran los materiales educativos creados para este tópico------------------------->
            <?php include_once '../controladores/getMaterialEducativo.php'; ?>
            <?php $materialEducativo = getMaterialEducativo($_SESSION['idT']); ?>
            <div style="margin-top: 1rem;" class="container">
                <?php if (!is_null($materialEducativo)) : ?>
                    <div class="row">
                        <?php foreach ($materialEducativo as $material) : ?>
                            <div class="col-sm-6">
                                <div style="margin: 1rem;" class="card">
                                    <div class="card-body">
                                        <?php if ($material->tipo == 'archivo') : ?>
                                            <?php $_SESSION['dir'] = $material->direccion; ?>
                                        <?php endif; ?>
                                        <h5 id="material" data-tipo="<?php print $material->tipo; ?>" class="card-title"><?php print $material->titulo; ?></h5>
                                        <p class="card-text">
                                            <strong>Tipo: </strong> <span><?php print $material->tipo; ?></span> <br>
                                            <?php include_once '../controladores/getEtiquetaME.php'; ?>
                                            <?php $etiqueta = getEtiquetaME($material->idEtiqueta); ?>
                                            <strong>Etiqueta asignada: </strong> <span><?php print $etiqueta; ?></span> <br>
                                            <?php if ($material->tipo == 'enlace') : ?>
                                                <strong>Dirección: </strong> <span id="direccion"><?php print $material->direccion; ?></span> <br>
                                            <?php endif; ?>
                                        </p>
                                        <button id="eliminarME" data-idME="<?php print $material->idMaterialEducativo; ?>" type="button" class="btn btn-danger">Elminar material</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!--------------------------------------------------------Modal para subir un archivo-------------------------------------------------------->
            <!-- Button trigger modal -->
            <button id="showModalNuevo" style="visibility: hidden;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo material educativo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--Lista para saber de qué tipo será el nuevo material educativo del profesor.-->
                            <div id="select-etiqueta" class="form-floating">
                                <select class="form-select" id="floatingSelectE" aria-label="Floating label select example">
                                    <option value='' selected>Abre este menu despegable</option>
                                    <!--Lista de etiquetas que el profesor puede asignar a un material educativo nuevo-->
                                    <?php foreach ($etiquetas as $etiqueta) : ?>
                                        <option value="<?php print $etiqueta['idEtiqueta']; ?>"><?php print $etiqueta['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingSelectE">¿De qué tipo será tu nuevo material educativo?</label>
                            </div>
                            <br>
                            <!--Lista para saber de qué tipo será el nuevo material educativo del profesor.-->
                            <div id="select-me" class="form-floating">
                                <select class="form-select" id="floatingSelectME" aria-label="Floating label select example">
                                    <option value='' selected>Abre este menu despegable</option>
                                    <option value="archivo">Archivo</option>
                                    <option value="enlace">Enlace</option>
                                </select>
                                <label for="floatingSelectME">¿De qué tipo será tu nuevo material educativo?</label>
                            </div>

                            <!--Sección donde se mostrará el formulario dependiendo del tipo de archivo.-->
                            <div id="form-me" class="form-floating"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button id="subir" type="button" class="btn btn-primary">Subir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        document.getElementById('nuevo').addEventListener('click', () => document.getElementById('showModalNuevo').click());
    </script>

    <script src="../src/js/selectMaterialEducativo.js"></script>
    <script src="../src/js/subirMaterialEducativo.js"></script>
    <script src="../src/js/eliminarME.js"></script>
    <script src="../src/js/abrirMaterial.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>