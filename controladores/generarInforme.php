<?php

    include_once '../modelos/BD.php';
    require_once("../modelos/Usuario.php");

    /*Se recibe el id del estudiante seleccionado para generar un reporte*/
    if (isset($_GET['idUsuario'])){
        $idUsuario = htmlentities($_GET['idUsuario']);
    }

    /*Generar conexión a la BD*/
    $conexion = new mysqli('localhost', 'root', '', 'sas');

    /*Realizar consulta de datos*/

    if (!$conexion->connect_errno) {
        $sql_sentencia="SELECT matricula, concat(paterno,' ', materno,' ',usuario.nombre) as NombreCom, correo, imagen, etiqueta.idEtiqueta, etiqueta.nombre as nombreEtiqueta, COUNT( etiqueta.idEtiqueta ) AS total FROM etiqueta INNER JOIN evaluacion on etiqueta.idEtiqueta=evaluacion.idEtiqueta INNER JOIN usuario on usuario.idUsuario=evaluacion.idUsuario WHERE usuario.idUsuario= $idUsuario GROUP BY etiqueta.idEtiqueta ORDER BY total DESC";
        $consulta_datos = $conexion->query($sql_sentencia);
    }

    /*Utilización de la biblioteca fpdf*/
    require '../Reportes/fpdf.php';

    class PDF extends FPDF{
        /*Función para configuración del encabezado*/
        function Header(){
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(80);
            $this->Cell(30,10,utf8_decode('Informe de perfil psicológico'),0,0,'C');
            $this->Ln(20);
        }
        /*Función para configuración del pie de página*/
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    /*Creación del documento así como configuración del cuerpo*/
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $i=0;
    $contadorEtiquetas=0;

    while($registro=$consulta_datos->fetch_assoc()){
        if($i==0){
            /*Configuración de datos básicos del alumno*/
            $pdf->Image("../public/img/".($registro['imagen']), 30 ,25, 40 , 45);
            $pdf->Cell(200,10,"                                                            Nombre: ".utf8_decode($registro['NombreCom']),0,0,'L',0);
            $pdf->Ln(10);
            $pdf->Cell(200,10,utf8_decode("                                                            Matrícula: ".($registro['matricula'])),0,0,'L',0);
            $pdf->Ln(10);
            $pdf->Cell(200,10,"                                                            Correo: ".utf8_decode($registro['correo']),0,0,'L',0);
            $pdf->Ln(30);

            /*Ubicación de etiqueta con mayor presencia*/
            $pdf->Cell(100,10,utf8_decode("Etiqueta con mayor repetición"),1,0,'C',0);
            $pdf->Cell(90,10,utf8_decode("Número de apariciones en cuestionarios"),1,0,'C',0);
            $pdf->Ln(10);
            $pdf->Cell(100,10, utf8_decode($registro['nombreEtiqueta']),1,0,'C',0);
            $pdf->Cell(90,10,($registro['total']),1,0,'C',0);

            $pdf->Ln(20);

            /*Encabezado para enlistar etiquetas obtenidas*/
            $pdf->Cell(200,10,utf8_decode("Todas las etiquetas obtenidas (el número que aparece seguido de cada etiqueta es el número de"),0,0,'L',0);
            $pdf->Ln(5);
            $pdf->Cell(200,10,utf8_decode("apariciones que esa etiqueta ha tenido en los cuestionarios) :"),0,1,'L',0);
            $i++;
        }
        
        /*Enlistado de etiquetas*/
        $pdf->Cell(190,10,"         ".utf8_decode($registro['nombreEtiqueta'])." (".($registro['total']).")",1,1,'L',0);


        $contadorEtiquetas+=$registro['total'];
        
    }

    $pdf->Ln(20);
    $pdf->Cell(190,10,utf8_decode("Número total de cuestionarios respondidos y evaluados: ").$contadorEtiquetas,0,0,'L',0);
    

    $pdf->Output();
?>