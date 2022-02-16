<?php include 'settings.php'; //include settings 

?>

<?php
//index.php
$conn->query("SET lc_time_names = 'es_ES'");
$query = "SELECT incidencias.id_incidencias as id, servicios.nombres as nombreservicio,tipo_servicio.nombrets as nombretipo  FROM incidencias
inner join servicios on servicios.id_servicio = incidencias.id_servicio_1
inner join tipo_servicio on tipo_servicio.id_tipoServicio = incidencias.id_servicio_1
order by  id ASC";
$result = mysqli_query($conn, $query);


$grafico = "SELECT MonthName(fechaInicio) AS mes, count(*) AS numFilas FROM incidencias GROUP BY mes"; // Consulta SQL
$query2 = $conn->query($grafico); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while ($r = $query2->fetch_object()) { // Recorrer los resultados de Ejecutar la consulta SQL
  $data[] = $r; // Guardar los resultados en la variable $data
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>CRUD INCIDENCIAS</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./chart.min.js"></script>


</head>

<body>
  <br /><br />
  <div class="container" style="width:700px;">
    <h3 align="center">Incidencias Clinica Lircay</h3>
    <br />
    <div class="table-responsive">
      <div align="right">
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Registrar Tipo Servicio</button>
      </div>
      <br />
      <div id="employee_table">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>Servicio</th>
            <th>Tipo</th>
            <th>Ver</th>

          </tr>
          <?php
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["nombreservicio"]; ?></td>
              <td><?php echo $row["nombretipo"]; ?></td>
              <td><input type="button" name="view" value="Ver" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
  <div class="container">
    <h1 class="text-center">Incidencias por mes</h1>
    <canvas id="chart1" style="width:100%;" height="100"></canvas>
    <script>
      var ctx = document.getElementById("chart1");
      var data = {
        labels: [
          <?php foreach ($data as $d) : ?> "<?php echo $d->mes ?>",
          <?php endforeach; ?>
        ],
        datasets: [{
          
          label: ' Cantidad de Incidencias por mes',
          data: [
            <?php foreach ($data as $d) : ?>
              <?php echo $d->numFilas; ?>,
            <?php endforeach; ?>
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
           
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
          
          ],
          borderWidth: 2
        }]
      };
      var options = {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      };
      var chart1 = new Chart(ctx, {
        type: 'bar',
        /* valores: line, bar*/
        data: data,
        options: options
      });
    </script>
  </div>
</body>

</html>

<div id="add_data_Modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registro Tipo Servicio</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="insert_form">
          <label>Nombre tipo servicio</label>
          <input type="text" name="nombrets" id="nombrets" class="form-control" />
          <br />
          <?php
          $resultado = $conn->query("SELECT * FROM servicios ORDER BY  nombres");
          $t = mysqli_num_rows($resultado);
          ?>
          <label>Servicio</label>
          <select class="browser-default custom-select" name="servicioid" id="servicioid">
            <?php
            if ($t >= 1) {
              while ($row = $resultado->fetch_object()) {
            ?>
                <option value="<?php echo  $row->id_servicio ?>"><?php echo  $row->nombres ?></option>
            <?php
              }
            }
            ?>
          </select>
          <br>
          <input type="submit" name="insert" id="insert" value="Guardar" class="btn btn-success" style="margin-top: 20px;" />

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

<div id="dataModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Detalle Incidencia</h4>
      </div>
      <div class="modal-body" id="employee_detail">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#insert_form').on("submit", function(event) {
      event.preventDefault();
      if ($('#nombrets').val() == "") {
        alert("Name is required");
      } else if ($('#address').val() == '') {
        alert("Address is required");
      } else if ($('#designation').val() == '') {
        alert("Designation is required");
      } else {
        $.ajax({
          url: "insert.php",
          method: "POST",
          data: $('#insert_form').serialize(),
          beforeSend: function() {
            $('#insert').val("Inserting");

          },
          success: function(data) {
            $('#insert_form')[0].reset();
            $('#add_data_Modal').modal('hide');
            $('#employee_table').html(data);

          }
        });
      }
    });




    $(document).on('click', '.view_data', function() {
      //$('#dataModal').modal();
      var id = $(this).attr("id");
      $.ajax({
        url: "select.php",
        method: "POST",
        data: {
          id: id
        },
        success: function(data) {
          $('#employee_detail').html(data);
          $('#dataModal').modal('show');
        }
      });
    });
  });
</script>