<?php if ($_SESSION['t'] == 'administrador') : ?>
    <?php $tipo_usuarios = 'profesores'; ?>
    <?php $tipo_usuario = 'profesor'; ?>
<?php else : ?>
    <?php $tipo_usuarios = 'alumnos'; ?>
    <?php $tipo_usuario = 'alumno'; ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div id="titulo" class="col-12">Registro individual de <?php echo $tipo_usuarios; ?></div>
        <div id="descripcion" class="col-12">Llene el formulario para dar de alta a un <?php echo $tipo_usuario; ?>.</div>
    </div>

    <!--Sección del formulario-->
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
        <button tipo_usuario="<?php echo $tipo_usuario; ?>" id="registrarUsuario" type="submit" class="btn btn-primary">Registrar <?php echo $tipo_usuario; ?></button>
    </div>
</div>