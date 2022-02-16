
<?php include 'settings.php'; //include settings 
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<?php

if (!empty($_POST)) {
     $nombrets = mysqli_real_escape_string($conn, $_POST["nombrets"]);
     $servicioid =mysqli_real_escape_string($conn, $_POST["servicioid"]);
     $servicio = mysqli_query($conn,"SELECT tipo_servicio.*, servicios.id_servicio
     FROM tipo_servicio 
     LEFT JOIN servicios ON tipo_servicio.id_servicio_2 = servicios.id_servicio
     WHERE tipo_servicio.nombrets = '$nombrets' AND servicios.id_servicio='$servicioid';");

     if(mysqli_num_rows($servicio)>0)
     {
       echo "<script>  Swal.fire({
          position: 'center',
          icon: 'warning',
          title: 'Error, dato ya existe',
          showConfirmButton: false,
          timer: 1500
        });</script>";
        echo '<script type="text/JavaScript"> setTimeout(function(){
         window.location.reload(1);
      }, 3000); </script>';
        
     }
     else{
          $query = "
          INSERT INTO tipo_servicio(nombrets,id_servicio_2)  
           VALUES('$nombrets', '$servicioid')
          ";
          if (mysqli_query($conn, $query)) {
               echo "<script>  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro exitoso',
                    showConfirmButton: false,
                    timer: 3000
                  });</script>";
                  echo '<script type="text/JavaScript"> setTimeout(function(){
                    window.location.reload(1);
                 }, 3000); </script>';
            } else {
              
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
         }
       
        
     }

?>


</body>


</html>
