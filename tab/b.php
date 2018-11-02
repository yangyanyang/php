<?php
header("Content-type:text/html;charset=utf-8");
    //print_r($_REQUEST);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : '';
	$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
	$start_time = isset($_POST['user_time1']) ? $_POST['user_time1'] : '';
	$end_time = isset($_POST['user_time2']) ? $_POST['user_time2'] : '';
	//$user_id = 3;
	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    //echo "连接成功";
	//mysql_select_db('mytest',$conn);
	$where = "user_id>0";
	$where1 = "user_id>0";
	$where2 = "user_id>0";

	if(!empty($start_time) && !empty($end_time)){
		$where1 =$where1 . " and user_time >= '$start_time' and user_time <= '$end_time'";
		$where2 =$where2 . " and first >= '$start_time' and end <= '$end_time'";
	}
	// $where1 = "user_id>0 and user_time >= '$start_time' and user_time <= '$end_time'";
	// $where2 = "user_id>0 and first >= '$start_time' and end <= '$end_time'";

	if(!empty($user_name) && !empty($user_id)){
		$where .="and user_name = '$user_name'";
		$where2 .="and user_name = '$user_name'";
	}
	//echo "之后 : ".$user_name .$where;
	// $sql = "select count(*) from testdaka where " . $where;
	// $rs =  $conn->query($sql);
	// $row = $rs->fetch_array();
	// $result["total"] = $row[0];
	
	$sql1 = "CREATE OR REPLACE VIEW aa AS select user_id,user_name,min(user_time) as first,max(user_time) as end from testdaka where " .$where	 . " GROUP BY DATE_FORMAT(user_time,'%Y-%c-%d'),user_id  order by user_id,first  ";
	$conn->query($sql1);
	//echo "where2aaa" .$where2;
	$sql = "select count(*) from aa where " . $where2;

	//echo $sql;
	$rs =  $conn->query($sql);
	$row = $rs->fetch_array();
	$result["total"] = $row[0];
    $result["page"] = ["total"=>$row[0]];
	$sql1 = "select user_id,user_name,first,end from aa where " .$where2 ." limit $offset,$rows" ;
	$rs = $conn->query($sql1);
	//$rs = mysql_query("select * from testdaka limit $offset,$rows");
    
	$rows = array();
	while($row = $rs->fetch_assoc()){

		array_push($rows, $row);
	}

	$result["group"] = $rows;
	
	echo json_encode($result);
?>