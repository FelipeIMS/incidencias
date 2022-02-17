<?php
require ('settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

	
// $observacion = $_POST['obs'];
// $fecha_inicio = $_POST['fecha_inicio'];
// $fecha_fin = $_POST['fecha_fin'];
// $id_servicio_1 = $_POST['combo_servicio'];
// $id_area_1 = $_POST['select_area'];
// $id_tipoServicio_1 = $_POST['combo_ts'];



if(isset($_POST['combo_ts']) && isset($_POST['select_area']) ){
    echo "no inserta";
}else{
    $observacion = $_POST['obs'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_servicio_1 = $_POST['combo_servicio'];
    $id_area_1 = $_POST['select_area'];
    $id_tipoServicio_1 = $_POST['combo_ts'];
    $sql = "INSERT INTO incidencias (observacion, fechaInicio, fechaFin, id_servicio_1, id_area_1, id_tipoServicio_1) VALUES('$observacion','$fecha_inicio','$fecha_fin','$id_servicio_1','$id_area_1','$id_tipoServicio_1')";
    $resultado = $conn->query($sql);
    echo"guardado";
    
    
}



?>
    
</body>
</html>