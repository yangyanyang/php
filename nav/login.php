<?php
header("Content-type:text/html;charset=utf-8");
$urllogin = "login.html";
$url = "demo1.html";

    
	//$userid= isset($_get['userid']) ? intval($_POST['userid']) : '';
	$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';

	$pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : '';
	$result = array();	
	$conn = new mysqli('127.0.0.1','root','','mytest');
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    
    // if(empty($username)){
    // 	$username = "1";
    // 	$pwd = "1";
    // }
	//$sql = "select count(distinct user_name) from testdaka";
	//$rs =  $conn->query($sql);
	//$row = $rs->fetch_array();
	//$result["total"] = $row[0];
	$where = "username = '$username' and pwd = '$pwd'";

	$sql1 = "select count(*),userid from login_table where ".$where ." limit 1";
	//echo $sql1;
	$rs = $conn->query($sql1);
	$row = $rs->fetch_array();
	
    $result["total"] = $row[0];
	$result["userid"] = $row[1];
	
	
	echo json_encode($result);
	//echo json_encode($result["total"]);


	if($result["total"]>0){
		//echo "aaa";
		//header("Location:$url");
	}
	else{
		
		//header("Location:login.html");
		//echo "<script>alert('用户名或密码错误');</script>";
	}

	
 ?>