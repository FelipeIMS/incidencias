<?php	
	include 'settings.php'; //include settings
    $id = $_GET['id'];
	$query = "SELECT incidencias.id_incidencias as id, servicios.nombres as nombreservicio,tipo_servicio.nombrets as nombretipo,observacion, fechaInicio, fechaFin, area.nombreArea as nombre_area  FROM incidencias
    inner join servicios on servicios.id_servicio = incidencias.id_servicio_1
    inner join tipo_servicio on tipo_servicio.id_tipoServicio = incidencias.id_tipoServicio_1 
    inner join area on area.id_area = incidencias.id_area_1
    where incidencias.id_incidencias = '$id';";
	$resultado=$conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Incidencia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <header class="header__container">
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

    </header>
    <?php

    $accion = (isset($_POST['accion']))?$_POST['accion']:"";

    switch($accion){
        case("Guardar"):
            
            $observacion = $_POST['obs'];
            $query="UPDATE incidencias SET observacion = '$observacion' WHERE id_incidencias = '$id';";
            if(mysqli_query($conn, $query)){
                echo "<script>  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro actualizado exitosamente',
                    text: 'Observacion actualizada correctamente',
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
    <div class="container-fluid">
        <div class="col-md-6" style="margin: 50px auto;">
            <div class="card text-center">
                <div class="card-header">
                    Crear Incidencia
                </div>
                <div class="card-body">
                    <form method="POST">



                        <?php while($row = $resultado->fetch_assoc()) { ?>
                            <div class="md-form" style="margin: 0 auto; width: 400px;">
                                <div class="md-form">
                                    <label for="form1">Servicio</label>
                                    <input type="text" id="form1" class="form-control text-center" value="<?php echo $row['nombreservicio']; ?>" disabled  >
                                </div>
                                <div class="md-form mt-3">
                                    <label for="form2">Tipo servicio</label>
                                    <input type="text" id="form2" class="form-control text-center" value="<?php echo $row['nombretipo']; ?>" disabled  >
                                </div>
                                <div class="md-form mt-3">
                                    <label for="form2">Fecha inicio</label>
                                    <input type="text" id="form2" class="form-control text-center" value="<?php echo $row['fechaInicio']; ?>" disabled  >
                                </div>
                                <div class="md-form mt-3">
                                    <label for="form2">Fecha fin</label>
                                    <input type="text" id="form2" class="form-control text-center" value="<?php echo $row['fechaFin']; ?>" disabled  >
                                </div>
                                <div class="md-form mt-3">
                                    <label class="form-label" for="obs">Observacion</label>
                                    <textarea required class="form-control" id="obs" name="obs" style="resize: none;" rows="6"><?php echo $row['observacion']; ?></textarea>
                                </div>
                            </div>
                            <?php } ?>

                        <div class="card-footer mt-3">
                            <button name="accion" value="Guardar" class="btn btn-success" style="float:left">Guardar</button>
                            <a href="index.php" class="btn btn-danger" style="float:right">Volver</a>
                            <!-- <input type="submit" class="btn btn-danger" id="enviar" name="enviar" value="Volver" style="float:right" /> -->

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <!-- <script>
    $(document).ready(function() {
        $("#combo_servicio").change(function() {

            $('#combo_area').find('option').remove().end().append('<option value="whatever"></option>')
                .val('whatever');

            $("#combo_servicio option:selected").each(function() {
                id_tp = $(this).val();
                $.post("get_ts.php", {
                    id_tp: id_tp
                }, function(data) {
                    $("#combo_ts").html(data);
                });
            });
        })
    });
    </script> -->
    <!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#combo').on('submit', function(e) { //Don't foget to change the id form
            $.ajax({
                url: 'guarda.php', //===PHP file name====
                data: $(this).serialize(),
                type: 'POST',
                success: function(data) {
                    console.log(data);
                    //Success Message == 'Title', 'Message body', Last one leave as it is
                    // swal("¡Guardado!", "Incidencia guardada con exito!", "success")
                }
            });
            e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
        });
    });
    </script> -->


</body>

</html>