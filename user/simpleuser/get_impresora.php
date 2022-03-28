<?php
	require ('../../includes/connect.php');
	
	$id_tp = $_POST['id_tp'];
	
	$queryM = "SELECT id_impresora, serial_number FROM impresora WHERE id_servicio = '$id_tp'";
	$resultadoM = $conn->query($queryM);
	
	$html= "<option value='0'>Tipo de Servicio</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_impresora']."'>".$rowM['serial_number']."</option>";
	}
	
	echo $html;
?>