(function() {
	function isPlaceholder() {
		var input = document.createElement('input');
		return 'placeholder' in input;
	}
	if (!isPlaceholder()) { //不支持placeholder 用jquery来完成
		$(document).ready(function() {
			if (!isPlaceholder()) {
				$("input").not("input[type='password']").each( //把input绑定事件 排除password框
						function() {
					if ($(this).val() == "" && $(this).attr("placeholder") != "") {
						$(this).val($(this).attr("placeholder"));
						$(this).focus(function() {
							if ($(this).val() == $(this).attr("placeholder"))
								$(this).val("");
							}
						);
						$(this).blur(function() {
							if ($(this).val() == "")
								$(this).val($(this).attr("placeholder"));
							}
						);
					}
				});
				//对password框的特殊处理1.创建一个text框 2获取焦点和失去焦点的时候切换
				$("input[type='password']").each(function() {
					var pwdField = $(this);
					var pwdVal = pwdField.attr('placeholder');
					pwdField.after('<input type="text" name="password" value=' + pwdVal + ' autocomplete="off" />');
					var pwdPlaceholder = $(this).siblings('.login-input');
					pwdPlaceholder.show();
					pwdField.hide();

					pwdPlaceholder.focus(function() {
						pwdPlaceholder.hide();
						pwdField.show();
						pwdField.focus();
					});

					pwdField.blur(function() {
						if (pwdField.val() == '') {
							pwdPlaceholder.show();
							pwdField.hide();
						}
					});
				})
			}
		});
	}
	//    end
})();
