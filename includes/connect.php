<?php
$dbhost = "192.168.2.175:3306"; //Host
$dbuser = "username"; //Database user
$dbpass = "password"; //Database password
$dbname = "incidencias_s"; //Database name
$conn = mysqli_connect("$dbhost", "$dbuser", "$dbpass", "$dbname"); //Connection
mysqli_set_charset($conn,"utf8"); //UTF-8 for Turkish letters
?>
