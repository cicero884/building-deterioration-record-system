<?php
$DB_SERVER= 'localhost';
$DB_USERNAME= 'web';
$DB_PASSWORD= 'groupE_1';
$DB_DATABASE= 'building';

try {
	$conn =new PDO("mysql:host=$DB_SERVER;dbname=$DB_DATABASE",$DB_USERNAME,$DB_PASSWORD);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	#echo "Connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
?>
