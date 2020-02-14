<?php
session_start(); //啟動 session 功能
//檢查是否已登入, 否則回登入畫面
if (!isset($_SESSION["user_account"])) {
    header('Location: index.php');
}
date_default_timezone_set("Asia/Taipei"); //設定台北時間
require_once "../lib/dbsettings.php"; //匯入資料庫設定檔
require_once "../lib/mysql.php"; //匯入資料庫模組
// require_once "../lib/parse.php"; //匯入剖析模組
// require_once "../lib/file.php"; //匯入檔案模組
//製作日期顯示
$week_arr = array("日", "一", "二", "三", "四", "五", "六");
list($Y, $M, $D) = explode("-", date("Y-m-d")); //取出年月日
$week = $week_arr[date("w", mktime(0, 0, 0, $M, $D, $Y))];
$greeting = "您好! " . $_SESSION["user_name"] . ", " . "今天是 $Y 年 $M 月 $D 日 星期$week";
//擷取系統設定布景
$RS = search("sys_settings");
if (is_array($RS)) {
    $sys_theme = $RS[0]["sys_theme"];
} else {
    $sys_theme = "default";
}
//擷取使用者布景
$RS = search("sys_users", "account", $_SESSION["user_account"]);
if (is_array($RS)) {
    $user_theme = $RS[0]["theme"];
} else {
    $user_theme = $sys_theme;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>DMClinic</title>
  <link id="theme" rel="stylesheet" type="text/css" href="../jquery/themes/<?php echo $user_theme?>/easyui.css">
  <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="../jquery/demo/demo.css">
  <script type="text/javascript" src="../jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="../jquery/date-format.js"></script>
  <script type="text/javascript" src="../jquery/locale/easyui-lang-zh_TW.js"></script>
  <style>
    a {text-decoration:none;}
    a:hover {text-decoration:underline;background-color:yellow;font-size:14px;}
    #west {width:150px;}
    #west-inner {border-top:0px;border-right:0px;border-bottom:0px;}
    .nav {padding:5px;}
    .tab {padding:10px;}
    #north {height:55px;overflow:hidden;}
    #north-table {width:100%;border-spacing:0px}
    #north-left {text-align:left;padding:5px;}
    #north-right {text-align:right;padding:5px;}
  </style>
</head>
<body id="layout" class="easyui-layout">
  <div id="north" title="庫存管理系統--CMS" data-options="region:'north',border:false,collapsible:true,tools:'#tools'">
    <form id="header-form" method="post">
      <table id="north-table">
        <tr>
          <td id="north-left"><?php echo $greeting?></td>
          <td id="north-right">
<?php
$SQL = "SELECT * FROM `sys_header_links`";
$RS = run_sql($SQL);
if (is_array($RS)) {
    for ($i = 0; $i < count($RS); $i++) {
        $title = $RS[$i]["title"];
        $url = $RS[$i]["url"];
        $target = $RS[$i]["target"];
        $hint = $RS[$i]["hint"];
        ?>
            <a href="<?php echo $url?>" target="<?php echo $target?>" title="<?php echo $hint?>"><?php echo $title?></a>．
<?php
}
}
?>
            <select id="theme_sel" name="theme" class="easyui-combobox" style="width:120px;height:18px" panelHeight="150">
              <option value="default">主題布景</option>
<?php
$SQL = "SELECT * FROM `sys_themes`";
$RS = run_sql($SQL);
if (is_array($RS)) {
    for ($i = 0; $i < count($RS); $i++) {
        $theme = $RS[$i]["theme"];
        ?>
              <option value="<?php echo $theme?>"<?php if ($theme == $user_theme) {echo " selected";}
        ?>><?php echo $theme?></option>
<?php
}
}
?>
            </select>
          </td>
        </tr>
      </table>
    </form>
  </div>
  <div id="tools">
   <a href="javascript:logout()" class="icon-remove"></a>
  </div>
  <div title="導覽" data-options="region:'west',border:true" id="west">
    <div class="easyui-accordion" id="west-inner">
<?php
$SQL = "SELECT * FROM `sys_nav_blocks` WHERE display='Y' ORDER BY sequence";
$RS = run_sql($SQL);
if (is_array($RS)) {
    for ($i = 0; $i < count($RS); $i++) {
        $block_id = $RS[$i]["id"];
        $title = $RS[$i]["title"];
        ?>
      <div title="<?php echo $title?>" class="nav">
<?php
$SQL = "SELECT * FROM `sys_nav_links` WHERE block_id=" . $block_id . " ORDER BY sequence";
        $RS1 = run_sql($SQL);
        if (is_array($RS1)) {
            for ($j = 0; $j < count($RS1); $j++) {
                $title = $RS1[$j]["title"];
                $url = $RS1[$j]["url"];
                $target = $RS1[$j]["target"];
                $hint = $RS1[$j]["hint"];
                ?>
        ．<a href="<?php echo $url?>" target="<?php echo $target?>" title="<?php echo $hint?>"><?php echo $title?></a><br>
<?php
}
        }
        ?>
      </div>
<?php
}
}
?>
    </div>
  </div>
  <div data-options="region:'center',border:false,href:'home.php?tab=home'" id="center">
  </div>
  <script>
    function gohome(){
      $(function(){
        var p=$("#layout").layout("panel","center");
        p.panel({href:"home.php?tab=home"});
      });
    }
    function logout(){
      $(function(){
        $.messager.confirm("確認","確定要登出系統嗎",function(btn){
          if (btn) {window.location.href="logout.php";}
          });
      });
    }
    function gousers(){
      $(function(){
        var p=$("#layout").layout("panel","center");
        p.panel({href:"home.php?tab=admin"});
      });
    }
    function gowarehousing(){
      $(function(){
        var p=$("#layout").layout("panel","center");
        p.panel({href:"home.php?tab=warehousing"});
      });
    }
    function goselling(){
      $(function(){
        var p=$("#layout").layout("panel","center");
        p.panel({href:"home.php?tab=selling"});
      });
    }
    function goinventorying(){
      $(function(){
        var p=$("#layout").layout("panel","center");
        p.panel({href:"home.php?tab=inventorying"});
      });
    }
    $(document).ready(function(){
      $("#theme_sel").combobox({
        onSelect:function(rec){
          var css="../jquery/themes/" + rec.value + "/easyui.css";
          $("#theme").attr("href", css);
        }
      });
    });
  </script>
</body>
</html>