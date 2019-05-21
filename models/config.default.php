<?php
$DB_SERVER= 'localhost';
$DB_USERNAME= '';
$DB_PASSWORD= '';
$DB_DATABASE= 'building';
$DB_ENCODING='utf8';
try {
	$conn =new PDO("mysql:host=$DB_SERVER;dbname=$DB_DATABASE;charset=$DB_ENCODING",$DB_USERNAME,$DB_PASSWORD);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("set names $DB_ENCODING");
	#echo "Connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
?>
