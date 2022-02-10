
<?php include 'settings.php'; //include settings 
?>

<?php  
//select.php  
if(isset($_POST["id"]))
{
 $output = '';
 $query = "select * from incidencias i
 inner join servicios s on  i.id_servicio_1=s.id
 inner join tipo_servicio tp on  tp.id = s.id_tipoServicio_1
 inner join area a on i.id_area_1= a.id
 WHERE i.id='".$_POST["id"]."'";
 $result = mysqli_query($conn, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    { 
     $output .= '
     <tr>  
            <td width="30%"><label>ID</label></td>  
            <td width="70%">'.$row["id"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Observacion</label></td>  
            <td width="70%">'.$row["observacion"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Fecha Inicio</label></td>  
            <td width="70%">'.$row["fechaInicio"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Fecha Finalizacion</label></td>  
            <td width="70%">'.$row["fechaFin"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Area</label></td>  
            <td width="70%">'.$row["nombreArea"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Servicio</label></td>  
            <td width="70%">'.$row["nombres"].'</td>  
        </tr>
        <tr>  
        <td width="30%"><label>Tipo</label></td>  
        <td width="70%">'.$row["nombrets"].'</td>  
    </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
