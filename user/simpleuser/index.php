<?php	
	include 'settings.php'; //include settings
	$query = "SELECT id, nombres FROM servicios ORDER BY nombres";
	$resultado=$conn->query($query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SIMPLE USER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
    <script languaje="javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#combo_servicio").change(function () {
 
					$('#combo_area').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#combo_servicio option:selected").each(function () {
						id = $(this).val();
						$.post("get_ts.php", { id: id }, function(data){
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
	<center>
		<form id="combo" name="combo" action="guarda.php" method="POST">
				<div>Selecciona Servicio : <select name="combo_servicio" id="combo_servicio">
					<option value="0">Seleccionar Estado</option>
					<?php while($row = $resultado->fetch_assoc()) { ?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['nombres']; ?></option>
					<?php } ?>
				</select></div>
				
				<br />
				
				<div>Selecciona Tipo de Servicio : <select name="combo_ts" id="combo_ts"></select></div>
				
				<br />
				<div class="form-outline mb-4 w-25">
					<input type="text" id="form1Example1" class="form-control" />
					<label class="form-label" for="form1Example1">Email address</label>
				</div>
	
				<!-- Password input -->
				<div class="form-outline mb-4 w-25">
					<input type="text" id="form1Example2" class="form-control" />
					<label class="form-label" for="form1Example2">Password</label>
				</div>
				<div class="form-outline mb-4 w-25">
					<input type="text" id="form1Example2" class="form-control" />
					<label class="form-label" for="form1Example2">Password</label>
				</div>
				<div class="form-outline mb-4 w-25 ">
					<textarea class="form-control" id="textAreaExample" style= "resize: none;" rows="4"></textarea>
					<label class="form-label" for="textAreaExample">Message</label>
				</div>
	
				<input type="submit" id="enviar" name="enviar" value="Guardar" />
			</form>

			<a class="btn btn-primary" href="../../includes/logout.php">Logout</a>
			<script
				type="text/javascript"
				src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
			></script>
	</center>

    




  </body>
</html>
