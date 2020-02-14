<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>首頁</title>
  <link rel="stylesheet" type="text/css" href="../jquery/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
  <script type="text/javascript" src="../jquery/jquery.min.js"></script>
  <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="../jquery/locale/easyui-lang-zh_TW.js"></script>
</head>
<body>
<?php
require_once("../lib/mysql.php"); //匯入資料庫函式
$installed=find_table("sys_settings"); //檢查資料庫是否已安裝
$installed=TRUE; //檢查資料庫是否已安裝
if ($installed===FALSE) { //系統尚未安裝, 先安裝系統資料表
  //設定資料庫參數
	$username="username";
	$password="password";
	$address="domain.com.tw";
	$db="database";
?>
  <div id="install-dialog" class="easyui-dialog" title="系統安裝" style="width:370px;height:290px;padding:10px" buttons="#install-button">
    <div class="form-title" style="margin:5px;border-bottom:1px solid #ccc;">
      <p>請輸入 MySQL 資料庫伺服器管理員帳號密碼安裝</p>
      <p>若無管理員帳號, 請先以 phpMyAdmin 建立資料庫</p>
    </div>
    <form id="install-form" method="post" style="padding:5px 10px;">
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
        success:function(data){
          var data=eval('(' + data + ')');
          if (data.success) {
            $("#install-dialog").dialog("close");
            var msg=data.msg;
            }
          else {var msg="安裝失敗!"}
          $.messager.alert("訊息",msg,"info");
          }
        });
      });
  </script>
<?php
    } //end of if:uninstalled
else { //系統已安裝
?>
  <div id="login-dialog" class="easyui-dialog" title="系統登入" style="width:370px;height:230px;padding:10px" buttons="#login-buttons">
    <div style="margin:5px;border-bottom:1px solid #ccc;">
      <p>請輸入帳號密碼</p>
    </div>
    <form id="login-form" method="post" style="padding:10px 30px;">
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
    <a href="#" id="login-cancel" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">取消</a>
    <a href="#" id="login" class="easyui-linkbutton" iconCls="icon-ok" style="width:90px">登入</a>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#login").bind("click",function(){
        $("#login-form").submit();
        });
      $("#login-form").form({
        url:"login.php",
        success:function(data){
          var data=eval('(' + data + ')');  //將 JSON 轉成物件
          if (data.success) {
            $("#install-dialog").dialog("close");
            var msg=data.msg;
            var url = 'home.html';
            $(location).attr('href',url); // to redirect to the homepage?
            }
          else {var msg="帳號或密碼錯誤!"}
          $.messager.alert("訊息",msg,"info");
          }
        });
      });
  </script>
<?php
    } //end of else:installed
?>
</body>
</html>