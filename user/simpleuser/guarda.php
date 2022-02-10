<?php
	require ('settings.php');
	
	$servicio = $_POST['combo_servicio'];
	$fechai = $_POST['form12'];
	$fechaf = $_POST['form13'];
	$obs = $_POST['textAreaExample'];
    $area = $_POST['select_area'];
	
	$sql = "INSERT INTO incidencias VALUES('$obs','$fechai','$fechaf','$servicio','$area')";
	$resultado = $conn->query($sql);
	
	if($resultado){
		echo "Registro Guardado";
		} else {
		echo "Error al Registrar";
	}
?>