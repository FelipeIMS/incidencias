<?php
include('settings.php');
?>
<?php
//index.php
$query = "SELECT incidencias.id_incidencias as id, servicios.nombres as nombreservicio,tipo_servicio.nombrets as nombretipo,observacion, fechaInicio, fechaFin, area.nombreArea as nombre_area  FROM incidencias
inner join servicios on servicios.id_servicio = incidencias.id_servicio_1
inner join tipo_servicio on tipo_servicio.id_tipoServicio = incidencias.id_tipoServicio_1
inner join area on area.id_area = incidencias.id_area_1
ORDER BY id ASC ;";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php
    $accion = isset($_POST['accion'])?$_POST['accion']:"";
    $id= isset($_POST['id'])?$_POST['id']:"";
    $fin= isset($_POST['fin'])?$_POST['fin']:"";

    switch($accion){
        case("Finalizar"):
            if($fin==null){
                $sql = "UPDATE incidencias set fechaFin= now() where id_incidencias = '$id'";
                $resultado = $conn -> query($sql);
                if($resultado){
                    echo "<script>  Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'INCIDENCIA FINALIZADA',
                        text:'INCIDENCIA FINALIZADA EXITOSAMENTE',
                        showConfirmButton: false,
                        timer: 3000
                      });</script>";
                      echo '<script type="text/JavaScript"> setTimeout(function(){
                        window.location="index.php";
                     }, 3000); </script>';
                }
            }else{
                echo "<script>  Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'ERROR AL FINALIZAR',
                    text: 'INCIDENCIA YA FINALIZADA',
                    showConfirmButton: false,
                    timer: 3000
                  });</script>";
                  echo '<script type="text/JavaScript"> setTimeout(function(){
                   window.location="index.php";
                }, 3000); </script>';
            }
            break;
        case("Eliminar"):
            $sql = "DELETE from incidencias WHERE id_incidencias = '$id'";
            $resultado = $conn -> query($sql);
            if($resultado){
                echo "<script>  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'INCIDENCIA ELIMINADA',
                    text:'INCIDENCIA ELIMINADA EXITOSAMENTE',
                    showConfirmButton: false,
                    timer: 3000
                });</script>";
                echo '<script type="text/JavaScript"> setTimeout(function(){
                    window.location="index.php";
                }, 3000); </script>';
            }
            break;

    }

    ?>



    <header class="header__content ">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="15"
                            alt="MDB Logo" loading="lazy" />
                    </a>
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="crear.php">Crear incidencias</a>
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                                height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="../../includes/logout.php">Cerrar Sesion</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <!-- <a href="../../includes/logout.php" class="btn btn-danger" >Logout</a> -->
        <!-- <h1 class="">This is User page, Hola: <?php $ufunc->UserName(); //Show name who is in session user?></h1> -->
    </header>
    <div class="container-fluid">

        <div class="col-md-12 mt-4">
            <table class="table table-bordered" id="tabla">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Servicio</th>
                        <th>Tipo Servicio</th>
                        <th>Area</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th width="30%">Observacion</th>
                        <th>Finalizar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["nombreservicio"]; ?></td>
                        <td><?php echo $row["nombretipo"]; ?></td>
                        <td><?php echo $row["nombre_area"]; ?></td>
                        <td><?php echo $row["fechaInicio"]; ?></td>
                        <td><?php echo $row["fechaFin"]; ?></td>
                        <td><?php echo $row["observacion"]; ?></td>
                        <td>
                            <form method="post">
                                <input type="submit" name="accion" value="Finalizar" class="btn btn-danger" <?php if ($row['fechaFin'] != null   ) { ?> style="display: none;" <?php   } ?>>
                                <input type="text" name="id" value="<?php echo $row["id"]; ?>" hidden>
                                <input type="text" name="fin" value="<?php echo $row["fechaFin"]; ?>" hidden>
                            </form>
                        </td>

                        <td>
                            <form method="post">
                                <a href="editar.php?id=<?php echo $row["id"] ?>" class='btn btn-success'>Editar</a>
                                <input type="text" name="id" value="<?php echo $row["id"]; ?>" hidden>
                                <input type="submit" name="accion" value="Eliminar" class='btn btn-danger'></input>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <script src="./js/main.js"></script>
    
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></scrip>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>


</body>

</html>