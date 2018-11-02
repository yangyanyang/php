<?php
header("Content-type:text/html;charset=utf-8");

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    //echo "连接成功";
	//mysql_select_db('mytest',$conn);
	$sql = "select count(*) from testdaka";
	$rs =  $conn->query($sql);
	$row = $rs->fetch_array();
	$result["total"] = $row[0];
	
	$sql1 = "select user_id,user_name,min(user_time) as first,max(user_time) as end from testdaka where user_id = 1 GROUP BY DATE_FORMAT(user_time,'%Y-%c-%d') limit $offset,$rows";
	$rs = $conn->query($sql1);
	//$rs = mysql_query("select * from testdaka limit $offset,$rows");
    
	$rows = array();
	while($row = $rs->fetch_assoc()){

		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>