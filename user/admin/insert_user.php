<?php include 'settings.php'; //include settings 
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
   <script src="./chart.min.js"></script>


</head>

<body>
   <?php

   if (!empty($_POST)) {
      $name = mysqli_real_escape_string($conn, $_POST["name"]);
      $login = mysqli_real_escape_string($conn, $_POST["login"]);
      $password = mysqli_real_escape_string($conn, $_POST["password"]);
      $rol = mysqli_real_escape_string($conn, $_POST["rol"]);

      $newpass= md5($password);

      $area = mysqli_query($conn, "SELECT * FROM users WHERE login = '$login'");

      if (mysqli_num_rows($area) > 0) {
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
      } else {
         $query = "
          INSERT INTO users(name,login,password,role)  
           VALUES('$name','$login','$newpass','$rol')
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

   <!-- js -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


</html>