<?php
$dbhost = "localhost"; //Host
$dbuser = "root"; //Database user
$dbpass = "2497"; //Database password
$dbname = "incidencias_s"; //Database name
$conn = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname"); //Connection
mysqli_set_charset($conn,"utf8"); //UTF-8 for Turkish letters
?>
