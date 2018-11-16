<?php
header("Content-type:text/html;charset=utf-8");
    //print_r($_REQUEST);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$degree = $_REQUEST['degree'];
	$id = $_REQUEST['id'];
	// echo $degree;
	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    
	//$sql = "select count(distinct user_name) from testdaka";
	//$rs =  $conn->query($sql);
	//$row = $rs->fetch_array();
	//$result["total"] = $row[0];
	
	$sql1 = "UPDATE threat SET degree = '$degree' where id = $id ";
	$rs = $conn->query($sql1);
    
	$rows = array();
	// while($row = $rs->fetch_assoc()){

	// 	array_push($rows, $row);
	// }
	
	
    $result["page"] = ["total"=>"20"];
	

	$result["group"] = $rows;
	
	echo json_encode($result);


$file  = 'log.txt';
$content = "第一次写入的内容\n";

if($f  = file_put_contents($file," $sql1\n",FILE_APPEND)){
//echo "success";
}
?>