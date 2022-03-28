<?php	
	include 'settings.php'; //include settings
	$query = "SELECT id_servicio, nombres FROM servicios ORDER BY nombres";
	$resultado=$conn->query($query);
	$query2 = "SELECT id_area, nombreArea FROM area ORDER BY nombreArea";
	$resultado2=$conn->query($query2);
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

    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet"
        type="text/css">

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
    <div class="container-fluid">
        <div class="col-md-6" style="margin: 50px auto;">
            <div class="card text-center">
                <div class="card-header">
                    Crear Incidencia
                </div>
                <div class="card-body">
                    <form id="combo" name="combo" action="guarda.php" method="POST">

                        <select name="combo_servicio" id="combo_servicio" class="form-select form-select-md mt-3"
                            aria-label=".form-select-sm example" style="margin: 0 auto; width: 400px;">
                            <option value="0"> Servicio</option>
                            <?php while($row = $resultado->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_servicio']; ?>"><?php echo $row['nombres']; ?></option>
                            <?php } ?>
                        </select>

                        <select class="form-select form-select-md mt-3" name="combo_ts" id="combo_ts"
                            style="margin: 0 auto; width: 400px;"></select>


                        <!-- <select class="form-select form-select-md mt-3" name="combo_impresora" id="combo_impresora"
                            style="margin: 0 auto; width: 400px;"></select> -->


                        <select class="form-select form-select-md mt-3" name="select_area" id="select_area"
                            aria-label=".form-select-sm example" style="margin: 0 auto; width: 400px;">
                            <option value="0"> Area</option>
                            <?php while($row = $resultado2->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_area']; ?>"><?php echo $row['nombreArea']; ?></option>
                            <?php } ?>

                        </select>

                        <div class="mt-3 mb-3 " style="margin: 0 auto; width: 400px;">
                            <label class="form-label" style="font-size:20px; font-weight: bold;"
                                for="fechaF">Inicio</label>
                            <input type='datetime-local' step=1 id="fecha_inicio" name="fecha_inicio"
                                class="form-control" />
                        </div>
                        <div class="mt-3 mb-3" style="margin: 0 auto; width: 400px;">
                            <label class="form-label" style="font-size:20px; font-weight: bold;"
                                for="fechaF">Fin</label>
                            <input type="datetime-local" step=1 id="fechaF" name="fecha_fin" class="form-control" />
                        </div>

                        <div class="form-outline mb-3 " style="margin: 0 auto; width: 400px;">
                            <textarea required class="form-control" id="obs" name="obs" style="resize: none;"
                                rows="6"></textarea>
                            <label class="form-label" for="obs">Observacion</label>
                        </div>

                        <div class="card-footer mt-3">
                            <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar"
                                style="float:left" />
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script>
    $(document).ready(function() {
        $("#combo_servicio").change(function() {

            $("#combo_servicio option:selected").each(function() {
                id_tp = $(this).val();
                $.post("get_ts.php", {
                    id_tp: id_tp
                }, function(data) {
                    $("#combo_ts").html(data);
                });
            });
            // $("#combo_servicio option:selected").each(function() {
            //     id_tp = $(this).val();
            //     $.post("get_impresora.php", {
            //         id_tp: id_tp
            //     }, function(data) {
            //         $("#combo_impresora").html(data);
            //     });
            // });
        })
    });
    </script>
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