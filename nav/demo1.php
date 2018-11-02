<?php 
header("Content-type:application/json;charset=utf-8");
	//横坐标
	$legend = array(0=>"杨艳阳",1=>"张康康");
	$xAxis_data = array("出勤","迟到","晚上加班次数","周末加班次数","请假","aa");
	//构建数据内容数组
	$series =array();

	//由于需要{"name":"",type":"","data":""}类型的json值，使用关联数组
	$serie1 = array();
	$serie1["name"] = "杨艳阳";
	$serie1["type"] = "bar";			
	$data = array(20, 1, 7, 0, 0, 1);
	$serie1["data"] = $data;

	//由于需要{"name":"",type":"","data":""}类型的json值，使用关联数组
	$serie2 = array();
	$serie2["name"] = "张康康";
	$serie2["type"] = "bar";
	$data = array(19, 3, 8, 1, 1, 1);
	$serie2["data"] = $data;

	//由于最终的数组内容是["",""]格式的json，所以使用索引数组
	array_push($series, $serie1);
	array_push($series, $serie2);
	// 由于需要{"legend":"value1","xAxis_data":"value2","series":"value3"}的json值，应该使用关联数组
	$result = array();
    $result["legend"] = $legend;
	$result["xAxis_data"] = $xAxis_data;
	$result["series"] = $series;
	//header("Content-Type:application/json");
	echo json_encode($result);

// $obj1 = array(20, 1, 7, 0, 0, 1);
// $obj2 = array(19, 3, 8, 1, 1, 1);
// // $data1 = {20, 1, 7, 0, 0, 1};
// // $data2 = {19, 3, 8, 1, 1, 1};
// $age = array("杨艳阳"=>$obj2,"张康康"=>$obj1);
// echo json_encode($age);
?>