jQuery EasyUi Plugin   
============
Upgrade to verson :  1.5.1


Introduction of upgrade reasons (原因简介)
============
* The data format of the device's XML is different from the format required by the general EasyUi-1.5.1 version,avoid data interaction that affects speed, so modify the easyUI data format appropriately;Requirements for equipment development,make appropriate modifications or additions to the appropriate components.
(设备后台XML所传输的数据格式与通用EasyUi-1.5.1版本所要求的格式有所差异，避免数据交互时来回转化，影响速度，故适当的修改easyui的数据格式;配合设备开发的需求，对相应的组件作适当的修改或新增)

Content modification(修改)
============
* Global data format adjustment："data.rows" modify to "data.group";"data.total" modify to "data.page.total";
##Usage : {"group":[],"page":{"total":"","count":"","current":""}}
(全局数据格式调整：data.rows格式统一改成 data.group;data.total 统一修改为 data.page.total  ##使用：{"group":[],"page":{"total":"","count":"","current":""}})

* Comment off logic:When the total number is 0, the paging parameter "pageNumber" is initialized to 0  
## comment out the code：1197-1202(rows)
(注释逻辑：数据总数为0,分页参数“pageNumber”被初始化置0 ##注释位置：1197-1202)

* Data format modification of Tree component: "node.text" modify to "node.name".
(Tree组件数据格式修改: "node.text" 统一修改为 "node.name")

* Changes to the animate property of the Treegrid component:default not open and screen the settings for "autoSizeColumn".
(Treegrid组件"animate"属性的修改:默认不开启,并屏蔽"autoSizeColumn"的设置)

* Adding changetip events to the Tab component:Display the list statistics at tab and dynamically update background color based on list data.
##Usage :$('#test').tabs('changetip',['titlename',num,'color']);
(Tab组件新增changetip事件:在tab处显示列表的统计信息，根据列表数据动态更新背景色 ##调用方法：$('#test').tabs('changetip',['titlename',num,'color']))