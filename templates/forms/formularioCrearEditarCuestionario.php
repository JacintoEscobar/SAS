<div id="formulario">
    <div id="container-formulario" class="container">
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