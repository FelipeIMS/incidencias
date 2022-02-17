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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php


if(empty($_POST['combo_ts'])||empty($_POST['select_area']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin'])){
    echo "<script>  Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'ERROR AL GUARDAR INCIDENCIA',
        text: 'POR FAVOR, RELLENE TODOS LOS CAMPOS',
        showConfirmButton: false,
        timer: 3000
      });</script>";
      echo '<script type="text/JavaScript"> setTimeout(function(){
       window.location="crear.php";
    }, 3000); </script>';;
}else{
    $observacion = $_POST['obs'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $id_servicio_1 = $_POST['combo_servicio'];
    $id_area_1 = $_POST['select_area'];
    $id_tipoServicio_1 = $_POST['combo_ts'];
    
    $sql = "INSERT INTO incidencias (observacion, fechaInicio, fechaFin, id_servicio_1, id_area_1, id_tipoServicio_1) VALUES('$observacion','$fecha_inicio','$fecha_fin','$id_servicio_1','$id_area_1','$id_tipoServicio_1')";

    $resultado = $conn->query($sql);
    echo "<script>  Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'REGISTRO EXITOSO',
        text:'INCIDENCIA GUARDADA EXITOSAMENTE',
        showConfirmButton: false,
        timer: 3000
      });</script>";
      echo '<script type="text/JavaScript"> setTimeout(function(){
        window.location="index.php";
     }, 3000); </script>';
}



?>
    
</body>
</html>