<!--Barra de navegación del sistema-->
<nav class="navbar">
    <div class="container-fluid">

        <!--Nombre del sistema-->
        <?php if ($_SESSION['t'] == 'administrador') : ?>
            <?php $redireccionTitulo = './HomeAdministrador.php'; ?>
        <?php elseif ($_SESSION['t'] == 'profesor') : ?>
            <?php $redireccionTitulo = './HomeProfesor.php'; ?>
        <?php else : ?>
            <?php $redireccionTitulo = './HomeAlumno.php'; ?>
        <?php endif; ?>
        <a id="SAS-Titulo" class="navbar-brand" href="<?php echo $redireccionTitulo; ?>">SAS</a>

        <!--Lista de herramientas del usuario-->
        <ul id="lista-herramientas" class="nav justify-content-end">
            <!--Herramientas para los usuarios de tipo administrador-->
            <?php if ($_SESSION['t'] == 'administrador') : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./RegistroUsuarios.php">Registro de usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ConsultaUsuarios.php">Consulta de usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./GestionBD.php">Gestión de base de datos</a>
                </li>

                <!--Herramientas para los usuarios de tipo profesor-->
            <?php elseif ($_SESSION['t'] == 'profesor') : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./Clases.php">Clases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Cuestionarios.php">Cuestionarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./RegistroIndividual.php">Registro individual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./PerfilesPsicologicos.php">Perfiles psicológicos</a>
                </li>

                <!--Herramientas para los usuarios de tipo estudiante-->
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./ClasesEstudiante.php">Clases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./CuestionariosDisponibles.php">Cuestionarios</a>
                </li>
            <?php endif; ?>

            <!--Lista de opciones de perfil-->
            <li class="nav-item dropdown">
                <a id="dropdown-menu-button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <img src="../src/img/user_icon.png" alt="user">
                </a>
                <ul class="dropdown-menu">
                    <li><a id="cambiarContraseña" class="dropdown-item" href="./CambiarContraseña.php?t=<?php echo $_SESSION['t']; ?>">Cambiar contraseña</a></li>
                    <li><a id="salir" class="dropdown-item">Salir</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>