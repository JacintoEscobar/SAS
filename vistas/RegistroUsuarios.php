<?php include '../templates/redirects/redirect_administrador.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Registro individual</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/registro_individual.css">

    <style>
        body {
            background-image: url('../src/img/fondo_administrador.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas de profesor-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <!--Incluimos el formulario para el registro individual de usuarios-->
    <div class="container">
        <div class="row">
            <div id="titulo" class="col-12">Registro de usuarios</div>
            <div id="descripcion" class="col-12">Seleccione una opción para mostrar el formulario correspondiente.</div>
        </div>

        <!--Selector de registro: Masivo o individual-->
        <select id="tipo-registro-form" class="form-select" aria-label="Default select example">
            <option selected>Selecciona un tipo de registro de usuarios</option>
            <option value="1">Registro individual</option>
            <option value="2">Registro masivo</option>
        </select>

        <!--Sección del formulario para registro individual de usuarios-->
        <div id="registro-individual-form" class="container">
            <!--Nombre-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="nombre" class="form-control" type="text" placeholder="Nombre" aria-label="default input example">
                </div>
            </div>
            <!--Paterno-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="paterno" class="form-control" type="text" placeholder="Apellido Paterno" aria-label="default input example">
                </div>
            </div>
            <!--Materno-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="materno" class="form-control" type="text" placeholder="Apellido Materno" aria-label="default input example">
                </div>
            </div>
            <!--Correo-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="correo" class="form-control" type="text" placeholder="Correo Electrónico" aria-label="default input example">
                </div>
            </div>
            <!--Usuario-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="usuario" class="form-control" type="text" placeholder="Usuario" aria-label="default input example">
                </div>
            </div>
            <!--Contraseña-->
            <div class="mb-3 row">
                <div class="col-sm-12">
                    <input id="contraseña" type="password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <!--Tipo de usuario-->
            <select id="tipo_usuario" class="form-select" aria-label="Default select example">
                <option value="0">Tipo de usuario</option>
                <option value="administrador">Administrador</option>            
                <option value="profesor">Profesor</option>
                <option value="alumno">Alumno</option>
            </select>
            <!--Botón de registro-->
            <button id="registrarUsuario" type="submit" class="btn btn-primary">Registrar</button>
        </div>

        <!--Secciòn del formulario para registro masivo-->
        <div id="registro-masivo-form" class="container"></div>
    </div>

    <script type="text/javascript">
        /**
         * Ocultamos los formularios de registro
         */
        document.getElementById('registro-individual-form').style.visibility = 'hidden';
        document.getElementById('registro-masivo-form').style.visibility = 'hidden';

        /**
         * Obtenemos el select para saber qué formulario de registro mostrar
         */
        const tipoFormulario = document.getElementById('tipo-registro-form');

        /**
         * Definimos el evento onclick del select para mostrar u ocultar los formularios de registro
         */
        tipoFormulario.addEventListener('change', () => {
            mostrarFormulario();
        });

        /**
         * Función que muestra y oculta los formularios de registrgo dependiendo de la selección del usuario
         */
        const mostrarFormulario = () => {
            if (tipoFormulario.value == 1) {
                document.getElementById('registro-individual-form').style.visibility = 'visible';
                document.getElementById('registro-masivo-form').style.visibility = 'hidden';
            } else if (tipoFormulario.value == 2) {
                document.getElementById('registro-individual-form').style.visibility = 'hidden';
                document.getElementById('registro-masivo-form').style.visibility = 'visible';
            }
        };
    </script>
    <script src="../src/js/notificarUsuarioRegistro.js"></script>
    <script src="../src/js/registrarUsuario.js"></script>
    <script src="../src/js/salir.js"></script>
</body>

</html>