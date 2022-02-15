<?php
require ('settings.php');
	
$observacion = $_POST['obs'];
// $fechaFin = $_POST['fechaFin'];
$id_servicio_1 = $_POST['combo_servicio'];
$id_area_1 = $_POST['select_area'];
$id_tipoServicio_1 = $_POST['combo_ts'];

$sql = "INSERT INTO incidencias (observacion, fechaInicio, fechaFin, id_servicio_1, id_area_1, id_tipoServicio_1) VALUES('$observacion',now(),null,'$id_servicio_1','$id_area_1','$id_tipoServicio_1')";
$resultado = $conn->query($sql);

if($resultado){
<<<<<<< HEAD
	echo "Registro Guardado";
	echo "$sql";
=======
	// echo "Registro Guardado";
	echo $sql;
>>>>>>> c05bf0e56151c38d9ed5e633f585d9f24f4b1116
	} else {
	echo "Error al Registrar";
}
?>
