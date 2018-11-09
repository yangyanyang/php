<?php 
header("Content-type:text/html;charset=utf-8");

function workList($month,$year){
	// for()
	$mydays = "";
	$days = cal_days_in_month(CAL_GREGORIAN,$month,$year); //返回一个月多少天

	//echo "day $days <br>";
	for($x=1; $x<=$days; $x++){
		if($x == $days){
			$mydays .= "$year" . "$month" ."$x" ;
			
		}
		else{
			// echo "x $x";
			if($x<10){
				$x = "0$x";
			}
			else{
				$x = $x;
			}
			$mydays .= "$year$month$x,";
		}
		    

	}
	// echo "aaa $mydays <br>";
	$data = array("d" => $mydays,"ak" => "p436.fe41d53f14659c140b4f2dd14885197f" );
	$data_string = $data;
	$url = "http://www.easybots.cn/api/holiday.php";
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data_string );
	$response = curl_exec($ch);
	//print_r($response);
	if (curl_errno($ch)) {
	    print curl_error($ch);
	}
	curl_close($ch);
	//echo $response;


	$result = json_decode($response);
	//var_dump($result);

	$workday = array();
	$holiday = array();
	$allday = array();
	if(!empty($result)){
	foreach($result as $day=>$index){

    	array_push($allday,$day);
    	if($index == 0)
    	{
            array_push($workday,$day);
    	}
    	else{
    		array_push($holiday,$day);
    	}

	}
}
	$work_hol = array('workday'=> $workday,'holiday'=>$holiday,'allday' => $allday);

	// var_dump($workday);
	return $work_hol;

}

$month = 10;
$year = 2018;

function holiday($day){
	// echo "$day <br>";
    $year = substr($day,0,4);
    $month = substr($day,4,2); 
    // echo "$year <br> $month";
	$holiday = workList($month,$year)["holiday"];
    //echo json_encode($holiday);
    foreach ($holiday as $value) {
    	if($day == $value){
    		//echo "holiday <br>";
    		return true;
    		
    	}
    }
    return false;

}
// if( holiday($month,$year,"20181007")){
// 	echo "holiday <br>";

// }
// if(!holiday("20181027")){
// echo "notholiday <br>";
// }
// else{
// 	echo "holiday <br>";
// }


function chuqin_day_num($uid){
		$chuqin_day_num = 0;
		$chidao_day_num = 0;
		$chidao_day_time_list = array();  //"2018-10-10 09:55:00"
		$chidao_day_time_list_tmp = array();
		$chuqin_day_time_list = array(); //"2018-10-10 09:55:00 2018-10-10 19:55:00 "
		$chuqin_day_time_list_tmp = array();
		$wanjiaban_work = 0;
		$jiaban_work_day_list = array(); //2018-10-10
		$jiaban_week = 0;
		$jiaban_week_time = 0;      //7h
		$jiaban_week_time_list = array(); //"2018-10-10 09:55:00 2018-10-10 19:55:00 "
		$jiaban_week_time_list_tmp = array(); //"2018-10-10 09:55:00 2018-10-10 19:55:00 "
		$shangban_time = "09:15:00";
		$xiaban_time = "18:00:00";
		$wanjiaban_time = "20:30:00";
		$chidao_time = "09:30:00";
		$chuqin_least_time = "11:30:00";
		$qingjia_time_list = array();  //"2018-10-10 09:55:00 2018-10-10 19:55:00 "
		$qingjia_tmp = array();
		$result = array();
	    $month = 10;
	    $year = 2018;
	    $workday = workList($month,$year)["workday"];
	    $holiday = workList($month,$year)["holiday"];
	    $allday = workList($month,$year)["allday"];
	    //$days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
	    // array_push($allmonthday,$workday);
	    // array_push($allmonthday,$holiday);
	    // echo json_encode($allday);
		$conn = new mysqli('127.0.0.1','root','','mdb');
		if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
		}

		foreach($workday as $value){	    	
	    	$day = $value;
	    	//echo $day ."<br/>";
	    	$sql = "select min(CHECKTIME) as first,max(CHECKTIME) as end from checkinout where date_format(CHECKTIME,'%Y%m%d')=" .$day ." and USERID = " .$uid;
	    	$rs = $conn->query($sql);
	    	$rows = array();
	    	//echo $sql;
	    	while($row = $rs->fetch_assoc()){

	    		array_push($rows, $row);
	    	}
	    	//var_dump($rows);
	    	$first=  strstr( $rows[0]["first"], ' ');
	    	$end=  strstr( $rows[0]["end"], ' ');
	    	// var_dump($rows);
	    	// if(!holiday($day)){
		    	if( !empty($first)&& !empty($end) ){
			    	if(dateBDate($wanjiaban_time ,$end)){
		    			$wanjiaban_work++;
		    			// $jiaban_work_day_list=array('first'=>$)
		    			array_push($jiaban_work_day_list,$day);
		    			if(dateBDate($first,$chuqin_least_time)){
		    				$chuqin_day_num++;
		    				$chuqin_day_time_list_tmp["day"] = $day;
		    				$chuqin_day_time_list_tmp["first"] = $first;
		    				$chuqin_day_time_list_tmp["end"] = $end;
		    				array_push($chuqin_day_time_list,$chuqin_day_time_list_tmp);
		    				if(dateBDate($shangban_time, $first)&&dateBDate($first, $chidao_time)){
				    			$chidao_day_num++;
				    			$chidao_day_time_list_tmp["day"] = $day;
				    			$chidao_day_time_list_tmp["first"] = $first;
				    			$chidao_day_time_list_tmp["end"] = $end;
				    			array_push($chidao_day_time_list,$chidao_day_time_list_tmp);
				    		}
				    		elseif(dateBDate($chidao_time,$first)){
				    			// echo "$first <br>";
				    			$qingjia_tmp['day'] = $day;
				    			$qingjia_tmp['first'] = $first;
				    			$qingjia_tmp['end'] = $end;
				    			array_push($qingjia_time_list,$qingjia_tmp);
				    			
				    		}
		    			}
		    			else{
		    				$qingjia_tmp['day'] = $day;
		    				$qingjia_tmp['first'] = $first;
		    				$qingjia_tmp['end'] = $end;
		    				array_push($qingjia_time_list,$qingjia_tmp);
		    			}

			    	}
			    	elseif(dateBDate($xiaban_time,$end)){
		                if(dateBDate($first,$chuqin_least_time)){
		    				$chuqin_day_num++;
		    				$chuqin_day_time_list_tmp["day"] = $day;
		    				$chuqin_day_time_list_tmp["first"] = $first;
		    				$chuqin_day_time_list_tmp["end"] = $end;
		    				array_push($chuqin_day_time_list,$chuqin_day_time_list_tmp);
		    				if(dateBDate($shangban_time, $first)&&dateBDate($first, $chidao_time)){
				    			$chidao_day_num++;
				    			$chidao_day_time_list_tmp["day"] = $day;
				    			$chidao_day_time_list_tmp["first"] = $first;
				    			$chidao_day_time_list_tmp["end"] = $end;
				    			array_push($chidao_day_time_list,$chidao_day_time_list_tmp);
				    		}
				    		elseif(dateBDate($chidao_time,$first)){
				    			echo "$first <br>";
				    			$qingjia_tmp['day'] = $day;
				    			$qingjia_tmp['first'] = $first;
			    				$qingjia_tmp['end'] = $end;
			    				array_push($qingjia_time_list,$qingjia_tmp);
				    		}
		    			}
		    			else{
		    				$qingjia_tmp['day'] = $day;
		    				$qingjia_tmp['first'] = $first;
		    				$qingjia_tmp['end'] = $end;
		    				array_push($qingjia_time_list,$qingjia_tmp);
		    			}

			    	}
			    	else{
			    		$qingjia_tmp['day'] = $day;
			    		$qingjia_tmp['first'] = $first;
			    		$qingjia_tmp['end'] = $end;
			    		array_push($qingjia_time_list,$qingjia_tmp);
			    	}
			    }
			    else{
			    	$first = empty($first)?'0':$first;
			    	$end = empty($end)?'0':$end;
			    	$qingjia_tmp['day'] = $day;
			    	$qingjia_tmp['first'] = $first;
			    	$qingjia_tmp['end'] = $end;
			    	array_push($qingjia_time_list,$qingjia_tmp);
			    }
			}
			foreach($holiday as $value){	    	
		    	$day = $value;
		    	//echo $day ."<br/>";
		    	$sql = "select min(CHECKTIME) as first,max(CHECKTIME) as end from checkinout where date_format(CHECKTIME,'%Y%m%d')=" .$day ." and USERID = " .$uid;
		    	$rs = $conn->query($sql);
		    	$rows = array();
		    	//echo $sql;
		    	while($row = $rs->fetch_assoc()){

		    		array_push($rows, $row);
		    	}
		    	//var_dump($rows);
		    	$first=  strstr( $rows[0]["first"], ' ');
		    	$end=  strstr( $rows[0]["end"], ' ');
		    	$first = empty($first)?'0':$first;
		    	$end = empty($end)?'0':$end;
    			// $jiaban_week_time = $end - $first;
    			$jiaban_week_time += floor((strtotime($end)-strtotime($first))%86400/3600);
    			$jiaban_week_time1 = floor((strtotime($end)-strtotime($first))%86400/3600);
    			// echo "jiaban_week_time $jiaban_week_time1   <br>";
    			// echo "day:$day first:$first end:$end<br>";    			
    			$jiaban_week_time_list_tmp['day'] = $day;
    			$jiaban_week_time_list_tmp['first'] = $first;
    			$jiaban_week_time_list_tmp['end'] = $end;
    			$jiaban_week_time_list_tmp['jiaban_week_time'] = $jiaban_week_time1;


    			array_push($jiaban_week_time_list,$jiaban_week_time_list_tmp);
		    }
			// }
	  //   	else{
	  //   		$first = empty($first)?'0':$first;
		 //    	$end = empty($end)?'0':$end;
   //  			// $jiaban_week_time = $end - $first;
   //  			$jiaban_week_time += floor((strtotime($end)-strtotime($first))%86400/3600);
   //  			$jiaban_week_time1 = floor((strtotime($end)-strtotime($first))%86400/3600);
   //  			echo "jiaban_week_time $jiaban_week_time   <br>";
   //  			echo "day:$day first:$first end:$end<br>";    			
   //  			$jiaban_week_time_list_tmp['day'] = $day;
   //  			$jiaban_week_time_list_tmp['first'] = $first;
   //  			$jiaban_week_time_list_tmp['end'] = $end;
   //  			$jiaban_week_time_list_tmp['jiaban_week_time'] = $jiaban_week_time1;


   //  			array_push($jiaban_week_time_list,$jiaban_week_time_list_tmp);
   //  			// $wanjiaban_work++;
	  //   	} 		

	    	// $conn->close();


        $conn->close();
		$result = array('chuqin_day_num' =>$chuqin_day_num ,'wanjiaban_work' =>$wanjiaban_work,
		'chidao_day_num' =>$chidao_day_num, 'chidao_day_time_list'=>$chidao_day_time_list,
		 'jiaban_work_day_list' => $jiaban_work_day_list,'qingjia_time_list'=> $qingjia_time_list,'chuqin_day_time_list'=>$chuqin_day_time_list,'jiaban_week_time' => $jiaban_week_time,'jiaban_week_time_list' => $jiaban_week_time_list);
		return $result;
}

function dateBDate($date1, $date2) {
// 日期1是是否小于日期2
	 $h1 = date("H", strtotime($date1));
	 $h2 = date("H", strtotime($date2));
	 $i1 = date("i", strtotime($date1));
	 $i2 = date("i", strtotime($date2));
	 $s1 = date("s", strtotime($date1));
	 $s2 = date("d", strtotime($date2));
	 
	 $from = mktime($h1,$i1,$s1,0, 0, 0);
	 $to = mktime($h2,$i2,$s2,0, 0, 0);
	 if ($from <= $to) {
	 	return true;
	 } 
	 else {
	 	return false;
	 } 
} 	

$result = chuqin_day_num(7);
echo json_encode($result);





?>