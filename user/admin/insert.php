
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
          $output .= '<label class="text-success">Insert OK</label>';
          $select_query = "select * from incidencias i
     inner join servicios s on  i.id_servicio_1=s.id
     inner join tipo_servicio tp on  tp.id = s.id_tipoServicio_1
     inner join area a on i.id_area_1= a.id";
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
          while ($row = mysqli_fetch_array($result)) {
               $output .= '
       <tr>  
       <td>' . $row["id"] . '</td> 
       <td>' . $row["nombres"] . '</td>  
                         <td>' . $row["nombrets"] . '</td>  
                         <td><input type="button" name="Ver" value="Ver" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                    </tr>
      ';
          }
          $output .= '</table>';
     }
     echo $output;
}
?>
