<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>首頁</title>
  <link rel="stylesheet" type="text/css" href="../jquery/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
  <script type="text/javascript" src="../jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="../jquery/locale/easyui-lang-zh_TW.js"></script>
</head>
<body>
<?php
require_once "../lib/dbsettings.php"; //匯入資料庫設定檔 (必須)
require_once "../lib/mysql.php"; //匯入資料庫模組   (必須)
// require_once "../lib/parse.php"; //匯入剖析模組     (必須)
// require_once "../lib/file.php"; //匯入剖析模組     (必須)
$installed = find_table("sys_settings"); //檢查資料庫是否已安裝
if ($installed === false) {
    //系統尚未安裝:顯示安裝對話框
    // $str = read_file("../lib/dbsettings.php"); //讀取資料庫設定檔
    // $username = return_between($str, "'MYSQL_USERNAME','", "')", "EXCL");
    // $password = return_between($str, "'MYSQL_PASSWORD','", "')", "EXCL");
    // $address = return_between($str, "'MYSQL_ADDRESS','", "')", "EXCL");
    // $db = return_between($str, "'DATABASE','", "')", "EXCL");
    $username = MYSQL_USERNAME;
    $password = MYSQL_PASSWORD;
    $address = MYSQL_ADDRESS;
    $db = DATABASE;
    ?>
  <div id="install-dialog" class="easyui-dialog" title="系統安裝" style="width:370px;height:290px;padding:10px" buttons="#install-button">
    <div class="form-title" style="margin:5px;border-bottom:1px solid #ccc;">
      <p>請輸入 MySQL 資料庫伺服器管理員帳號密碼安裝</p>
      <p>若無管理員帳號, 請先以 phpMyAdmin 建立資料庫</p>
    </div>
    <form id="install-form" style="padding:5px 10px;">
      <div style="margin:5px">
        <label style="width:80px;display:inline-block;">MySQL 位址 : </label>
        <input name="address" type="text" class="easyui-textbox" required="true" data-options="missingMessage:'此欄位為必填'" style="width:220px" value="<?php echo $address?>">
      </div>
      <div style="margin:5px">
        <label style="width:80px;display:inline-block;">MySQL 帳號 : </label>
        <input name="username" type="text" class="easyui-textbox" required="true" data-options="missingMessage:'此欄位為必填'" style="width:220px" value="<?php echo $username?>">
      </div>
      <div style="margin:5px">
        <label style="width:80px;display:inline-block;">MySQL 密碼 : </label>
        <input name="password" type="text" class="easyui-textbox" required="true" data-options="missingMessage:'此欄位為必填'" style="width:220px" value="<?php echo $password?>">
      </div>
      <div style="margin:5px">
        <label style="width:80px;display:inline-block;">資料庫名稱 : </label>
        <input name="database" type="text" class="easyui-textbox" required="true" data-options="missingMessage:'此欄位為必填'" style="width:220px" value="<?php echo $db?>">
      </div>
    </form>
  </div>
  <div id="install-button" style="padding-right:15px;">
    <a href="#" id="install" class="easyui-linkbutton" iconCls="icon-ok" style="width:90px">安裝</a>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#install").bind("click",function(){
        $("#install-form").submit();
        });
      $("#install-form").form({
        url:"install.php",
        method:"post",
        success:function(data){
          var data=eval('(' + data + ')');
          $("#install-dialog").dialog("close");
          if (data.status==="succeed") {
            $.messager.alert("訊息",data.msg,"",function(btn){
              if (btn){window.location.href="index.php";}
              else {window.location.href="index.php";}
              });
            }
          else {
            $.messager.alert("訊息",data.msg,"info",function(btn){
              if (btn){window.location.href="index.php";}
              else {window.location.href="index.php";}
              });
            }
          }
        });
      });
  </script>
<?php
} //end of if:uninstalled
else { //系統已安裝:顯示登入對話框
    ?>
  <div id="login-dialog" class="easyui-dialog" title="系統登入" style="width:370px;height:250px;padding:10px" buttons="#login-buttons">
    <div style="margin:5px;border-bottom:1px solid #ccc;">
      <p>請輸入帳號密碼</p>
    </div>
    <form id="login-form" style="padding:10px 30px;">
      <div style="margin:5px">
        <label style="width:60px;display:inline-block;">帳號 : </label>
        <input name="account" type="text" class="easyui-textbox" required="true" data-options="iconCls:'icon-man',missingMessage:'此欄位為必填'"  style="width:200px">
      </div>
      <div style="margin:5px">
        <label style="width:60px;display:inline-block;">密碼 : </label>
        <input name="password" type="password" class="easyui-textbox" required="true" data-options="iconCls:'icon-lock',missingMessage:'此欄位為必填'" style="width:200px">
      </div>
    </form>
  </div>
  <div id="login-buttons" style="padding-right:15px;">
    <a href="#" id="clear" class="easyui-linkbutton" iconCls="icon-clear" style="width:90px">重設</a>
    <a href="#" id="login" class="easyui-linkbutton" iconCls="icon-ok" style="width:90px">登入</a>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#login").bind("click",function(){
        $("#login-form").submit();
        });
      $("#clear").bind("click",function(){
        $("#login-form")[0].reset();
        });
      $("#login-form").form({
        url:"login.php",
        method:"post",
        success:function(data){
          var data=eval('(' + data + ')');
          $("#login-dialog").dialog("close");
          if (data.status==="success") {
            window.location.href="main.php";
            }
          else {
            $.messager.alert("訊息",data.msg,"info",function(btn){
              if (btn){window.location.href="index.php";}
              else {window.location.href="index.php";}
              });
            }
          }
        });
      });
  </script>
<?php
} //end of else:installed
?>
</body>
</html>