<?php
header("Content-type:text/html;charset=utf-8");
    //print_r($_REQUEST);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$userid = isset($_REQUEST['userid']) ? intval($_REQUEST['userid']) : '';
	//$user_name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : '';
	$start_time = isset($_POST['first']) ? $_POST['first'] : '';
	$end_time = isset($_POST['end']) ? $_POST['end'] : '';
	//$user_id = 3;
	$result = array();
	
	$conn = new mysqli('127.0.0.1','root','','mdb');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    //echo "连接成功";
	//mysql_select_db('mytest',$conn);
	$where = "a.USERID>0";
	$where1 = "a.USERID>0";
	$where2 = "USERID>0";

	if(!empty($start_time) && !empty($end_time)){
		$where1 =$where1 . " and a.CHECKTIME >= '$start_time' and a.CHECKTIME <= '$end_time'";
		$where2 =$where2 . " and first >= '$start_time' and end <= '$end_time'";
	}
	// $where1 = "user_id>0 and user_time >= '$start_time' and user_time <= '$end_time'";
	// $where2 = "user_id>0 and first >= '$start_time' and end <= '$end_time'";

	if(!empty($userid) && $userid !="27" ){
		$where .=" and a.USERID = '$userid'";
		$where2 .=" and USERID = '$userid'";
	}
	//echo "之后 :" .$where .$where2;
	// $sql = "select count(*) from testdaka where " . $where;
	// $rs =  $conn->query($sql);
	// $row = $rs->fetch_array();
	// $result["total"] = $row[0];
	
	$sql1 = "CREATE OR REPLACE VIEW aa AS select a.USERID,b.Name,min(a.CHECKTIME) as first,max(a.CHECKTIME) as end from checkinout as a join userinfo as b on a.USERID=b.USERID and " .$where	 . " GROUP BY DATE_FORMAT(a.CHECKTIME,'%Y-%c-%d'),a.USERID  order by a.USERID,first  ";
	$conn->query($sql1);
	//echo  $sql1;
	$sql = "select count(*) from aa where " . $where2;
	//echo $sql1;

	//echo $sql;
	$rs =  $conn->query($sql);
	$row = $rs->fetch_array();
	//$result["total"] = $row[0];
    $result["page"] = ["total"=>$row[0]];
    //echo json_encode($result);
	$sql1 = "select Name,USERID,first,end from aa where " .$where2 ." limit $offset,$rows" ;
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