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

<div class="container">
<div class="col-md-6" style = "margin: 50px auto;">
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
        
                    <select class="form-select form-select-md mt-3" name="combo_ts" id="combo_ts" style="margin: 0 auto; width: 400px;"></select>


                    <select class="form-select form-select-md mt-3" name="select_area" id="select_area" aria-label=".form-select-sm example" style="margin: 0 auto; width: 400px;">
                        <option value="0"> Area</option>
                        <?php while($row = $resultado2->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_area']; ?>"><?php echo $row['nombreArea']; ?></option>
                        <?php } ?>
        
                    </select>
        
                    <div class="form-outline mt-3 mb-3" style="margin: 0 auto; width: 400px;">
                        <input type="text" id="fechaF" name="fechaFin" class="form-control" disabled />
                        <label class="form-label" for="fechaF">Termino</label>
                    </div>
        
                    <div class="form-outline mb-3 " style="margin: 0 auto; width: 400px;">
                        <textarea required class="form-control" id="obs" name="obs" style="resize: none;" rows="6"></textarea>
                        <label class="form-label" for="obs">Observacion</label>
                    </div>

                    <div class="card-footer mt-3">
                        <input type="submit" class="btn btn-success" id="enviar" name="enviar" value="Guardar" style="float:left" />
                        <input type="submit" class="btn btn-danger" id="enviar" name="enviar" value="Volver" style="float:right" />

                    </div>
        
                </form>
            </div>
        </div>
    </div>
</div>


   

    <script  src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript">
    </script>
    <script l>
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
    </script>

</body>

</html>