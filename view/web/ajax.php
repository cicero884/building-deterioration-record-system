<?php
include('config.php');

$pc=htmlentities($_REQUEST["pc"]);
$sqlString = "";

if($pc) {
	$sqlString."and rebarExposed=1 ";
}
if($flake) {
	$sqlString." and exfoliation=1 "
}
if($crack) {
	$sqlString." and crack=1 "
}

if($addon) {
	$sqlString." and addon=1 "
}

switch($type){
case "list":
    $stmt=$conn->prepare('select * from deterioration where rebarExposed=1 and exfoliation=1');
    $stmt->execute();
    $result=$stmt->fetchAll();
	foreach($result as $student){
		echo $student['sid'].":".$student['name']."<br>";
	}
	break;
case "search":
	$user_ID=htmlentities($_REQUEST["user_ID"]);
	$stmt=$conn->prepare('select name from student_info where sid=:sid');
    $stmt->execute(['sid'=>$user_ID]);
    $result=$stmt->fetch();
	echo "Hello, ".$result[0];
	break;
case "add":
	$user_ID=htmlentities($_REQUEST["user_ID"]);
	$user_name=htmlentities($_REQUEST["user_name"]);
	$stmt=$conn->prepare('insert into student_info (sid,name) values(:s,:n)');
    $stmt->execute(['s'=>$user_ID,'n'=>$user_name]);
	break;
case "delete":
	$user_ID=htmlentities($_REQUEST["user_ID"]);
	$stmt=$conn->prepare('delete from student_info where sid=:sid');
	$stmt->execute(['sid'=>$user_ID]);
	break;
default:
	break;
}
?>
