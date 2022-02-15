<?php
include('settings.php');
?>
<?php
//index.php
$query = "SELECT incidencias.id_incidencias as id, servicios.nombres as nombreservicio,tipo_servicio.nombrets as nombretipo,observacion, fechaInicio, fechaFin, area.nombreArea as nombre_area  FROM incidencias
inner join servicios on servicios.id_servicio = incidencias.id_servicio_1
inner join tipo_servicio on tipo_servicio.id_tipoServicio = incidencias.id_servicio_1
inner join area on area.id_area = incidencias.id_area_1
ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</head>
<body>
    <header class="header__content">
        <h1>This is User page, Hola: <?php $ufunc->UserName(); //Show name who is in session user?></h1>
        <a href="../../includes/logout.php" class="btn btn-danger">Logout</a>
    </header>
        <div class="col-md-10" style="margin: 20px auto" >
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Servicio</th>
                        <th>Tipo Servicio</th>
                        <th>Area</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Observacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["nombreservicio"]; ?></td>
                    <td><?php echo $row["nombretipo"]; ?></td>
                    <td><?php echo $row["nombre_area"]; ?></td>
                    <td><?php echo $row["fechaInicio"]; ?></td>
                    <td><?php echo $row["fechaFin"]; ?></td>
                    <td><?php echo $row["observacion"]; ?></td>
                    <td>acciones</td>
                </tr>
            <?php
            }
            ?>

                    </tr>
                </tbody>
            </table>
            
        </div>
    
    
</body>
</html>