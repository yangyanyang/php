<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>请假申请</title>
	<script src="../nav/echarts.js"></script>	
	<link rel="stylesheet" type="text/css" href="../nav/nav.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script src="../nav/jquery-3.3.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
	  //$userid= $_GET['userid'];
	  session_start(); //开启session   
	  if(empty($_SESSION["userid"]))  //判断session是否为空
	  {
		  	header("location:../nav/login.html"); //空的话就返回登录页面
	  }
	  else{
	  	//echo json_encode($_SESSION["userid"]);
	  	$userid = $_SESSION["userid"];
	  	$role = $_SESSION["role"];
	  }
	  
	?>
	
	<div class="userPlaceMain">
		<ul class="nav">
		    <li>
		    	<a  id="userPlaceId_1" href="javascript:;" onclick="javascript:window.location='../nav/demo11.php'" >首页</a>
		    </li>
		    <li>
		    	<a id="userPlaceId_2" href="javascript:;" onclick="javascript:window.location='../nav/demo11.php'" >形象展示</a>
		    </li>
		    <li>
		    	<a  id="userPlaceId_3" href="javascript:;" >出勤</a>
		    	<ol>
					<!-- <li><a href="../tab/select.php?userid= <?php echo $_GET['userid'];?>">出勤记录</a></li>
					<li><a href="../tab/daka_image.php?userid= <?php echo $_GET['userid'];?>">补打卡</a></li> -->
					<li><a href="../tab/select.php">出勤记录</a></li>
					<li><a href="../tab/daka_image.php">补打卡</a></li>
					<li><a href="#">请假</a></li>
					<li><a href="#">未知区域</a></li>

				</ol>
		    </li>
		    <li style="float: right !important;margin:0px 30px 0 0">
		    	<a id="logout" onclick="logoutfunction()">
		    		<img src="../images/logout.ico" alt="注销" style="width: 30px;height: 30px;margin-top: 0px;">
		    	</a>		    	
		    </li>
		</ul>
	</div>
	<div >
		
	</div>
	<div class="leavemain" style="margin-top: 40px;margin-left: 32px">
		<div class='leavecontent'>
			<form class="form-horizontal" role="form" action="leave_submit.php" method="post">
				<div class="form-group">
					<label for="firstname" class="col-sm-1 control-label">姓名</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="firstname" 
							   placeholder="请输入姓名">
					</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-sm-1 control-label">请假理由</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="lastname" 
							   placeholder="请输入请假理由">
					</div>
				</div>
				<div class="form-group">					
					<label for="lastname" class="col-sm-1 control-label">开始时间：</label>
					<span class="col-sm-2">
                    	<input class="easyui-datetimebox form-control" id="user_time1" name="user_time1" data-options="required:true, formatter:formatter,parser:parser " style="width:150px">                        
	                </span>
	                <label for="lastname" class="col-sm-1 control-label">开始时间：</label>
	                <span class="col-sm-2">
                    	<input class="easyui-datetimebox form-control" id="user_time2" name="user_time2" data-options="required:true, formatter:formatter,parser:parser " style="width:150px">
                    </span>	                
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-3">
						<div class="checkbox">
							<label>
								<input type="checkbox"> 请记住我
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-sm-1 control-label">请假原因</label>
					<div class="col-sm-2">
						<label class="radio-inline">
						       <input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="option1" checked> 事假
					    </label>
					    <label class="radio-inline">
					       <input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="option2"> 年假
					    </label>
					    <label class="radio-inline">
					       <input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="option2"> 病假
					    </label>
					    <label class="radio-inline">
					       <input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="option2"> 调休
					    </label>
					</div>
										
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-3">
						<button type="submit" class="btn btn-default">登录</button>
					</div>
				</div>
			</form>

			<!-- <form action="leave_submit" method="get" >
				<table style="margin: 24px">
					
					<tbody>
						
						<tr>
							<td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;padding-bottom: 8px;">
								<label>类型</label>
							</td>
							<td style="padding-bottom: 8px;">
								<label><input name="Fruit" type="radio" value="1" />事假 </label>
								<label><input name="Fruit" type="radio" value="2" />年假 </label> 
								<label><input name="Fruit" type="radio" value="3" />调休 </label>  
							</td>
						</tr>
						<tr>
							<td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;padding-bottom: 8px;">
								<label>原因</label>
								
							</td>
							<td style="padding-bottom: 8px;">
								<label><input type="text" name="yuanyin" value=""></label>
							</td>
						</tr>
					</tbody>
				</table>
			</form> -->
			
			
		</div>
		
	</div>

</body>
</html>