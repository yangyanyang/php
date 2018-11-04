<?php
header("Content-type:text/html;charset=utf-8");
    //print_r($_REQUEST);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id']: '';
	$user_name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : '';
	//$user_name = "周瑞红";
	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    //echo "连接成功";
	
	
	$where = "user_id = '$user_id'";

	//echo "之后 : ".$user_name .$where;
	$sql = "select count(*) from testbudaka where " . $where;
	//echo $sql;
	$rs =  $conn->query($sql);
	$row = $rs->fetch_array();
	//print_r($rs);
	$result["total"] = $row[0];
	$result["page"] = ["total"=>$row[0]];
	$sql1 = "select a.uid,b.userid,b.username,a.user_time,a.image_url from testbudaka as a join login_table as b  on a.user_id=b.userid and ". $where ." limit $offset,$rows";	
	$rs = $conn->query($sql1);
	//$rs = mysql_query("select * from testdaka limit $offset,$rows");
    //echo $sql1;
	$rows = array();
	while($row = $rs->fetch_assoc()){

		array_push($rows, $row);
	}
	$result["group"] = $rows;
	
	echo json_encode($result);
?>