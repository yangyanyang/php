/*jquery*/
$.extend({
   includePath: '',
   include: function(file) {
      var files = typeof file == "string" ? [file]:file;
      for (var i = 0; i < files.length; i++) {
          var name = files[i].replace(/^\s|\s$/g, "");
          var att = name.split('.');
          var ext = att[att.length - 1].toLowerCase();
          var isCSS = ext == "css";
          var tag = isCSS ? "link" : "script";
          var attr = isCSS ? " type='text/css' rel='stylesheet' " : " language='javascript' type='text/javascript' ";
          var link = (isCSS ? "href" : "src") + "='" + $.includePath + name + "'";
          if ($(tag + "[" + link + "]").length == 0) document.write("<" + tag + attr + link + "></" + tag + ">");
      }
 }
});

/** 
 * Forward port jQuery.live()
 * Wrapper for newer jQuery.on()
 * Uses optimized selector context 
 * Only add if live() not already existing.
*/
if (typeof jQuery.fn.live == 'undefined' || !(jQuery.isFunction(jQuery.fn.live))) {
  jQuery.fn.extend({
      live: function (event, callback) {
         if (this.selector) {
              jQuery(document).on(event, this.selector, callback);
          }
      }
  });
};

/*jquery*/
(function($){
    $.fn.selMenu = function(param){
        var html = '<div class="select_menu_box" style="display: none">',func={},initVal = '';
        var title='',defaultItem=[],defaultText='',defaultValue='';
        var menuObj = $(this);
        var iconCls = 'fa fa-check';
        if(param == undefined || typeof param != 'object'){
            //console.error('params is error');
            return $(this);
        }
        for(var i in param){
            if(typeof param[i] ==="function") func[i] = param[i];
        }
        if(param.data && typeof param.data == 'object'){
            var m = 1;
            for(var i in param.data){
                if(param.initValue != undefined){
                    if(param.initValue == i){
                        defaultItem.text = param.data[i];
                        defaultItem.value = i;
                        html += ("<div data-options='value:\""+i+"\",iconCls:\""+iconCls+"\"'>"+param.data[i]+"</div>");
                    }else{
                        html += ("<div data-options='value:\""+i+"\"'>"+param.data[i]+"</div>");
                    }
                }else {
                    if(m==1){
                        defaultItem.text = param.data[i];
                        defaultItem.value = i;
                        html += ("<div data-options='value:\""+i+"\",iconCls:\""+iconCls+"\"'>"+param.data[i]+"</div>");
                    }else{
                        html += ("<div data-options='value:\""+i+"\"'>"+param.data[i]+"</div>");
                    }
                    m++;
                }
            }
        }
        html += ('</div>');
        menuObj.after(html)
        var menutools = menuObj.next('.select_menu_box');
        if(defaultItem){
            defaultText = defaultItem.text;
            defaultValue = defaultItem.value;
        }
        if(param.title != undefined ){
            title = param.title;
        }
        if(defaultText != '' ){
            title += '（'+defaultText+'）';
        }
        menuObj.attr('attr',defaultValue).attr('title',defaultText).menubutton({
            text:title||'请选择',
            menu:menutools,
            iconCls:param.iconCls||'',
        })
        menutools.menu({
            onClick:function(item){
                var menu_text = param.title+'（'+item.text+'）';
                menuObj.attr('attr',item.value).attr('title',item.text).menubutton({text:menu_text});
                menutools.find('.menu-icon').removeClass(iconCls).menu('setIcon',{target: item.target,iconCls: iconCls});
                if(func.onSelectItems != undefined && typeof func.onSelectItems=== 'function'){
                    func.onSelectItems.call(menuObj,item.value, item.text);
                }
            }
        })
    };
})(jQuery);

// JavaScript Document
;(function($){
    $.extend({
        'Abt' : {
            //定义字符串与数字组合
            'Char' : ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9'],

            //随机产生5位数字符串连接码
            'randIDs': function(){
                $("#dialog-box").html();
                var randID = [];
                var Temp = [];
                for(i=0;i<5;i++){
                    Temp = [];
                    for(k=0;k<5;k++){
                        Temp.push($.Abt.Char[Math.floor(Math.random()*61)]);
                    }
                    randID.push(Temp.join(''));
                }
                return randID.join('-');
            },
            'greatDialog': function(callback){
                var id = $.Abt.randIDs();
                $("body").append("<div class='dialog-box' id='"+id+"'></div>");
                if(callback != undefined && typeof callback === 'function'){
                    callback.call(this,$('#'+id));
                    return;
                }
            },
            'dialog': function(obj,param){
                var default_param = {
                    resizable:false,
                    closable: true,
                    modal:true,
                    onClose: function () {
                        $(this).dialog('destroy');//销毁
                    }
                };
                var temp = $.extend(default_param, param);
                obj.dialog(temp)
            },
            'ip2long': function(ip_address){
                var output = false;
                if (ip_address.match(/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/)) {
                    var parts = ip_address.split('.');
                    var output = 0;
                    output = ( parts [0] * Math.pow(256, 3) ) +
                        ( parts [1] * Math.pow(256, 2) ) +
                        ( parts [2] * Math.pow(256, 1) ) +
                        ( parts [3] * Math.pow(256, 0) );
                }
                return output << 0;
            },
        }
        //Abt End
    });
})(jQuery);
