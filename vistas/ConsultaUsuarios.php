<?php include '../templates/redirects/redirect_administrador.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAS - Consulta usuarios</title>

    <!--Incluimos los diseños que se aplican al header-->
    <?php include '../templates/header/header_head.php'; ?>

    <link rel="stylesheet" href="../src/css/consulta_usuarios.css">

    <!--Fuente de google para la información mostrada en la tabla-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('../src/img/fondo_administrador.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!--Incluimos el header de todas las páginas del administrador-->
    <?php include '../templates/header/header_herramientas.php'; ?>

    <main>
        <header class="container">
            <div class="row">
                <div id="titulo" class="col-12">Consulta de usuarios</div>
                <div id="descripcion" class="col-12">Aquí puedes administrar a los usuarios registrados en SAS.</div>
            </div>
        </header>

        <div id="filtro" class="container">
            <select id="select-filtro" class="form-select" aria-label="Default select example">
                <option value="todo" selected>Todo</option>
                <option value="administrador">Administrador</option>
                <option value="profesor">Profesor</option>
                <option value="alumno">Alumno</option>
            </select>
        </div>

        <div id="usuarios" class="container">
            <table id="tabla-usuarios" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Paterno</th>
                        <th scope="col">Materno</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody id="tabla-usuarios__registros"></tbody>
            </table>
        </div>
    </main>

    <!--Script para obtener a todos los usuarios registrados-->
    <script src="../src/js/consulta_usuarios.js"></script>

    <!--Script para limpiar la tabla de registros-->
    <script src="../src/js/limpiar_tabla_usuarios.js"></script>

    <!--Script para mostrar a todos los usuarios-->
    <script src="../src/js/mostrar_usuarios_todo.js"></script>

    <!--Script para mostrar a los usuarios segun el filtro de admin, profesor o alumno-->
    <script src="../src/js/mostrar_usuarios_filtro.js"></script>

    <script src="../src/js/salir.js"></script>
</body>

</html>