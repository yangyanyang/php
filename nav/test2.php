<?php
header("Content-type:text/html;charset=utf-8");
    //print_r($_REQUEST);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : '';
	$user_name = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : '';
	$start_time = isset($_POST['first']) ? $_POST['first'] : '';
	$end_time = isset($_POST['end']) ? $_POST['end'] : '';
	//$user_id = 3;
	$result = array();
	$series = array();
	$serie1 = array("log_time"=>"2018-10-11 09:00:00","log_detail"=> "大量的文件上传漏洞","log_degree" => "1","id"=>"111");
	$serie2 = array("log_time" =>"2018-10-12 06:01:00","log_detail" => "大量的文件上传漏洞","log_degree"  => "2","id"=>"111");
	array_push($series, $serie1);
	array_push($series, $serie2);
	
	
    $result["page"] = ["total"=>"20"];
	

	$result["group"] = $series;
	
	echo json_encode($result);
?>