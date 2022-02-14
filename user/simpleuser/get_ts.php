<?php
	require ('../../includes/connect.php');
	
	$id_tp = $_POST['id_tp'];
	
	$queryM = "SELECT id_tipoServicio, nombrets FROM tipo_servicio WHERE id_servicio_2 = '$id_tp' ORDER BY nombrets";
	$resultadoM = $conn->query($queryM);
	
	$html= "<option value='0'>Seleccionar Tipo de Servicio</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_tipoServicio']."'>".$rowM['nombrets']."</option>";
	}
	
	echo $html;
?>