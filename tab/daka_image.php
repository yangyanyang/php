<!DOCTYPE html>
<html>
<head>
	<title>补打卡</title>
	<meta charset="utf-8">
	<script src="dist/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="js/jquery.extend.js" type="text/javascript"></script>
    <script src="js/template.min.js" type="text/javascript"></script>
	<!-- <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script> -->
	<link rel="stylesheet" href="js/ajaxfileupload.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="js/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="js/easyui/themes/icon.css">    
    <script type="text/javascript" src="js/easyui/jquery.easyui.min.js"></script>
    <link rel="stylesheet" href="js/buttons.css">
    <!-- <script src="dist/jquery-3.3.1.min.js"></script> -->    
    <link rel="stylesheet" href="dist/magnific-popup.css">    
    <script src="dist/jquery.magnific-popup.js"></script>
	<script src="js/ajaxfileupload.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../nav/nav.css">
	
	<style type="text/css" media="screen">
		.icon_del {
            background: url(../images/icon_del.gif) left top no-repeat;
        }

	    .icon_add {
            background: url(../images/edit_add.png) left top no-repeat;
        }
        .mfp-no-margins img.mfp-img {
            padding: 0;
        }
        /* position of shadow behind the image */
        .mfp-no-margins .mfp-figure:after {
            top: 0;
            bottom: 0;
        }
        /* padding for main container */
        .mfp-no-margins .mfp-container {
            padding: 0;
        }
    </style>

</head>
<body>
    <?php 
      //$userid= $_GET['userid'];
      session_start(); //开启session   
      if(empty($_SESSION["userid"]))  //判断session是否为空
      {
      　　header("location:login.html"); //空的话就返回登录页面
      }
      else{
        //echo json_encode($_SESSION["userid"]);
        $userid = $_SESSION["userid"];
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
                <a  id="userPlaceId_3" href="javascript:;" >出勤</a>
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
        </ul>
    </div>
	<div id="win_box" style="display:none;">
	    <div id="update_file_win" class="easyui-window" title="补打卡申请" data-options="modal:true,closed:true,iconCls:'icon-save',minimizable:false,maximizable:false,collapsible:false
" style="width:600px;height:400px;overflow:hidden;">
            <div class="easyui-layout" data-options="fit:true">
                <div data-options="region:'center',border:false">
                    <form action="" method="post"> <!--  enctype="multipart/form-data" -->
                    <div class="css_config" style="padding:10px;">
                    <table style="margin: 0 auto;">
                        <tr>
                            <td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;">姓名：</td>
                            <td >
                                <span >
                                    <label type="text" name="user_name" id="user_name" class="input" ></label>
                                    <label type="text" name="userid" id="userid" class="input" style="display: none;" ><?php echo $_SESSION['userid'];?></label>
                                        <br>
                                    <span class="defined_error"></span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;">忘打卡时间：</td>
                            <td >
                                <span>
                                	<input class="easyui-datetimebox" id="user_time" name="user_time" data-options="required:true, formatter:formatter,parser:parser " style="width:150px">
                                    <span class="defined_error"></span>
                                </span>
                            </td>

                        </tr>
                        <tr id="inputCB1" >
							<td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;">
								<label> 工作截图： </label></td>
							<td>
								<input multiple style="width:300px" id="fileputHB" name="fileputHB" class="easyui-filebox" data-options=" accept:'.jpg,.bmp,.gif,.png',prompt:'.jpg,.bmp,.gif,.png',buttonText:'请选择图片',onChange:change_photo">
							</td>
						</tr>
						<tr id="inputCB4" >
							<td style="width: 80px; margin-right: 2px;padding-right: 2px;text-align:right;"><label>图片预览：</label></td>
							<td> <div id="Imgdiv"><img src="./upload/a.png" id="Img" width="200px" height="200px"/></div></td>
						</tr>
                    </table>
                    </div>
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $_SESSION['userid'];?>">
                    </form>
                </div>
                <div data-options="region:'south',border:false" style="height:40px;text-align:right;padding:5px;border-top:1px solid #CCC;">

                    <a class="easyui-linkbutton" data-options="iconCls:'icon-ok'" href="javascript:;" onclick="javascript:return update_submit();">确定</a>
                    <a class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" href="javascript:;" onclick="javascript:return update_cancel();">取消</a>
                </div>
            </div>
        </div>
        <div id="img_win" style="width:400px;height:400px;overflow:hidden;">
        	<img id="img_id" src="../images/open_eye.png"  onerror="javascript:this.src='upload/a.png';"alt="补打卡截图" title="预览" >

        </div>
    </div>
	<div style="margin:24px 8px 8px 0;">
		<div style="width: 1024px;margin:0 0 0 8px">
            <table id="detail_budaka" class="easyui-datagrid" style="width:700px;height:480px">
            </table>
        </div>

	</div>

    <script type="text/javascript">
    	var resetID = '',resetName = '',resetDesc = '';
        var annc_toolbar = [
            {
                id: 'btn_add',
                text: '补打卡申请',
                iconCls: 'icon-add',
                handler: but_upload_handle
            },
            {
                id: 'btn_del',
                text: '删除',
                iconCls: 'icon-remove',
                handler: but_del_handle
            }
        ];
        $('#detail_budaka').datagrid({
            columns: [[
                {
                    field: 'ck',
                    checkbox: true
                },
                {
                    field: 'user_id',
                    title: 'ID',
                    width: '5%',
                    hidden:true
                },
                {
                    field: 'username',
                    title: '姓名',
                    width: '30%'
                },
                {
                    field: 'user_time',
                    title: '时间',
                    width: '30%'
                },

                {
                    field: 'image_url',
                    title: '工作截图',
                    align: 'center',
                    //fixed: true,
                    width: '20%',
                    formatter: format_preview1
                },
                {
                    field: 'uid',
                    title: 'uid',
                    // hidden:true,
                    width: "5%"
                },
            ]],
            //pageNumber:1,
            url:'budaka.php',
            pageList: [15, 20],
            //fit:true,
            border: true,
            //fitColumns:true,
            striped:true,
            rownumbers: true,
            pagination: true,
            pageSize: 15,
            toolbar: annc_toolbar,

        });
        $('#detail_budaka').datagrid({
            onLoadSuccess: function(data){
                //var data1 = JSON.parse(data);
                console.log(data["group"]["0"]["username"]);
                $('#user_name').html(data["group"]["0"]["username"]);
                $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }        
                });
            }
        });
        $('#detail_budaka').datagrid(
                    'load',{
                        user_id: $('#userid').html().trim()
                });

        //刷新
        // $('#detail_budaka').datagrid('appendRow',{
        //     user_id: '$result[user_id]',
        //     user_name: '$result[user_id]',
        //     user_time: '$result[user_time]',
        //     image_url:'$result[file_path]'
        // });

        function format_preview(value,data){
        	return '<button class="button button-large button-plain button-borderless" id="but_img" name="but_img" onclick="imgDisplay(\''+data.image_url+'\')"><img src="../images/open_eye.png" alt="预览" title="预览"></button>';
        // jumpToPC(1);
       }
       function format_preview1(value,data){
            return '<a class="image-popup-vertical-fit" href="'+data.image_url+'"><img src="../images/1.ico" alt="预览" title="预览" style="width:20px;height:20px"></a>';
        // jumpToPC(1);
       }
        function but_upload_handle(){
        	//update_reset();
        	$('#update_file_win').window('center');
            $('#update_file_win').window('open');

        }
        function but_del_handle(){
            var deletedData = $('#detail_budaka').datagrid('getChecked');
            function writeObj(obj){ 
                     var description = "aaa"; 
                     for(var i in obj){ 
                     var property=obj[i]; 
                     description+=i+" = "+property+"\n"; 
                     } 
                     alert(description); 
            }
            //var a = JSON.parse(deletedData);
            //writeObj(deletedData);
            //alert(JSON.stringify(deletedData));
            if(deletedData == ""){
                alert("请选择数据");
            }
            
            for (var i = deletedData.length - 1; i >= 0; i--) {
                //var jsondel = JSON.stringify(deletedData[i]);
                alert(deletedData[i]["uid"]);
                var rowIndex = $('#detail_budaka').datagrid('getRowIndex', deletedData[i]);
                var uid = deletedData[i]["uid"];
                $('#detail_budaka').datagrid('deleteRow', rowIndex);
                $.get("delete.php", {
                    mode:'DEL',
                    row: rowIndex,
                    uid:uid
                });
                
            }

        }
        function fileboxChange(){
            $('#fileputHB_error').text('');
        }
        function change_photo(){
            PreviewImage($("input[name='fileputHB']")[0], 'Img', 'Imgdiv');
        }
        function PreviewImage(fileObj,imgPreviewId,divPreviewId){
    	    var allowExtention=".jpg,.bmp,.gif,.png";//允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
    	    var extention=fileObj.value.substring(fileObj.value.lastIndexOf(".")+1).toLowerCase();
    	    var browserVersion= window.navigator.userAgent.toUpperCase();
    	    if(allowExtention.indexOf(extention)>-1){
    	        if(fileObj.files){//HTML5实现预览，兼容chrome、火狐7+等
    	            if(window.FileReader){
    	                var reader = new FileReader();
    	                reader.onload = function(e){
    	                    document.getElementById(imgPreviewId).setAttribute("src",e.target.result);
    	                }
    	                reader.readAsDataURL(fileObj.files[0]);
    	            }else if(browserVersion.indexOf("SAFARI")>-1){
    	                alert("不支持Safari6.0以下浏览器的图片预览!");
    	            }
    	        }else if (browserVersion.indexOf("MSIE")>-1){
    	            if(browserVersion.indexOf("MSIE 6")>-1){//ie6
    	                document.getElementById(imgPreviewId).setAttribute("src",fileObj.value);
    	            }else{//ie[7-9]
    	                fileObj.select();
    	                if(browserVersion.indexOf("MSIE 9")>-1)
    	                    fileObj.blur();//不加上document.selection.createRange().text在ie9会拒绝访问
    	                var newPreview =document.getElementById(divPreviewId+"New");
    	                if(newPreview==null){
    	                    newPreview =document.createElement("div");
    	                    newPreview.setAttribute("id",divPreviewId+"New");
    	                    newPreview.style.width = document.getElementById(imgPreviewId).width+"px";
    	                    newPreview.style.height = document.getElementById(imgPreviewId).height+"px";
    	                    newPreview.style.border="solid 1px #d2e2e2";
    	                }
    	                newPreview.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
    	                var tempDivPreview=document.getElementById(divPreviewId);
    	                tempDivPreview.parentNode.insertBefore(newPreview,tempDivPreview);
    	                tempDivPreview.style.display="none";
    	            }
    	        }else if(browserVersion.indexOf("FIREFOX")>-1){//firefox
    	            var firefoxVersion= parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
    	            if(firefoxVersion<7){//firefox7以下版本
    	                document.getElementById(imgPreviewId).setAttribute("src",fileObj.files[0].getAsDataURL());
    	            }else{//firefox7.0+
    	                document.getElementById(imgPreviewId).setAttribute("src",window.URL.createObjectURL(fileObj.files[0]));
    	            }
    	        }else{
    	            document.getElementById(imgPreviewId).setAttribute("src",fileObj.value);
    	        }
    	    }else{
    	        alert("仅支持"+allowExtention+"为后缀名的文件!");
    	        fileObj.value="";//清空选中文件
    	        if(browserVersion.indexOf("MSIE")>-1){
    	            fileObj.select();
    	            document.selection.clear();
    	        }
    	        fileObj.outerHTML=fileObj.outerHTML;
    	    }
    	}

    	function update_submit(){
    	    var id = $('#update_id').val();
    	   	var user_name = $('#user_name').html().trim();
    	    var user_time = $('#user_time').datetimebox('getText');
    	    var fileElementId = $('#fileputHB+span').find('input').eq(1).attr('id');
            console.log(id,user_name,user_time,fileElementId);
    	    // $('#update_load_win').window('open');
    	    $.ajaxFileUpload({
    	        url: 'upload.php',
    	        type :'post',
    	        secureuri: false,
    	        fileElementId: fileElementId,//'filebox_file_id_1',
    	        dataType: 'json',
    	        data: {
    	            input_name:'fileputHB',
    	            id: id,
    	            user_name: user_name,
    	            user_time: user_time
    	        },
    	        success: function (data, status) {
    	            console.log('update_submit data:'+JSON.stringify(data));

    	            //$(".easyui-filebox").filebox('clear');
    	            $('#update_file_win').window('close');
    	            update_reset();
                    $('#detail_budaka').datagrid('load',{
                        user_id: $('#userid').html().trim()
                    });
    	            //document.getElementById(Img).setAttribute("src","");
    	            //document.getElementById(fileputHB).setAttribute("value","");
    	            return false;
    	        },
    	        error: function (data, status, e){
    	        	console.log('update_submit error data:'+JSON.stringify(data));
    	        }
            });
        }

        function update_reset(){
            $('#user_name').val(resetName);
            $('#user_time').val(resetDesc);
            $('#Img').attr("src", "./upload/a.png");
            $('#fileputHB').filebox({
                accept:'.jpg,.bmp,.gif,.png',
                prompt:'.jpg,.bmp,.gif,.png',
                buttonText:'请选择图片'
            });
        }

        function update_cancel(){
            $('#user_name').val('');
            $('#user_time').val('');
             $('#Img').attr("src", './upload/a.png');
            $('#fileputHB').filebox({
                accept:'.jpg,.bmp,.gif,.png',
                prompt:'.jpg,.bmp,.gif,.png',
                buttonText:'请选择图片'
            });
            $('#update_file_win').window('close');
        }

        $(function(){
        	var etime = new Date();
        	//console.log(etime);
        	$('#user_time').datetimebox('setValue', formatter(etime));
            // $('.image-popup-vertical-fit').magnificPopup({
            //     type: 'image',
            //     closeOnContentClick: true,
            //     mainClass: 'mfp-img-mobile',
            //     image: {
            //         verticalFit: true
            //     }        
            // });

            });


        function formatter(date){
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var hour = date.getHours();
                month = month < 10 ? '0' + month : month;
                day = day < 10 ? '0' + day : day;
                hour = hour < 10 ? '0' + hour : hour;
                var minutes=date.getMinutes()>9?date.getMinutes() :"0"+date.getMinutes();
        		var seconds=date.getSeconds()>9?date.getMinutes() :"0"+date.getMinutes();
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
        function imgDisplay(url){
        	$('#img_win').window('center');
        	$('#img_win').window('open');
        	$('#img_id').attr("src", url);
        }
        // function load_data_success(){
        //     $('.image-popup-vertical-fit').magnificPopup({
        //         type: 'image',
        //         closeOnContentClick: true,
        //         mainClass: 'mfp-img-mobile',
        //         image: {
        //             verticalFit: true
        //         }        
        //     });

        // }
    </script>
</body>

</html>