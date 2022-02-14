<?php	
	include 'settings.php'; //include settings
	$query = "SELECT id_servicio, nombres FROM servicios ORDER BY nombres";
	$resultado=$conn->query($query);
	$query2 = "SELECT id_area, nombreArea FROM area ORDER BY nombreArea";
	$resultado2=$conn->query($query2);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SIMPLE USER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
    <script language="javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#combo_servicio").change(function () {
 
					$('#combo_area').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#combo_servicio option:selected").each(function () {
						id_tp = $(this).val();
						$.post("get_ts.php", { id_tp: id_tp }, function(data){
							$("#combo_ts").html(data);
						});            
					});
				})
			});
		</script>
		
  </head>
  <body>
	  <header class= "header__content">
		  <h1>This is User page, Hola: <?php $ufunc->UserName(); //Show name who is in session user?></h1>
	  </header>
	  <div class="container">

		  <div class="col-md-12">
			  <div class="card text-center">
				<div class="card-header">Registrar Incidencia</div>
				<div class="card-body">
					<form id="combo" name="combo" action="guarda.php" method="POST">
						
						<div class="mt-3">Selecciona Servicio : <select name="combo_servicio" id="combo_servicio">
							<option value="0">Seleccionar Servicio</option>
							<?php while($row = $resultado->fetch_assoc()) { ?>
								<option value="<?php echo $row['id_servicio']; ?>"><?php echo $row['nombres']; ?></option>
							<?php } ?>
						</select></div>
						
						<div class="mt-3 mb-3">Selecciona Tipo de Servicio : <select name="combo_ts" id="combo_ts"></select></div>
						
						<div>Selecciona Area : <select name="select_area" id="select_area">
						<option value="0">Seleccionar Area</option>
							<?php while($row = $resultado2->fetch_assoc()) { ?>
								<option value="<?php echo $row['id_area']; ?>"><?php echo $row['nombreArea']; ?></option>
							<?php } ?>
						</select></div>
						<div class="form-outline mt-3 mb-3 w-50" style="margin: 0 auto;">
							<input type="text" id="fechaF" name="fechaFin" class="form-control" />
							<label class="form-label" for="fechaF">Fecha Fin</label>
						</div>
			
						<div class="form-outline mb-3 w-50" style="margin: 0 auto;">
							<textarea class="form-control" id="obs" name="obs" style= "resize: none;" rows="4"></textarea>
							<label class="form-label" for="obs">Observacion</label>
						</div>
						<button type="button" class="btn btn-success">Finalizar incidencia</button>
						
						<div class="card-footer text-muted mt-3">
							<input type="submit" class="btn btn-info" id="enviar" name="enviar" value="Guardar" />
						</div>
					</form>
					
				</div>
			</div>
		  </div>
			<a class="btn btn-primary" href="../../includes/logout.php">Logout</a>
	  </div>
		
		
		
		
		
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script
		type="text/javascript"
		src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
	></script>
  </body>
</html>
