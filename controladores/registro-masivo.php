<?php
	/*Se incluyen para la conexión a la base de datos y extracción de propiedades del usuario*/
	require_once("../modelos/Usuario.php");

	/*Ruta donde se almacenan los registros*/
	$ruta="../registros-masivos/";

	foreach ($_FILES as $key) {
		/*Obtención del nombre y ruta temporal del archivo insertado*/
		$nombre=$key["name"];
		$ruta_temporal=$key["tmp_name"];

		$fecha=getdate();
		/*Configuración para cambiar el nombre del archivo que se almacenará*/
		$nombreF=$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."_".$fecha["minutes"]."-".$fecha["seconds"].".csv";
		/*Guardado de destino del archivo*/
		$destino=$ruta.$nombreF;
		$explo=explode(".", $nombre);
		/*Comprobación si el archivo es de tipo csv*/
		if($explo[1]!="csv"){
			echo '<script>alert("Tipo de archivo incorrecto. Regrese a la página anterior")</script>';
		}else{
			if(move_uploaded_file($ruta_temporal, $destino)){
				/*Se abre el archivo y se prepara para su lectura*/
				$i=0;
				$info=array();
				$fichero=fopen($destino, "r");
				/*Lectura del archivo y guardado de estos dentro del arreglo info*/
				while(($datos=fgetcsv($fichero, 1000))!=FALSE){
					$i++;
					if($i>1){
						$conexion = new mysqli('localhost', 'root', '', 'sas');

        				if (!$conexion->connect_errno) {
            				$consulta = $conexion->prepare('INSERT INTO usuario(matricula, nombre, paterno, materno, correo, usuario, contraseña, tipo) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');

            				$consulta->bind_param('ssssssss', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7]);

            				if ($consulta->execute() === true) {
        					/*Introducción de los datos en la base de datos y redirección a la página de registro de usuarios*/
            					
        					} else {
            					echo '<script>alert("Ha ocurrido un error en el registro")</script>';
        					}
        				}
					}
				}

				fclose($fichero);
            	header("refresh:1;url=../Vistas/RegistroUsuarios.php");
 				echo '<script>alert("Registro finalizado")</script>';
			}
		}
	}

?>