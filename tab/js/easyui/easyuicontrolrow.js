/** 
 * @author wangying
 *  
 * @requires jQuery,EasyUI 
 *  
 * 为datagrid、treegrid增加表头菜单，用于显示或隐藏列，注意：冻结列不在此菜单中 
 */  
var createGridHeaderContextMenu = function(e, field) {
    e.preventDefault();  
    var grid = $(this);/* grid本身 */  
    var headerContextMenu = this.headerContextMenu;/* grid上的列头菜单对象 */ 
   // if (!headerContextMenu) {  
        var tmenu = $('<div style="width:100px;"></div>').appendTo('body');  
        var fields = grid.datagrid('getColumnFields');  
        for ( var i = 0; i < fields.length; i++) {  
            var fildOption = grid.datagrid('getColumnOption', fields[i]);
            if(fildOption.title&&fildOption.field!=field){
                if (!fildOption.hidden) {  
                     $('<div iconCls="icon-selected" field="' + fields[i] + '"/>').html(fildOption.title).appendTo(tmenu);  
                } else {  
                    $('<div iconCls="icon-unselected" field="' + fields[i] + '"/>').html(fildOption.title).appendTo(tmenu);  
                }  
            }    
        }  
        headerContextMenu = tmenu.menu({ 
            hideOnUnhover:false, 
            onClick : function(item) {  
                var field = $(item.target).attr('field');  
                if (item.iconCls == 'icon-selected') {  
                    grid.datagrid('hideColumn', field);  
                    $(this).menu('setIcon', {  
                        target : item.target,  
                        iconCls : 'icon-unselected'  
                    });  
                } else {  
                    grid.datagrid('showColumn', field);  
                    $(this).menu('setIcon', {  
                        target : item.target,  
                        iconCls : 'icon-selected'  
                    });   
                }   
            }  
        });  
    //};  
    headerContextMenu.menu('show', {  
        top: e.pageY,
        left:e.pageX,
        hideOnUnhover:false,
        onHide:function(){$(this).menu('show')},
        inline:true  
    });  
};  
$.fn.datagrid.defaults.onCheckRowMenu = createGridHeaderContextMenu;  
$.fn.treegrid.defaults.onCheckRowMenu = createGridHeaderContextMenu; 