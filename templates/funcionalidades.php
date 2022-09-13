<div id="funcionalidades" class="container">

    <!--Funcionalidades para los usuarios de tipo administrador-->
    <?php if ($_SESSION['t'] == 'administrador') : ?>
        <a href="./RegistroUsuarios.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAdministrador/registrousuarios-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Registro de usuarios</strong></h5>
                </div>
            </div>
        </a>
        <a href="./ConsultaUsuarios.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAdministrador/consulta_usuarios-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Consulta de usuarios</strong></h5>
                </div>
            </div>
        </a>
        <a href="./RegistroIndividualProfesor.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAdministrador/registroIndividual.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Registro individual</strong></h5>
                </div>
            </div>
        </a>
        <a href="./GestionBD.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAdministrador/gestion_bd-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Gestión de base de datos</strong></h5>
                </div>
            </div>
        </a>

    <!--Funcionalidades para los usuarios de tipo profesor-->
    <?php elseif ($_SESSION['t'] == 'profesor') : ?>
        <a href="./Clases.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeProfesor/clases-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Clases</strong></h5>
                </div>
            </div>
        </a>
        <a href="./Cuestionarios.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeProfesor/cuestionarios-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Cuestionarios</strong></h5>
                </div>
            </div>
        </a>
        <a href="./RegistroIndividualAlumno.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeProfesor/registroIndividual.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Registro individual</strong></h5>
                </div>
            </div>
        </a>
        <a href="./PerfilesPsicologicos.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeProfesor/psicologico-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Perfiles psicológicos</strong></h5>
                </div>
            </div>
        </a>

    <!--Funcionalidades para los usuarios de tipo estudiante-->
    <?php else : ?>
        <a href="./ClasesEstudiante.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAlumno/clases-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Clases</strong></h5>
                </div>
            </div>
        </a>
        <a href="./CuestionariosDisponibles.php">
            <div class="card" style="width: 8rem;">
                <img src="../src/img/homeAlumno/cuestionarios-icon.png" class="card-img-top" alt="clases">
                <div class="card-body">
                    <h5 class="card-title"><strong>Cuestionarios</strong></h5>
                </div>
            </div>
        </a>
    <?php endif; ?>
</div>