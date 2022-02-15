
<?php include 'settings.php'; //include settings 
?>
<?php

if (!empty($_POST)) {
     $output = '';
     $nombrets = mysqli_real_escape_string($conn, $_POST["nombrets"]);
     $servicioid =mysqli_real_escape_string($conn, $_POST["servicioid"]);
     $duplicado = mysqli_query($conn,"select * from tipo_servicio where  nombrets='$nombrets'");
     $servicio = mysqli_query($conn,"SELECT tipo_servicio.*, servicios.id_servicio
     FROM tipo_servicio 
     LEFT JOIN servicios ON tipo_servicio.id_servicio_2 = servicios.id_servicio
     WHERE tipo_servicio.nombrets = '$nombrets' AND servicios.id_servicio='$servicioid';");

     if(mysqli_num_rows($servicio)>0)
     {
          echo "Este dato ya existe";
     }
     else{
          $query = "
          INSERT INTO tipo_servicio(nombrets,id_servicio_2)  
           VALUES('$nombrets', '$servicioid')
          ";
          if(mysqli_query($conn, $query))
          {
           $output .= '<label class="text-success">Data Inserted</label>';
           $select_query = "SELECT * FROM employee ORDER BY id DESC";
           $result = mysqli_query($conn, $select_query);
           $output .= '
            <table class="table table-bordered">  
                          <tr>  
                          <th>ID</th>
                          <th>Servicio</th>
                          <th>Tipo</th>
                          <th>Ver</th>
                          </tr>
      
           ';
           while($row = mysqli_fetch_array($result))
           {
            $output .= '
            <tr>
            <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["nombreservicio"]; ?></td>
              <td><?php echo $row["nombretipo"]; ?></td>
              <td><input type="button" name="view" value="Ver" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
            </tr>
            ';
           }
           $output .= '</table>';
          }
          echo $output;
      }
     }
    


?>
