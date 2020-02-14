<?php
//取得 MySQL 資料庫安裝參數
$address = $_REQUEST["address"];
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$database = $_REQUEST["database"];
//定義 mysql.php 中須使用之資料庫常數 (mysql.php 要用到)
define('MYSQL_ADDRESS', $address);
define('MYSQL_USERNAME', $username);
define('MYSQL_PASSWORD', $password);
define('DATABASE', $database);
//匯入函式庫
include_once "../lib/mysql.php"; //匯入資料庫模組
$msg = "MySQL 資料庫參數 : <br>" .
"MYSQL_ADDRESS=$address<br>" .
"MYSQL_USERNAME=$username<br>" .
"MYSQL_PASSWORD=$password<br>" .
"DATABASE=$database<br>";
//建立系統資料庫
$result = create_database($database);
if (!$result) {
    //無 root 帳號情況 (例如免費主機代管)
    $msg .= "無法建立資料庫 $database!<br>" .
    "請檢查 MySQL 資料庫參數是否正確.<br>" .
    "建立資料庫需要 MySQL 管理員帳號.<br>" .
    "如僅有使用者帳號, 請先進入 phpMyAdmin 建立資料庫再安裝系統.<br>";
    $status = "fail";
} //end of if
else {
    //有 root 帳號 (例如 localhost)
    $msg .= "建立資料庫 $database ... 完成!<br>";
    //設定資料庫編碼
    $SQL = "ALTER DATABASE " . $database . " DEFAULT CHARSET=utf8 " .
    "DEFAULT COLLATE=utf8_unicode_ci";
    $result = run_sql($SQL);
    if ($result) {
        $msg .= "設定資料庫 $database 編碼為 utf8 校對為 utf8_unicode_ci ... " .
        "完成!<br>";
    } //end of if
    //建立 sys_settings 資料表
    $data_array["sys_theme"] = "varchar(255)"; //EasyUI 主題佈景
    $data_array["site_title"] = "varchar(255)"; //網站標題
    $data_array["system_state"] = "varchar(255)"; //系統狀態 (工作中/維護中)
    $data_array["auth_policy"] = "varchar(255)"; //密碼驗證政策 (一般/嚴格)
    $data_array["min_password_length"] = "tinyint(4)"; //密碼最短長度 (3~12)
    $data_array["password_type"] = "tinyint(4)"; //密碼類型限制 (0~4)
    $result = create_table("sys_settings", $data_array);
    if ($result) {$msg .= "建立資料表 sys_settings ... 完成!<br>";}
    $data_array = null;
    //插入 sys_settings 之管理標籤
    $data_array["sys_theme"] = "default";
    $data_array["site_title"] = "庫存管理系統--CMS";
    $data_array["system_state"] = "active"; //工作中 "active" 維護中 "inactive"
    $data_array["auth_policy"] = "normal"; //"normal"/"strict"
    $data_array["min_password_length"] = 3; //3~12
    $data_array["password_type"] = "0"; //0~4
    //"strict"=密碼長度 8 碼,至少一個英文字母,try 3 次鎖住,90天換一次,
    //不可與前三次相同
    $result = insert("sys_settings", $data_array);
    $data_array = null;
    //建立 sys_tabs 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["tab_name"] = "varchar(255)";
    $data_array["tab_label"] = "varchar(255)";
    $data_array["tab_link"] = "varchar(255)";
    $data_array["tab_level"] = "tinyint(4)"; //1 (使用者) ~9 (管理者)
    $data_array["tab_tip"] = "varchar(255)";
    $data_array["tab_order"] = "tinyint(4)";
    $result = create_table("sys_tabs", $data_array);
    if ($result) {$msg .= "建立資料表 sys_tabs ... 完成!<br>";}
    $data_array = null;
    //插入 sys_tabs 之首頁標籤
    $data_array["tab_name"] = "home";
    $data_array["tab_label"] = "首頁";
    $data_array["tab_link"] = "home.php?tab=logout";
    $data_array["tab_level"] = 1;
    $data_array["tab_tip"] = "首頁";
    $data_array["tab_order"] = 1;
    $result = insert("sys_tabs", $data_array);
    $data_array = null;
    //插入 sys_tabs 之新聞標籤
    $data_array["tab_name"] = "news";
    $data_array["tab_label"] = "新聞";
    $data_array["tab_link"] = "home.php?tab=news";
    $data_array["tab_level"] = 1;
    $data_array["tab_tip"] = "新聞";
    $data_array["tab_order"] = 2;
    $result = insert("sys_tabs", $data_array);
    $data_array = null;
    //插入 sys_tabs 之留言標籤
    $data_array["tab_name"] = "board";
    $data_array["tab_label"] = "留言";
    $data_array["tab_link"] = "home.php?tab=board";
    $data_array["tab_level"] = 1;
    $data_array["tab_tip"] = "留言";
    $data_array["tab_order"] = 3;
    $result = insert("sys_tabs", $data_array);
    $data_array = null;
    //插入 sys_tabs 之檔案標籤
    $data_array["tab_name"] = "file";
    $data_array["tab_label"] = "檔案";
    $data_array["tab_link"] = "home.php?tab=file";
    $data_array["tab_level"] = 1;
    $data_array["tab_tip"] = "檔案";
    $data_array["tab_order"] = 3;
    $result = insert("sys_tabs", $data_array);
    $data_array = null;
    //插入 sys_tabs 之管理標籤
    $data_array["tab_name"] = "admin";
    $data_array["tab_label"] = "管理";
    $data_array["tab_link"] = "sys.php?tab=admin";
    $data_array["tab_level"] = 9;
    $data_array["tab_tip"] = "管理";
    $data_array["tab_order"] = 99;
    $result = insert("sys_tabs", $data_array);
    $data_array = null;
    //建立 sys_themes 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["theme"] = "varchar(255)";
    $result = create_table("sys_themes", $data_array);
    if ($result) {$msg .= "建立資料表 sys_themes ... 完成!<br>";}
    $data_array = null;
    //插入 sys_themes 之主題佈景
    $themes = array('default', 'gray', 'black', 'bootstrap', 'metro',
        'metro-blue', 'metro-gray', 'metro-green', 'metro-orange',
        'metro-red', 'ui-cupertino', 'ui-dark-hive',
        'ui-pepper-grinder', 'ui-sunny');
    for ($i = 0; $i < count($themes); $i++) {
        $data_array["theme"] = $themes[$i];
        $result = insert("sys_themes", $data_array);
        $data_array = null;
    }
    //建立 sys_users 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["account"] = "varchar(255)";
    $data_array["password"] = "varchar(255)";
    $data_array["name"] = "varchar(255)";
    $data_array["theme"] = "varchar(255)";
    $data_array["email"] = "varchar(255)";
    $data_array["maillist"] = "char(1)"; //"Y","N"
    $data_array["level"] = "tinyint(4)"; //0(unapproved),1(users), ~9(admin)
    $data_array["mobile_phone"] = "varchar(255)"; //for SMS
    $data_array["send_sms"] = "char(1)"; //"Y","N", 是否傳送簡訊
    $data_array["login_count"] = "int(11) NOT NULL DEFAULT '0'"; //登入成功次數
    $data_array["last_login"] = "datetime NOT NULL"; //最近一次登入時間
    $data_array["login_fail_count"] = "tinyint(4) NOT NULL DEFAULT 0"; //失敗次數
    $data_array["last_3_passwords"] = "varchar(255)"; //最近三次密碼a-b-c
    $data_array["locked"] = "char(1) NOT NULL DEFAULT 'N'"; //'Y'=locked
    $result = create_table("sys_users", $data_array);
    if ($result) {$msg .= "建立資料表 sys_users ... 完成!<br>";}
    $data_array = null;
    //插入 sys_users 之管理者帳號密碼
    $data_array["account"] = "admin"; //預設 admin
    $data_array["password"] = md5("admin"); //md5 加密,預設 admin
    $data_array["name"] = "admin"; //預設 admin
    $data_array["theme"] = "default"; //預設
    $data_array["maillist"] = "Y"; //郵寄列表
    $data_array["level"] = "9"; //管理者最高等級 (不會被刪除,只有本人可修改)
    $data_array["send_sms"] = "N"; //預設關閉簡訊傳送功能
    $result = insert("sys_users", $data_array);
    $data_array = null;
    //插入 sys_users 之 test 帳號密碼
    $data_array["account"] = "test"; //預設 admin
    $data_array["password"] = md5("test"); //md5 加密
    $data_array["name"] = "test";
    $data_array["theme"] = "metro";
    $data_array["maillist"] = "Y"; //郵寄列表
    $data_array["level"] = "1"; //管理者最高等級 (不會被刪除,只有本人可修改)
    $data_array["send_sms"] = "N"; //預設關閉簡訊傳送功能
    $result = insert("sys_users", $data_array);
    $data_array = null;
    //建立 sys_visitors 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["visit_time"] = "datetime NOT NULL"; //紀錄訪客到訪時間
    $data_array["remote_addr"] = "varchar(255)"; //紀錄訪客主機位址
    $data_array["remote_port"] = "varchar(255)"; //紀錄訪客通訊埠
    $data_array["user_agent"] = "varchar(255)"; //紀錄訪客主機瀏覽器
    $result = create_table("sys_visitors", $data_array);
    if ($result) {$msg .= "建立資料表 sys_visitors ... 完成!<br>";}
    $data_array = null;
    //建立 sys_apps 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["app_name"] = "varchar(255)"; //應用程式名稱
    $data_array["installed"] = "char(1)"; //已安裝 "Y"/"N"
    $data_array["show_tabs"] = "char(1)"; //顯示頁籤 "Y"/"N"
    $data_array["tab_names"] = "varchar(255)"; //頁籤名稱
    $data_array["table_names"] = "varchar(255)"; //資料表名稱
    $data_array["remark"] = "varchar(255)"; //安裝結果
    $result = create_table("sys_apps", $data_array);
    if ($result) {$msg .= "建立資料表 sys_apps ... 完成!<br>";}
    $data_array = null;
    $status = "succeed";
    //建立 sys_header_links 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["title"] = "varchar(255)"; //連結名稱
    $data_array["url"] = "varchar(255)"; //網址
    $data_array["target"] = "varchar(255)"; //連結目標
    $data_array["sequence"] = "tinyint(2)"; //顯示順序
    $data_array["hint"] = "varchar(255)"; //連結提示
    $result = create_table("sys_header_links", $data_array);
    if ($result) {$msg .= "建立資料表 sys_header_links ... 完成!<br>";}
    $data_array = null;
    //插入 sys_header_links 之連結
    $data_array["title"] = "首頁";
    $data_array["url"] = "javascript:gohome()";
    $data_array["target"] = "_self";
    $data_array["sequence"] = 1;
    $data_array["hint"] = "首頁";
    $result = insert("sys_header_links", $data_array);
    if ($result) {$msg .= "插入資料表 sys_header_links ... 完成!<br>";} else { $msg .= $result;}
    $data_array = null;
    //插入 sys_header_links 之連結
    $data_array["title"] = "登出";
    $data_array["url"] = "javascript:logout()";
    $data_array["target"] = "_self";
    $data_array["sequence"] = 1;
    $data_array["hint"] = "登出";
    $result = insert("sys_header_links", $data_array);
    $data_array = null;
    //建立 sys_nav_blocks 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["title"] = "varchar(255)"; //導覽區名稱
    $data_array["sequence"] = "tinyint(1)"; //顯示順序
    $data_array["display"] = "char(1)"; //是否顯示 "Y"/"N"
    $result = create_table("sys_nav_blocks", $data_array);
    if ($result) {$msg .= "建立資料表 sys_nav_blocks ... 完成!<br>";}
    $data_array = null;
    //插入 sys_nav_blocks 之連結
    $data_array["title"] = "主功能";
    $data_array["sequence"] = 1;
    $data_array["display"] = "Y";
    $result = insert("sys_nav_blocks", $data_array);
    $data_array = null;
    //建立 sys_nav_links 資料表
    $data_array["id"] = "smallint(6) NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $data_array["title"] = "varchar(255)"; //導覽區名稱
    $data_array["url"] = "varchar(255)"; //網址
    $data_array["target"] = "varchar(255)"; //連結目標
    $data_array["sequence"] = "tinyint(1)"; //顯示順序
    $data_array["block_id"] = "varchar(255)"; //導覽區名稱
    $data_array["hint"] = "varchar(255)"; //連結提示
    $result = create_table("sys_nav_links", $data_array);
    if ($result) {$msg .= "建立資料表 sys_nav_links ... 完成!<br>";}
    //插入 sys_nav_links 之連結
    $data_array["title"] = "首頁";
    $data_array["url"] = "javascript:gohome()";
    $data_array["target"] = "_self";
    $data_array["sequence"] = 1;
    $data_array["block_id"] = 1;
    $data_array["hint"] = "首頁";
    $result = insert("sys_nav_links", $data_array);
    $data_array = null;
    //插入 sys_nav_links 之連結
    $data_array["title"] = "登出";
    $data_array["url"] = "javascript:logout()";
    $data_array["target"] = "_self";
    $data_array["sequence"] = 1;
    $data_array["block_id"] = 1;
    $data_array["hint"] = "登出";
    $result = insert("sys_nav_links", $data_array);
    $data_array = null;
} //end of else
$arr["status"] = $status;
$arr["msg"] = $msg;
echo json_encode($arr);
