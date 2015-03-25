<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>jQM Editable Listview Demo</title>
	
<!-- 引入奥森图标库,此文件可选择引入，用于支持字体图标，用法见http://www.thinkcmf.com/font-->
<link href="/ThinkCMFX1.5.0/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">

<link href="/ThinkCMFX1.5.0/statics/simpleboot/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.min.css"  rel="stylesheet" type="text/css">

<!-- 引入奥森图标ie7支持库,此文件可选择引入，用于支持IE7字体图标，用法见http://www.thinkcmf.com/font-->
<!--[if IE 7]>
 <link rel="stylesheet" href="/ThinkCMFX1.5.0/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
<![endif]-->

<!-- 引入自定义css库，用户可加入自己的css组件-->
<link href="/ThinkCMFX1.5.0/tpl_admin/simpleboot/Todo/Indexadmin/css/style.css" rel="stylesheet">

	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.css" />

	<link rel="stylesheet" href="/ThinkCMFX1.5.0/tpl_admin/simpleboot/Todo/Indexadmin/css/editable-listview.css">
	
</head>

<body style="padding: 20px">
    <?php if(is_array($tds)): foreach($tds as $listname=>$listi): ?><div class="<?php echo ($listname); ?>" style="padding: 20px">

        <div id="div-<?php echo ($listname); ?>-todo" class="divtodo <?php echo ($listname); ?> ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content">
            <h1 class="ui-collapsible-heading">
                <a href="#" class="collapsehead ui-collapsible-heading-toggle ui-btn ui-btn-icon-left ui-btn-inherit ui-icon-plus"><?php echo ($listname); ?> Todo</a><button class="editbtn ui-btn ui-mini ui-btn-inline ui-btn-right ui-btn-icon-right ui-btn-a ui-corner-all ui-shadow ui-icon-edit">Edit</button>
                
            </h1>
            <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">
                <ul id="ul-<?php echo ($listname); ?>-todo" class="ui-listview" list="<?php echo ($listname); ?>">
                    <li class="addform ui-editable-temp ui-li-static ui-body-inherit ui-first-child" style="display:none">
                        <form id="addtodoform"  method="post">
                            <input type="text" name="title" placeholder="title">
                            <input type="hidden" name="listname" value="<?php echo ($listname); ?>">
                            <input type="hidden" name="state" value="1">
                            <input type="text" name="groupname" placeholder="groupname">
                            <input type="text" name="deadline" placeholder="deadline">
                            <input type="text" name="description" placeholder="description">
                            <select name="priority" placeholder="priority">
                                <option selected="selected" value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <select name="privacy" placeholder="privacy">
                                <option selected="selected" value="1">visible</option>
                                <option value="2">Member</option>
                                <option value="3">None</option>
                            </select>
                        </form>
                        
                    </li>
                    <?php if(is_array($listi['todos'])): foreach($listi['todos'] as $key=>$vo): ?><li id="item<?php echo ($vo["id"]); ?>" class="prio<?php echo ($vo["priority"]); ?> ui-li-has-alt">
                        <a class="ui-btn">
                            <h3>
                                <span class="dogroupname"><?php echo ($vo["groupname"]); ?>: </span><span class="dotitle"><?php echo ($vo["title"]); ?></span>
                            </h3>
                            <p><em>Deadline:</em> <strong><span class="deadline"><?php echo ($vo["deadline"]); ?></span></strong></p>
                            <p><em>Description:</em> <strong><span class="description"><?php echo ($vo["description"]); ?></span></strong></p>
                        </a>
                        <a class="ui-btn ui-btn-icon-notext ui-icon-arrow-r" onclick="movetodoing(<?php echo ($vo["id"]); ?>)"></a>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        
        <div id="div-<?php echo ($listname); ?>-doing" class="divdoing <?php echo ($listname); ?> ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content">
            <h1 class="ui-collapsible-heading">
                <a href="#" class="collapsehead ui-collapsible-heading-toggle ui-btn ui-btn-icon-left ui-btn-inherit ui-icon-plus"><?php echo ($listname); ?> Doing</a>
            </h1>
            <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">
                <ul id="ul-<?php echo ($listname); ?>-doing" class="ui-listview" list="<?php echo ($listname); ?>">
                    <?php if(is_array($listi['doings'])): foreach($listi['doings'] as $key=>$vo): ?><li id="item<?php echo ($vo["id"]); ?>" class="prio<?php echo ($vo["priority"]); ?> ui-li-has-alt">
                        <a class="ui-btn">
                            <h3>
                                <span class="dogroupname"><?php echo ($vo["groupname"]); ?>: </span><span class="dotitle"><?php echo ($vo["title"]); ?></span>
                            </h3>
                            <p><em>Deadline:</em> <strong><span class="deadline"><?php echo ($vo["deadline"]); ?></span></strong></p>
                            <p><em>Description:</em> <strong><span class="description"><?php echo ($vo["description"]); ?></span></strong></p>
                        </a>
                        <a class="btn-return ui-btn ui-btn-icon-notext ui-icon-forward" onclick="returntodo(<?php echo ($vo["id"]); ?>)"></a>
                        <a class="ui-btn ui-btn-icon-notext ui-icon-check" onclick="movetodone(<?php echo ($vo["id"]); ?>)"></a>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>

        <div id="div-<?php echo ($listname); ?>-done" class="divdone <?php echo ($listname); ?> ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content">
            <h1 class="ui-collapsible-heading">
                <a href="#" class="collapsehead ui-collapsible-heading-toggle ui-btn ui-btn-icon-left ui-btn-inherit ui-icon-plus"><?php echo ($listname); ?> Done</a>
            </h1>
            <div class="ui-collapsible-content ui-body-inherit" aria-hidden="false">
                <ul id="ul-<?php echo ($listname); ?>-done" class="ui-listview" list="<?php echo ($listname); ?>">
                    <?php if(is_array($listi['dones'])): foreach($listi['dones'] as $key=>$vo): ?><li id="item<?php echo ($vo["id"]); ?>" class="prio5 ui-li-has-alt">
                        <a class="ui-btn">
                            <h3>
                                <span class="dogroupname"><?php echo ($vo["groupname"]); ?>: </span><span class="dotitle"><?php echo ($vo["title"]); ?></span>
                            </h3>
                            <p><em>Deadline:</em> <strong><span class="deadline"><?php echo ($vo["deadline"]); ?></span></strong></p>
                            <p><em>Description:</em> <strong><span class="description"><?php echo ($vo["description"]); ?></span></strong></p>
                        </a>
                        <a class="ui-editable-btn-del ui-btn ui-btn-icon-notext ui-icon-minus" title="Delete" onclick="movetoarchive(<?php echo ($vo["id"]); ?>)"></a>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div><?php endforeach; endif; ?>

    <script type="text/javascript">
//全局变量,必须加入
var GV = {
    DIMAUB: "/ThinkCMFX1.5.0/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- 引入jquery-->
<!-- <script src="/ThinkCMFX1.5.0/statics/js/jquery.js"></script> -->
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<!-- jquery-migrate-1.2.1.min.js -->
    <script src="/ThinkCMFX1.5.0/statics/simpleboot/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>

<!-- 引入wind库，用于js异步加载-->
<!-- <script src="/ThinkCMFX1.5.0/statics/js/wind.js"></script> -->

<!-- 引入bootstrap库，包含bootstrap各种组件-->
<!--    <script src="/ThinkCMFX1.5.0/tpl/simplebootx/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
-->
<!-- 引入ThinkCMF前端库，包含ThinkCMF各种组件，方法，如评论，赞等-->

	<script src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.2/jquery.mobile.js"></script>
<!--
	<script src="/ThinkCMFX1.5.0/tpl_admin/simpleboot/Todo/Indexadmin/js/editable-listview.js"></script>
-->

<script>
$("input[name=deadline]").datepicker();
$("input[name=deadline]").datepicker( "option", "dateFormat","yy-mm-dd","showAnim","fold");

$(".editbtn").click(function(){
    targetform=$(this).parent().parent().find(".addform");
    if(targetform.css("display")=="none"){
        targetform.css("display","inline-block");
        $(this).removeClass("ui-icon-edit").addClass("ui-icon-check");
        $(this).text("Done");

    }
    else{
        $(".addform").css("display","none");
        $(this).removeClass("ui-icon-check").addClass("ui-icon-edit");
         $(this).text("Edit");
    }
});
//collapse
$(".collapsehead").click(function(){
    if($(this).parent().parent().find("div.ui-collapsible-content").css("display")=="none"){
        $(this).parent().parent().find("div.ui-collapsible-content").css("display","block");
        $(this).removeClass("ui-icon-minus").addClass("ui-icon-plus");
    }
    else{
        $(this).parent().parent().find("div.ui-collapsible-content").css("display","none");
        $(this).removeClass("ui-icon-plus").addClass("ui-icon-minus");
    }
});

$("form").change(function(){
    if(!$(this).parent().find("button").length){
        listname=$(this).parent().parent().attr("id");
        $(this).after('<button id="formadd" class="addnewtodo-btn ui-btn ui-shadow ui-corner-all" onclick="addnewtodo()">Add</button>')
    }
});

function addnewtodo(){
    targetform=$("button.addnewtodo-btn").parent().find("form");
    // par=targetform.serialize();
    // groupname=targetform.find("input[name=groupname]").val();
    // title=targetform.find("input[name=title]").val();
    // deadline=targetform.find("input[name=deadline]").val();
    // description=targetform.find("input[name=description]").val();
    // priority=targetform.find("select[name=priority]").val();
    // privacy=targetform.find("select[name=privacy]").val();

    $.ajax({      
        type: "POST",      
        url: "<?php echo U('Indexadmin/addnewtodo');?>",     
        data: targetform.serialize(),
        success: function(r){
            msg=JSON.parse(r); 
            console.log(msg.status);
            if(msg.status==1){
                window.location.reload();
                // id=msg.url.slice(msg.url.indexOf("id")+3);
               // addtodoitem(targetform,id,groupname,title,deadline,description,priority);
                // targetform.find("input[type=text], textarea").val("");
                // targetform.parent().parent().parent().parent().find("button.editbtn").click();
            }
            else
                alert(msg.info);
        }  
    });
    
}

// function addtodoitem(targetform,id,groupname,title,deadline,description,priority){
//     targetform.parent().parent().append('<li id="item'+id+'" class="prio'+priority+' ui-li-has-alt" data-item="1">\
//                         <a class="ui-btn">\
//                             <h3>\
//                                 <span class="dogroupname">'+groupname+':</span><span class="dotitle">'+title+'</span>\
//                             </h3>\
//                             <p><em>Deadline:</em> <strong><span class="deadline">'+deadline+'</span></strong></p>\
//                             <p><em>Description:</em> <strong><span class="description">'+description+'</span></strong></p>\
//                         </a>\
//                         <a class="ui-btn ui-btn-icon-notext ui-icon-arrow-r" onclick="movetodoing('+id+')"></a>
//                     </li>');
// }   
// function adddoingitem(item){
//     targetform.parent().parent().append('<li id="item'+id+'" class="prio'+priority+'  ui-li-has-alt">\
//                         <a class="ui-btn a-item-doing">\
//                             <h3>\
//                                 <span class="dogroupname">'+groupname+': </span><span class="dotitle">'+title+'</span>\
//                             </h3>\
//                             <p><em>Deadline:</em> <strong><span class="deadline">'+deadline+'</span></strong></p>\
//                             <p><em>Description:</em> <strong><span class="description">'+description+'</span></strong></p>\
//                         </a>\
//                         <a class="btn-return ui-btn ui-btn-icon-notext ui-icon-forward" onclick="returntodo('+id+')"></a>\
//                         <a class="ui-btn ui-btn-icon-notext ui-icon-check" onclick="movetodone('+id+')"></a>\
//                     </li>');
// }   
function movetodoing(itemid){
    obj=$("#item"+itemid);
    targetlist=obj.parent().attr("list");
    $.ajax({      
        type: "POST",      
        url: "<?php echo U('Indexadmin/move');?>",     
        data: {id:itemid, state:2},
        success: function(r){
            msg=JSON.parse(r); 
            if(msg.status==1){
                obj.find("a.ui-icon-arrow-r").remove();
                obj.append('<a class="btn-return ui-btn ui-btn-icon-notext ui-icon-forward" onclick="returntodo('+itemid+')"></a><a class="ui-btn ui-btn-icon-notext ui-icon-check" onclick="movetodone('+itemid+')"></a>');
                $("#ul-"+targetlist+"-doing").prepend(obj);
            }
            else
                alert(msg.info);
        }  
    });
}
function movetodone (itemid) {
    obj=$("#item"+itemid);
    targetlist=obj.parent().attr("list");
    $.ajax({      
        type: "POST",      
        url: "<?php echo U('Indexadmin/move');?>",     
        data: {id:itemid, state:3, priority:5},
        success: function(r){
            msg=JSON.parse(r); 
            if(msg.status==1){
                obj.find("a.ui-icon-forward").remove();
                obj.find("a.ui-icon-check").remove();
                obj.append('<a class="ui-editable-btn-del ui-btn ui-btn-icon-notext ui-icon-minus" title="Delete" onclick="movetoarchive('+itemid+')"></a>');
                obj.removeClass("prio1 prio2 prio3 prio4");
                obj.addClass("prio5");
                $("#ul-"+targetlist+"-done").prepend(obj);
            }
            else
                alert(msg.info);
        }  
    });
}
function returntodo (itemid) {
    obj=$("#item"+itemid);
    targetlist=obj.parent().attr("list");
    $.ajax({      
        type: "POST",      
        url: "<?php echo U('Indexadmin/move');?>",     
        data: {id:itemid, state:1},
        success: function(r){
            msg=JSON.parse(r); 
            if(msg.status==1){
                obj.find("a.ui-icon-forward").remove();
                obj.find("a.ui-icon-check").remove();
                obj.append('<a class="ui-btn ui-btn-icon-notext ui-icon-arrow-r" onclick="movetodoing('+itemid+')"></a>');
                $("#ul-"+targetlist+"-todo").prepend(obj); 
            }
            else
                alert(msg.info);
        }  
    });
}
function movetoarchive(itemid){
    $.ajax({      
        type: "POST",      
        url: "<?php echo U('Indexadmin/move');?>",     
        data: {id:itemid, show:0},
        success: function(r){
            msg=JSON.parse(r); 
            if(msg.status==1){
                $("#item"+itemid).remove();
            }
            else
                alert(msg.info);
        }  
    });
}

        
	</script>
</body>
</html>