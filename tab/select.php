<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>出勤记录</title>
		<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="js/easyui/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="js/easyui/themes/icon.css">	
		<script type="text/javascript" src="js/easyui/jquery.easyui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../nav/nav.css">
	</head>
	<body>
		<?php 
		  //$userid= $_GET['userid'];
		  session_start(); //开启session   
		  if(empty($_SESSION["userid"]))
		  {
		  	header("location:../nav/login.html"); //空的话就返回登录页面
		  }
		  else{
		  	//echo json_encode($_SESSION["userid"]);
		  	$userid = $_SESSION["userid"];
		  	$role = $_SESSION["role"];
		  }
		  
		?>
		<!-- <div class="userPlaceMain">
			<ul class="nav">
			    <li>
			    	<a  id="userPlaceId_1" href="javascript:;" onclick="javascript:window.location='../nav/demo11.php?userid= <?php echo $_GET['userid'];?>'" >首页</a>
			    </li>
			    <li>
			    	<a id="userPlaceId_2" href="javascript:;" onclick="javascript:window.location='demo1.html'" >形象展示</a>
			    </li>
			    <li>
			    	<a  class="active" id="userPlaceId_3" href="javascript:;" >出勤</a>
			    	<ol>
						<li><a href="../tab/select.php?userid= <?php echo $_GET['userid'];?>">出勤记录</a></li>
						<li><a href="../tab/daka_image.php?userid= <?php echo $_GET['userid'];?>">补打卡</a></li>
						<li><a href="#">请假</a></li>
						<li><a href="#">未知区域</a></li>

					</ol>
			    </li>
			</ul>
		</div> -->
		<div class="userPlaceMain">
			<ul class="nav">
			    <li>
			    	<a  id="userPlaceId_1" href="javascript:;" onclick="javascript:window.location='../nav/demo11.php'" >首页</a>
			    </li>
			    <li>
			    	<a id="userPlaceId_2" href="javascript:;" onclick="javascript:window.location='../nav/demo11.php'" >形象展示</a>
			    </li>
			    <li>
			    	<a  class="active" id="userPlaceId_3" href="javascript:;" >出勤</a>
			    	<ol>
						<li><a href="../tab/select.php">出勤记录</a></li>
						<li><a href="../tab/daka_image.php">补打卡</a></li>
						<li><a href="#">请假</a></li>
						<li><a href="#">未知区域</a></li>

					</ol>
			    </li>
			    <li style="float: right;margin:0px 30px 0 0">
			    	<a id="logout" onclick="logoutfunction()">
			    		<img src="../images/logout.ico" alt="注销" style="width: 30px;height: 30px;margin-top: 0px;position: relative; top: 8px;">
			    	</a>		    	
		    	</li>
			</ul>
		</div>
		<div style="margin:24px 24px 8px 0;">
			<div id="chaxun" style="height:32px">
				<table id="chaxuntab" class="table" style="margin-bottom: 0px ">
					<tr id="user_scope1">
			            
						<td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;">开始时间：</td>
	                    <td >
	                        <span>
	                        	<input class="easyui-datetimebox" id="user_time1" name="user_time1" data-options="required:true, formatter:formatter,parser:parser " style="width:150px">
	                            <span class="defined_error"></span>
	                        </span>
	                    </td>
	                    <td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;">结束时间：</td>
	                    <td >
	                        <span>
	                        	<input class="easyui-datetimebox" id="user_time2" name="user_time2" data-options="required:true, formatter:formatter,parser:parser " style="width:150px">
	                            <span class="defined_error"></span>
	                        </span>
	                    </td>

	                    <td id="tablename1" class="label_1" style="padding-right: 8px;">姓名</td>
						<td id="tablename2" class="css_content">
			                <span class="select_margin">
							    <!--<select name="recog_scope_name" id="user_id" class="select long" style="width:200px;">
								    <option value="1">zhouruihong</option>
									<option value="2">houxiaochao</option>
									<option value="10">yangyanyang</option>
							    </select>-->
							    <input id="cc" style="width:100px" >
			                    <!-- <label type="text" name="userid" id="userid" class="input" style="display: none;"><?php echo $_GET['userid'];?></label> -->
			                    <label type="text" name="userid" id="userid" class="input" style="display: none;"><?php echo $userid;?></label>
			                    <label type="text" name="role" id="role" class="input" style="display: none;"><?php echo $role;?></label>

							</span>
							<!--<span>Item ID:</span>
				               <input id="user_id" style="line-height:26px;border:1px solid #ccc"> -->

						</td>
		                    	
	                    </div>
						<td style="position: absolute;right: 16px; ">
							<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">查询</a>
						</td>
			        </tr>
			    </table>
			</div>
			
	        <div style="width: 1024px;margin:0 0 0 8px ">
				<table class="easyui-datagrid" id="control_assets_tab" style="width:700px;height:480px">
				</table>
			</div>

		</div>

		<script type="text/javascript">
			// $('#control_assets_tab').datagrid(
			// 			'load',{user_id: '1'
			// });
			$('#control_assets_tab').datagrid({
		        url: "checkinout.php",        
		        columns: [[
		        	
		            {
		                field: 'USERID',
		                title: 'ID',
		                width: '5%'
		             
		            },{
		                field: 'Name',
		                title: '姓名',
		                width: '30%'
		             
		            },
		            {
		                field: 'first',
		                title: '上班时间',
		                width: '30%'
		             
		            }, {
		                field: 'end',
		                title: '下班时间',
		                width: '30%'
		            }
		        
			    ]],

			    border: true,
			    rownumbers: true,
			    pagination: true,
			    pageSize: 15,
			    pageList: [15, 20],
			    striped: true,
			    toolbar: '#chaxun',
			    onLoadSuccess:load_time
			});
			
			//alert($('#user_name').html().trim());
			//var etime = new Date();
			var etime = new Date();
			var year = etime.getFullYear();
			var month = etime.getMonth()+1;
			var firstDay = year + "-" + month + "-" + "01" + " 06:00:00";

			console.log(firstDay);
			//console.log(formatter(firstDay));
		   
			$('#control_assets_tab').datagrid(
		                'load',{
		                    userid: $('#userid').html().trim(),
		                    first:firstDay,
		                    end:formatter(etime)
		            });
			function doSearch(){
					$('#control_assets_tab').datagrid(
						'load',{
							userid: $('#cc').combobox('getValue'),
							//user_name: $('#cc').combobox('getText'),
							first:$('#user_time1').datetimebox('getValue'),
							end:$('#user_time2').datetimebox('getValue')
					});
			}

			var role = $('#role').html().trim();
			// console.log(role);
			//alert("role"+role);

			if(role=="admin"){
				//alert("admin"+role);
				$('#cc').combobox({
					url:"selecid.php",
				    valueField:"USERID",
				    textField:"Name",
				    //readonly:"false",
				    prompt: '请选择姓名',
					formatter:function(row){
						//var imageFile = 'images/' + row.icon;
						return '<span class="item-text">'+row.Name+'</span>';
					},
					
				});				
			}			
			else{
				//alert("user"+role);
				$('#cc').combobox({
					url:"selecid.php",
				    valueField:"USERID",
				    textField:"Name",
				    prompt: '请选择姓名',
				    readonly:'true',
					formatter:function(row){
						//var imageFile = 'images/' + row.icon;
						return '<span class="item-text">'+row.user_name+'</span>';
					},
				});				
							
			 }

			
				
				$('#cc').combobox({        
		        loadFilter:function(data){            
					var obj={};
			       	obj.USERID='';
			      	obj.Name='-请选择-'
			       	data.splice(0,0,obj);
			       	//在数组0位置插入obj,不删除原来的元素
			       	//console.log('数组：',data); 
			       	//console.log('initPieMenace data:',JSON.stringify(data));
			       	return data; 
		         } 
		    });
		    function load_time(){
		    	var etime = new Date();
		    	var year = etime.getFullYear();
		    	var month = etime.getMonth()+1;
		    	var firstDay = month + "/" + "01/" + year;
				//console.log(etime);
				//$('#user_time1').datetimebox('setValue', firstDay+" 06:00:00");
				//console.log(firstDay+" 06:00:00");
				//$('#user_time2').datetimebox('setValue', etime);

				//$('#cc').combobox('setValue',$('#userid').html().trim());
		    }
		    $(function(){
		    	var role = $('#role').html().trim();
		    	var userid = $('#userid').html().trim();
				var etime = new Date();
		    	var year = etime.getFullYear();
		    	var month = etime.getMonth()+1;
		    	var firstDay = month + "/" + "01/" + year;
				$('#user_time1').datetimebox('setValue', firstDay+" 06:00:00");
				$('#user_time2').datetimebox('setValue', etime);
				$('#cc').combobox('setValue',$('#userid').html().trim());
				if(role == "user"){
					$('#tablename1').css('display','none');
					$('#tablename2').css('display','none');
				}
				else if(userid == "27"){
					$('#cc').combobox('setValue',"");
				}


		    });

			function formatter(date){
				//console.log(date);
		        var year = date.getFullYear();
		        var month = date.getMonth() + 1;
		        var day = date.getDate();
		        var hour = date.getHours();
		        month = month < 10 ? '0' + month : month;
		        day = day < 10 ? '0' + day : day;
		        hour = hour < 10 ? '0' + hour : hour;
		        var minutes=date.getMinutes()>9?date.getMinutes() :"0"+date.getMinutes();
				var seconds=date.getSeconds()>9?date.getSeconds() :"0"+date.getSeconds();
		        return year + "-" + month + "-" + day + " " + hour +":" + minutes + ":" + seconds;
		    }

			function parser(s){
			    var t = Date.parse(s);
			    if (!isNaN(t)){
			        return new Date(t);
			    } else {
			        return new Date();
		   	 	}
			}

			
				
		</script>
	</body>
</html>