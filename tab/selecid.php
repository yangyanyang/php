<?php
header("Content-type:text/html;charset=utf-8");

	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mdb');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    
	//$sql = "select count(distinct user_name) from testdaka";
	//$rs =  $conn->query($sql);
	//$row = $rs->fetch_array();
	//$result["total"] = $row[0];
	
	$sql1 = "select USERID,Name from userinfo  group by Name order by USERID";
	$rs = $conn->query($sql1);
    
	$rows = array();
	while($row = $rs->fetch_assoc()){

		array_push($rows, $row);
	}
	//$result["rows"] = $rows;
	
	echo json_encode($rows);
?>