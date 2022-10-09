<div id="formulario">
    <div id="container-formulario" class="container">
        <!--Para la página de editar clase, verificamos que se haya recibido el
        código de clase por GET para tomarlo y realizar la actualización-->
        <?php if (isset($_GET) && isset($_GET['c'])) : ?>
            <div class="mb-3 row">
                <label for="codigo" class="col-sm-2 col-form-label">Código:</label>
                <div class="col-sm-10">
                    <input id="codigo" class="form-control" type="text" value="<?php echo $_GET['c']; ?>" aria-label="readonly input example" readonly>
                </div>
            </div>
        <?php endif; ?>
        <!---->

        <div class="mb-3">
            <label for="titulo" class="form-label">Título del cuestionario:</label>
            <input type="text" id="titulo" name="titulo" class="form-control">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" style="resize: none;"></textarea>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select id="tipo" class="form-select" aria-label="Default select example">
                <option value="0" selected>Selecciona el tipo de preguntas de tu cuestionario</option>
                <option value="abiertas">Abiertas</option>
                <option value="cerradas">Cerradas</option>
            </select>
        </div>
    </div>