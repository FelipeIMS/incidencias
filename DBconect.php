<?php
$db_host="192.168.2.175:3306"; //localhost server 
$db_user="username";	//database username
$db_password="password";	//database password   
$db_name="incidencias_s";	//database name

try
{
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}


?>
