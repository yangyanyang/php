<?php
header("Content-type:text/html;charset=utf-8");
	$row = isset($_REQUEST['row']) ? $_REQUEST['row'] : '';
	$uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';

	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    
	//$sql = "select count(distinct user_name) from testdaka";
	//$rs =  $conn->query($sql);
	//$row = $rs->fetch_array();
	//$result["total"] = $row[0];
	
	$sql1 = "delete from testbudaka  where uid = ".$uid ;
	echo $sql1;
	$rs = $conn->query($sql1);
	//$row = $rs->fetch_array();
    
	// $rows = array();
	// while($row = $rs->fetch_assoc()){

	// 	array_push($rows, $row);
	// }
	// //$result["rows"] = $rows;
	
	//echo json_encode($rows);
?>