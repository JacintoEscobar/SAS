// Obtenemos los botones de respaldo y restauración.
const buttonRespaldo = document.getElementById('button-respaldo');
const buttonRestauracion = document.getElementById('button-restauracion');

buttonRespaldo.addEventListener('click', () => window.location.href = 'http://localhost/sas/vistas/GestionBD.php?a=respaldo');
buttonRestauracion.addEventListener('click', () => window.location.href = 'http://localhost/sas/vistas/GestionBD.php?a=restauracion');
