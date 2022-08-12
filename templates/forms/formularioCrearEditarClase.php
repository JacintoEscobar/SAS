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
            <label for="titulo" class="form-label">Título de la clase:</label>
            <input type="text" id="titulo" name="titulo" class="form-control">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" style="resize: none;"></textarea>
        </div>

        <div class="mb-3">
            <label for="cuatrimestre" class="form-label">Cuatrimestre:</label>
            <input class="form-control" type="number" min="1" max="10" id="cuatrimestre" name="cuatrimestre">
        </div>

        <div class="mb-3">
            <label for="carrera" class="form-label">Carrera:</label>
            <select name="carrera" id="carrera" class="form-select" aria-label="Default select example">
                <option value="ITI">ITI</option>
                <option value="ITA">ITA</option>
                <option value="IFI">IFI</option>
                <option value="IET">IET</option>
                <option value="IBT">IBT</option>
                <option value="IIN">IIN</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="grupo" class="form-label">Grupo:</label>
            <input type="text" name="grupo" id="grupo" class="form-control">
        </div>
    </div>