<?php
header("Content-type:text/html;charset=utf-8");
session_start();
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
	$where = "a.username = '$username' and a.pwd = '$pwd'";

	$sql1 = "select count(*),a.userid,b.role from login_table as a join role_table as b on a.username=b.username and ".$where ." limit 1";
	//echo $sql1;
	$rs = $conn->query($sql1);
	$row = $rs->fetch_array();
	
    $result["total"] = $row[0];
	$result["userid"] = $row[1];
	$result["role"] = $row[2];
	$_SESSION["userid"] = $result["userid"];
	$_SESSION["role"] = $result["role"];
	
	//echo json_encode($_SESSION);
	//echo json_encode($result);
	//echo json_encode($result["total"]);


	if($result["total"]>0){
		echo json_encode($_SESSION);
	}
	else{
		
		//header("Location:login.html");
		//echo "<script>alert('用户名或密码错误');</script>";
	}

	
 ?>