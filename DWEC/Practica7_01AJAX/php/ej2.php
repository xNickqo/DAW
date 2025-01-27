<?php 

	$nombre=$_GET['nombre']; 
	$apellidos=$_GET['apellidos'];
	$modulo=$_GET['modulo'];

	$nota = rand(4, 10);

	switch($nombre . " " . $apellidos){ 
		case 'Juan Mateos': 
			switch($modulo){ 
				case 'Sociales': 
					echo $nota; 
					break; 
				case 'Lenguaje': 
					echo $nota; 
					break; 
			} 
			break; 
		case 'Ana Irene Palma': 
			switch($modulo){ 
				case 'Sociales': 
					echo $nota; 
					break; 
				case 'Lenguaje': 
					echo $nota; 
					break; 
			} 
			break;
		case 'Nicolas Lopez': 
			switch($modulo){ 
				case 'Informatica': 
					echo $nota; 
					break; 
				case 'Sociales': 
					echo $nota; 
					break; 
			} 
			break;
	} 
 ?>