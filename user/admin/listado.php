<?php include 'settings.php'; //include settings 
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Incidencias</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" /> <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <style>
        .content {
            margin-top: 80px;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="content">
            <h2 class="text-center">Lista de Incidencias</h2>
            <hr />

            <?php
            if (isset($_GET['aksi']) == 'delete') {
                // escaping, additionally removing everything that could be (html/javascript-) code
                $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
                $cek = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$nik'");
                if (mysqli_num_rows($cek) == 0) {
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
                } else {
                    $delete = mysqli_query($con, "DELETE FROM empleados WHERE codigo='$nik'");
                    if ($delete) {
                        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
                    }
                }
            }
            ?>

            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Acciones</th>
                        <th>ID</th>
                        <th>Observacion</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Termino</th>
                        <th>Id Servicio</th>
                        <th>Nombre</th>


                    </tr>
                    <?php
                    $sql = mysqli_query($conn, "select * from incidencias
                     inner join servicios on  incidencias.id_servicio_1=servicios.id");

                    if (mysqli_num_rows($sql) == 0) {
                        echo '<tr><td colspan="8">No hay datos.</td></tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($sql)) {
                            echo '
						<tr>
                        <td>

                        <a href="edit.php?nik=' . $row['id'] . '" title="Editar datos" class="btn btn-primary btn-sm"><i class="fas fa-highlighter"></i></a>
                        <a href="index.php?aksi=delete&nik=' . $row['id'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos ' . $row['id'] . '?\')" class="btn btn-danger btn-sm"><i class="fas fa-backspace"></i></a>
                    </td>
							<td>' . $row['id'] . '</td>
                            <td>' . $row['observacion'] . '</td>
                            <td>' . $row['fechaInicio'] . '</td>
							<td>' . $row['fechaFin'] . '</td>
                            <td>' . $row['id_servicio_1'] . '</td>
                            <td>' . $row['nombre'] . '</td>

						
						
						</tr>
						';
                            $no++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <center>
 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>