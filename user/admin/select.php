
<?php include 'settings.php'; //include settings 
?>

<?php  
//select.php  
if(isset($_POST["id"]))
{
 $output = '';
 $query = "SELECT * FROM incidencias WHERE id = '".$_POST["id"]."'";
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
            <td width="30%"><label>Address</label></td>  
            <td width="70%">'.$row["observacion"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Gender</label></td>  
            <td width="70%">'.$row["gender"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Designation</label></td>  
            <td width="70%">'.$row["designation"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Age</label></td>  
            <td width="70%">'.$row["age"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
