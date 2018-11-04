<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>demo1</title>
	<script src="echarts.js"></script>
	<script src="jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="nav.css">
	

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
		    	<a  id="userPlaceId_1" href="javascript:;" onclick="javascript:window.location='demo11.php'" >首页</a>
		    </li>
		    <li>
		    	<a id="userPlaceId_2" href="javascript:;" onclick="javascript:window.location='demo11.php'" >形象展示</a>
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
		    <li style="float: right;margin:8px 30px 0 0">
		    	<button id="logout" onclick="logoutfunction()">
		    		<img src="../images/logout.png" alt="注销" style="width: 30px;height: 30px">
		    	</button>
		    	
		    </li>
		</ul>
	</div>
	<div class="content">
		<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
		<div>
			<h1>考勤相关</h1>
		</div>
	    <div id="main" style="width: 600px;height:400px;float: left"></div>
	    <div id="container" style=" width:600px;height:400px;float: left"></div>
	</div>
	    

	<script type="text/javascript">
		function logoutfunction(){
			window.location.href = "../nav/login.html";
		}
        // 基于准备好的dom，初始化echarts实例
        //var data="";
        //var JsonObjs1 = "";
	    $.ajax({
	        type: "get",
	        url: "demo1.php",
	        success: function (data)
	        {
	        	//JsonObjs1 = $.parseJSON(data)
	        	//console.log(JsonObjs1);
	           //for in遍历php返回的json数据
	            // for(var k in data)
	            // {
	            //     //data = data;
	            //     data[k] = data[k];
	            //      console.log(data[k]);

	            // }
	            drawbar(data);

	        },
	        error:function () {
	            alert("1111");
	        }
	    });
	    //console.log(data);

	    function drawbar(data){
	    	var myChart = echarts.init(document.getElementById('main'));

    // // 指定图表的配置项和数据
		    var option = {
		    	color:['#003366', '#006699', '#4cabce', '#e5323e'],
		        title: {
		            text: '考勤汇总'
		        },
		        tooltip: {},
		        legend: {
		            data:data.legend
		        },
		        xAxis: {
		            data: data.xAxis_data,
		            axisLabel:{
		            	interval:0
		            }
		        },
		        yAxis: {},
		        series: data.series
		    };

		    // 使用刚指定的配置项和数据显示图表。
		    myChart.setOption(option);

	    }

	    var dom = document.getElementById("container");
		var myChart = echarts.init(dom);
		var app = {};
		option = null;
		option = {
		    title : {
		        text: '某站点用户访问来源',
		        subtext: '纯属虚构',
		        x:'center'
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        left: 'left',
		        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
		    },
		    series : [
		        {
		            name: '访问来源',
		            type: 'pie',
		            radius : '55%',
		            center: ['50%', '60%'],
		            data:[
		                {value:335, name:'直接访问'},
		                {value:310, name:'邮件营销'},
		                {value:234, name:'联盟广告'},
		                {value:135, name:'视频广告'},
		                {value:1548, name:'搜索引擎'}
		            ],
		            itemStyle: {
		                emphasis: {
		                    shadowBlur: 10,
		                    shadowOffsetX: 0,
		                    shadowColor: 'rgba(0, 0, 0, 0.5)'
		                }
		            }
		        }
		    ]
		};
		;
		if (option && typeof option === "object") {
		    myChart.setOption(option, true);
		}

        
    </script>

</body>
</html>