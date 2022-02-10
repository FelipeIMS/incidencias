<?php include 'settings.php'; //include settings 
?>

<?php
//index.php
$query = "select  i.id as id_inci, s.nombres as nombreservicio,tp.nombrets as nombretipo from incidencias i
inner join servicios s on  i.id_servicio_1=s.id
inner join tipo_servicio tp on  tp.id = s.id_tipoServicio_1;";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
  <title>CRUD INCIDENCIAS</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
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
            <td><?php echo $row["id_inci"]; ?></td>
              <td><?php echo $row["nombreservicio"]; ?></td>
              <td><?php echo $row["nombretipo"]; ?></td>
              <td><input type="button" name="view" value="Ver" id="<?php echo $row["id_inci"]; ?>" class="btn btn-info btn-xs view_data" /></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
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
         
          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Salir</button>
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