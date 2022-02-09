<?php
require ('../../includes/connect.php');
	
$id = $_POST['id'];

$queryM = "SELECT id, nombrets FROM tipo_servicio WHERE id = '$id' ORDER BY nombrets";
$resultadoM = $conn->query($queryM);

$html= "<option value='0'>Seleccionar Municipio</option>";

while($rowM = $resultadoM->fetch_assoc())
{
    $html.= "<option value='".$rowM['id']."'>".$rowM['nombrets']."</option>";
}

echo $html;

?>