<?php
    header("Content-type:text/html;charset=utf-8");

    $json = array('error' => '', 'error_code' => '', 'msg' => '');
    // $msg         = '';
    $result = array();
    $error       = '';
    $error_code  = '';
    $user_id     = '';
    $path        = 'upload/';
    $input_name  = $_REQUEST['input_name'];
    $user_name        = $_REQUEST['user_name'];
    $user_time = $_REQUEST['user_time'];
    $upload_url = '';
    if ($_FILES[$input_name]["error"] > 0) {
        $error_code = '1';
        $error      = $_FILES[$input_name]["error"];
    } else {
        $fileSize = 4096 * 4096 * 2;
        if ($_FILES[$input_name]['size'] <= $fileSize) {
            if ($_FILES[$input_name]['name'] <= 255) {
                $temp      = explode(".", $_FILES[$input_name]["name"]);
                $extension = strtolower(end($temp)); // 获取文件后缀名
                if (($extension == 'jpg' || $extension == 'png' )&& sizeof($temp) > 1) {
                    $newFile = time() . '_' . $_FILES[$input_name]["name"];
                    if (file_exists($newFile)) {
                        $error_code = '2'; //文件已经存在
                    } else {
                    	$upload_url = $path . $newFile;
                        move_uploaded_file($_FILES[$input_name]["tmp_name"], $upload_url);

                        $result["file_name"] = $newFile;
				        $result["user_name"] = $user_name;
				        $result["user_time"] = $user_time;
				        $result["file_path"] = $upload_url;
                    }

                } else {
                    $error_code = '3';
                }
            } else {
                $error_code = '5';
            }
        } else {
            $error_code = '4';
        }
    }
    if (!empty($error_code)) {
        $json = array('error' => $error, 'error_code' => $error_code, 'msg' => '');
    }
    //$json['aaa']=$_FILES;
    echo json_encode($json);
    //echo json_encode($result);
    $servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "mytest";

	// 创建连接
	$conn = new mysqli($servername, $username, $password, $dbname);

	// 检测连接
	if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    // 预处理及绑定
    $where = "user_name = '$user_name'";

	//echo "之后 : ".$user_name .$where;
	$sql = "select user_id from testdaka where " . $where ."limit 1";
	$rs =  $conn->query($sql);
	$row = $rs->fetch_array();
	$user_id = $row[0];
	//echo "user id " .$user_id;
	$stmt = $conn->prepare("INSERT INTO testbudaka (user_id,user_name, user_time, image_url) VALUES (?, ?, ?,?)");
	$stmt->bind_param("isss",$user_id,$user_name, $user_time, $upload_url);
	$stmt->execute();
	//echo "新记录插入成功";
    $stmt = $conn->prepare("INSERT INTO testdaka (user_id,user_name, user_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss",$user_id,$user_name, $user_time);
    $stmt->execute();
    //echo "新记录插入成功";

	$stmt->close();
	$conn->close();


?>
