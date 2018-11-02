<?php 
header("Content-type:text/html;charset=utf-8");
$legend = array(0=>"蒸发量",1=>"降水量");
 
			//构建横坐标
			$xAxis_data = array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
			
			//构建数据内容数组
			$series =array();
 
			//由于需要{"name":"",type":"","data":""}类型的json值，使用关联数组
			$serie1 = array();
			$serie1["name"] = "蒸发量";
			$serie1["type"] = "bar";
			$data = array(2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3);
			$serie1["data"] = $data;
 
			//由于需要{"name":"",type":"","data":""}类型的json值，使用关联数组
			$serie2 = array();
			$serie2["name"] = "降水量";
			$serie2["type"] = "bar";
			$data = array(2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3);
			$serie2["data"] = $data;
 
			//由于最终的数组内容是["",""]格式的json，所以使用索引数组
			array_push($series, $serie1);
			array_push($series, $serie2);	
 
			// 由于需要{"legend":"value1","xAxis_data":"value2","series":"value3"}的json值，应该使用关联数组
			$result = array();
			$result["legend"] = $legend;
			$result["xAxis_data"] = $xAxis_data;
			$result["series"] = $series;
 
			//返回json
			header("Content-Type:application/json");
			echo json_encode($result);
 ?>