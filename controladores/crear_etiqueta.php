<?php

include_once '../modelos/Etiqueta.php';

$id = htmlspecialchars($_POST['id_etiqueta'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre_etiqueta'], ENT_QUOTES, 'UTF-8');

$etiqueta = new Etiqueta($id, $nombre);

if ($etiqueta->insertar()) {
    echo
    '
        <script type="text/javascript">
            alert("Etiqueta creada exitosamente.");
            const cuestionario = JSON.parse(localStorage.getItem("cuestionario"));
            id = cuestionario.idCuestionario;
            titulo = cuestionario.titulo;
            window.location.href = `http://localhost/sas/vistas/ResultadosCuestionario.php?i=${id}&c=${titulo}`;
        </script>
    ';
} else {
    echo
    '
        <script type="text/javascript">
            alert("Ocurrió un error al crear la etiqueta.");
            const cuestionario = JSON.parse(localStorage.getItem("cuestionario"));
            id = cuestionario.idCuestionario;
            titulo = cuestionario.titulo;
            window.location.href = `http://localhost/sas/vistas/ResultadosCuestionario.php?i=${id}&c=${titulo}`;
        </script>
    ';
}
