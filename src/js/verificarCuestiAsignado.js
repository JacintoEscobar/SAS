/**
 * Consulta si el cuestionario está ya asignado a los alumnos
 * para redirigir a la página de resultados.
 */
const verificarCuestAsignado = () => {
    const cuestionario = JSON.parse(localStorage.getItem("cuestionario"));
    const peticion = new XMLHttpRequest();
    peticion.onreadystatechange = () => {
        if (peticion.readyState === 4 && peticion.status === 200) {
            const response = JSON.parse(peticion.response);
            if (response.EsAsignado) {
                let timerInterval
                Swal.fire({
                    icon: 'success',
                    title: 'Cuestionario ya asignado',
                    html: 'Te redirigiremos a la página de resultados en: <b></b> milisegundos.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = `http://localhost/sas/vistas/ResultadosCuestionario.php?i=${cuestionario.idCuestionario}&c=${cuestionario.titulo}`;
                    }
                })
            }
        }
    };
    peticion.open("GET", `http://localhost/sas/controladores/verificar_asignacion.php?idCuestionario=${cuestionario.idCuestionario}`, true);
    peticion.send();
};

verificarCuestAsignado();