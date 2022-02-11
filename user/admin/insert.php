
<?php include 'settings.php'; //include settings 
?>
<?php

if (!empty($_POST)) {
     $output = '';
     $nombrets = mysqli_real_escape_string($conn, $_POST["nombrets"]);
     $query = "
    INSERT INTO tipo_servicio(nombrets)  
     VALUES('$nombrets')
    ";
     if (mysqli_query($conn, $query)) {
        
      
     echo $output;
}
}
?>
