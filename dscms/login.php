<?php
session_start(); //啟動 session 功能
header('Content-Type: text/html;charset=UTF-8');
require_once "../lib/dbsettings.php"; //匯入資料庫設定檔 (必須)
require_once "../lib/mysql.php";
$status = "failure"; //預設不符合
$msg = ""; //失敗原因
//查詢認證政策
$RS = search("sys_settings");
$auth_policy = $RS[0]["auth_policy"]; //"normal"/"strict"
//取得登入資訊
$account = $_REQUEST["account"];
$password = md5($_REQUEST["password"]);
//驗證登入資訊
$RS = search("sys_users", "account", $account);
if (is_array($RS)) {
    //有找到帳號
    if ($auth_policy == "strict" && $RS[0]["locked"] == "Y") {
        $msg = "帳號已被鎖住, 請洽管理員.";
    } //end of if
    else {
        //不是嚴格認證, 或嚴格認證但帳號尚未被鎖 : 比對密碼
        if ($RS[0]["password"] === $password) {
            //密碼符合:登入成功
            // $status = "success"; //更新比對結果
            //設定 session 變數
            $_SESSION["user_account"] = $account; //設定 account
            $_SESSION["user_name"] = $RS[0]["name"]; //設定 name
            $_SESSION["user_level"] = $RS[0]["level"]; //設定 level
            //更新 users 中的 login_count 與 last_login
            $data_array["login_count"] = $RS[0]["login_count"] + 1;
            $data_array["last_login"] = date("Y-m-d H:i:s");
            $ret = update("sys_users", $data_array, "account", $account);
            $data_array = null;
            //處理嚴格認證政策 : 失敗次數歸零
            if ($auth_policy == "strict") {
                //嚴格認證
                //重設 users 中的 login_fail_count
                $data_array["login_fail_count"] = 0;
                $ret = update("sys_users", $data_array, "account", $account);
            } //end of if
            $status = "success"; //更改預設登入結果
        } //end of if
        else {
            //密碼不符合:登入失敗
            //處理嚴格認證政策 : 登入失敗次數增量
            if ($auth_policy == "strict") {
                //嚴格認證
                //增量 users 中的 login_fail_count
                $count = $RS[0]["login_fail_count"] + 1;
                if ($count >= 3) {
                    //密碼錯誤 3 次以上
                    $data_array["locked"] = "Y"; //鎖住帳號
                    $msg = "密碼錯誤 3 次, 帳號已鎖住, 請洽管理員.";
                } //end of if
                else {
                    //密碼錯誤未達 3 次
                    $msg = "密碼不符合, 還有 " . (3 - $count) . " 次機會.";
                } //end of else
                $data_array["login_fail_count"] = $count;
                $ret = update("users", $data_array, "account", $account);
            } //end of if
            else {
                //普通認證="normal"
                $msg = "密碼不符合, 請重新登入.";
            } //end of else
        } //end of else : 密碼不符合
    } //end of else : 不是嚴格認證, 或帳號尚未被鎖
} //end of if
else { $msg = "帳號不存在";} //沒找到帳號

$arr["status"] = $status;
$arr["msg"] = $msg;
echo json_encode($arr);
