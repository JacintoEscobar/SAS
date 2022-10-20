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

        <div id="filtro" class="container-md">
            <select id="select-filtro" class="form-select" aria-label="Default select example">
                <option value="todo" selected>Todo</option>
                <option value="administrador">Administrador</option>
                <option value="profesor">Profesor</option>
                <option value="alumno">Alumno</option>
            </select>

            <form id="busqueda" class="form-inline my-2 my-lg-0">
                <input id="busqueda_input" class="form-control mr-sm-2" type="search" placeholder="Busca por id, matrícula o nombre" aria-label="search">
            </form>
        </div>

        <div id="usuarios" class="container">
            <table id="tabla-usuarios" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Matrícula</th>
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

        <!-- Seccion del modal que permite editar la informacion del usuario -->
        <!-- Button trigger modal -->
        <button style="visibility: hidden;" id="bEditarUsuario" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edición de usuario</h1>
                        <button id="bCloseX" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="registro-individual-form" class="container">
                            <!--ID-->
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input readonly id="id" class="form-control" type="text" placeholder="ID" aria-label="default input example">
                                </div>
                            </div>
                            <!--Matrícula-->
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input id="matricula" class="form-control" type="text" placeholder="Matricula" aria-label="default input example">
                                </div>
                            </div>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="bCancelEdit" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="bEdit" type="button" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--Script para obtener a todos los usuarios registrados-->
    <script src="../src/js/consulta_usuarios.js"></script>

    <!--Script para limpiar la tabla de registros-->
    <script src="../src/js/limpiar_tabla_usuarios.js"></script>

    <!--Script para eliminar a los usuarios-->
    <script src="../src/js/eliminar_usuario.js"></script>

    <!--Script para actualizar la información de los usuarios.-->
    <script src="../src/js/editar_usuario.js"></script>

    <!--Script para mostrar a todos los usuarios-->
    <script src="../src/js/mostrar_usuarios_todo.js"></script>

    <!--Script para mostrar a los usuarios segun el filtro de admin, profesor o alumno-->
    <script src="../src/js/mostrar_usuarios_filtro.js"></script>

    <!--Script para buscar a los usuarios por id, matricula o nombre-->
    <script src="../src/js/buscar_usuario.js"></script>

    <script src="../src/js/salir.js"></script>
</body>

</html>