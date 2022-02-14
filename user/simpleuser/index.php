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
	<link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
	<script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
    <script language="javascript">
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

</head>

<body>
    <header class="header__content">
        <h1>This is User page, Hola: <?php $ufunc->UserName(); //Show name who is in session user?></h1>
    </header>


    





    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>