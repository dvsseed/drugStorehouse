<?php
header('Content-Type: text/html;charset=UTF-8');

// 匯入資料庫設定
// require_once "dbsettings.php";

// SQL injection prevention
require "antisqlinjection.php";

// 定義資料庫連線函式
// 若連線成功, 此函式會傳回連線物件
function get_connection($address = MYSQL_ADDRESS, $username = MYSQL_USERNAME, $password = MYSQL_PASSWORD, $database = DATABASE)
{
    // @$conn = mysql_connect($address, $username, $password); //抑制錯誤顯示
	@$conn = new mysqli($address, $username, $password, $database);
    //設定查詢所用之字元集為 utf-8
    // if ($conn) {mysql_query("SET NAMES 'utf8'");} else {
    if ($conn) {$conn->query("SET NAMES 'utf8'");} else {
        if (SHOW_ERROR) {
            echo "無法建立 MySQL 資料庫連線, 請檢查 dbsettings.php 設定!<br>";
        }
    } //end of else
    return $conn;
}

// 定義 find_table() 函式, 用來尋找指定的資料表
function find_table($table, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    $SQL = "SHOW TABLES;";
    // $result = mysql_query($SQL, $conn); //顯示資料表
    $result = $conn->query($SQL); //顯示資料表
    // while ($data = mysql_fetch_row($result)) {
    while ($data = mysqli_fetch_row($result)) {
        if ($data[0] == $table) {
            // mysql_free_result($result);
            // mysql_close($conn);
            mysqli_free_result($result);
            mysqli_close($conn);
            return true;
        } //end of if
    } //end of while
    // mysql_free_result($result);
    // mysql_close($conn);
    mysqli_free_result($result);
    mysqli_close($conn);
    return false;
}

// 尋找指定的資料表、指定欄位記錄
function search($table = "", $field = "", $value = "", $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE

    if (empty($table)) {
        $SQL = "";
    } else {
        $SQL = "SELECT * FROM " . $table;
    }
    // return $field . $value;
    if (empty($field) && empty($value)) {
        $WHERE = "";
    } else {
        // $WHERE = " WHERE " . $field . " = '" . sanitize($value) . "' ";
        $WHERE = " WHERE " . $field . " = '" . $value . "' ";
    }
    $SQL .= $WHERE;
    // $result = mysql_query($SQL, $conn); //顯示資料表
    $result = $conn->query($SQL); //顯示資料表

    //從紀錄集資源識別字擷取紀錄為紀錄集陣列
    // for ($i = 0; $i < mysql_num_rows($result); $i++) {
        // $RS[$i] = mysql_fetch_array($result);
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $RS[$i] = mysqli_fetch_array($result);
    } //end of for
    //若紀錄集陣列為一列 (單筆記錄), 則回傳單列紀錄 (即第一列索引 0)
    //if (sizeof($RS)==1) {$RS=$RS[0];}
    return $RS; //傳回紀錄集陣列
}

// 新增資料庫
// 範例 :
// $result=create_database("forexampledb");
function create_database($database, $address = MYSQL_ADDRESS, $username = MYSQL_USERNAME, $password = MYSQL_PASSWORD, $database = DATABASE)
{
    // $conn = get_connection($address, $username, $password); //取得 MySQL 資料庫連線
    $conn = get_connection($address, $username, $password, $database); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    $SQL = "CREATE DATABASE IF NOT EXISTS " . $database . " DEFAULT CHARSET=utf8 " . "DEFAULT COLLATE=utf8_unicode_ci";
    // $result = mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
    // if (mysql_error($conn)) {
    $result = $conn->query($SQL); //成功傳回資源識別字, 失敗傳回 FALSE
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL CREATE DATABASE Error : " . mysql_error($conn) . "<br>";
            echo "MySQL CREATE DATABASE Error : " . $conn->error . "<br>";
        }
    }
    return $result;
}

// 新增資料表
// 範例 :
//   $field_array["id"]="VARCHAR(20)";
//   $field_array["name"]="VARCHAR(255)";
//   $field_array["login_counts"]="INT(2)";
//   $field_array["serial_no"]="INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT"." PRIMARY KEY";
//   $result=create_table("users",$field_array);
// 可用型態如下  :
//  VARCHAR(20)   : 可變長度字元 255 bytes (文字)
//  CHAR(4)       : 固定長度字元 255 bytes (文字)
//  TINYTEXT      : 255 Bytes (文字)
//  TEXT          : 65535 bytes (文字)
//  MEDIUMTEXT    : 16777215 bytes (文字)
//  LONGTEXT      : 4294967295 bytes (文字)
//  TINYBLOB      : 255 bytes (文字)
//  BLOB          : 65535 bytes (文字,分大小寫)
//  MEDIUMBLOB    : 16777215 bytes (文字,分大小寫)
//  LONGBLOB      : 4294967295 bytes (文字,分大小寫)
//  TINYINT(M)    : 1 bytes (最大顯示寬度 M<=255)
//  SMALLINT(M)   : 2 bytes (最大顯示寬度 M<=255)
//  MEDIUMINT(M)  : 3 bytes (最大顯示寬度 M<=255)
//  INT,INTEGER(M): 4 bytes (最大顯示寬度 M<=255)
//  BIGINT(M)     : 8 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
//  FLOAT(M,D)    : 4 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
//  DOUBLE(M,D)   : 8 bytes (總位數 M<=65, 小數位數 D<=30&M-2)
//  DECIMAL(M,D)  : ? bytes (總位數 M<=65, 小數位數 D<=30&M-2)
//  DATE          : 3 bytes (YY-MM-DD)
//  DATETIME      : 8 bytes (YY-MM-DD HH:MM::SS)
//  TIMESTAMP     : 4 bytes (1970-01-01 00:00:00)
//  TIME          : 3 bytes (HH:MM:SS)
//  YEAR(2|4)     : 1 byte (預設 4)
//  ENUM          : 1~2 bytes (儲存單選 radio)
//  SET           : 1~8 bytes (儲存多選 checkbox)
// 可用屬性如下  :
//  SIGNED,UNSIGNED : 是否有負值 (數值)
//  AUTO_INCREMENT  : 自動增量編號 (數值)
//  BINARY          : 字元有大小寫之分 (文字)
//  NULL,NOT NULL   : 是否允許不填入資料 (全部)
//  DEFAULT         : 預設值
//  PRIMARY KEY     : 資料表之唯一主鍵
function create_table($table, $field_array, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    $fields_str = ""; //欄位字串
    for ($i = 0; $i < count($field_array); $i++) {
        list($key, $value) = each($field_array);
        $fields_str .= "`" . $key . "` " . $value;
        if ($i != count($field_array) - 1) {$fields_str .= ",";}
    }
    $SQL = "CREATE TABLE IF NOT EXISTS `" . $table . "` (" . $fields_str . ")";
    //echo $SQL;
    // $result = mysql_query($SQL, $conn);
    // if (mysql_error($conn)) {
    $result = $conn->query($SQL);
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL CREATE TABLE Error : " . mysql_error($conn) . "<br>";
            echo "MySQL CREATE TABLE Error : " . $conn->error . "<br>";
        }
    }
    return $result;
}

// 將紀錄寫進指定的資料表內
// 範例 :
//   $data_array["user"]="tony";
//   $data_array["age"]=18;
//   $result=insert("users", $data_array); //預設資料庫
//   $result=insert("users", $data_array, "stocks"); //指定資料庫
function insert($table, $data_array, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    foreach ($data_array as $key => $value) {
        //產生欄位名稱與值陣列
        $tmp_col[] = $key;
        $tmp_dat[] = "'$value'";
    }
    $columns = join(",", $tmp_col); //轉成字串
    $data = join(",", $tmp_dat); //轉成字串
    $SQL = "INSERT INTO " . $table . "(" . $columns . ") VALUES(" . $data . ")";
    // $result = mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
    $result = $conn->query($SQL); //成功傳回資源識別字, 失敗傳回 FALSE
    // if (mysql_error($conn)) {
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL INSERT Error : " . mysql_error($conn) . "<br>";
            echo "MySQL INSERT Error : " . $conn->error . "<br>";
        }
    }
    return $result;
}

// 可執行所有 SQL 指令
// 範例 :
//   $result=run_sql("DELETE FROM users WHERE id='peter'"); //注意, DELETE 無 *
//   $SQL="UPDATE users SET login_count=5,name='彼得' WHERE id='peter'";
//   $SQL="INSERT INTO users(id,name) VALUES('peter','彼得')";
//   $result=run_sql($SQL);
//   $RS=run_sql("SELECT * FROM tabs ORDER BY tab_order); //多筆紀錄
//   for ($i=0; $i<count($RS); $i++) { //走訪紀錄集陣列
//      echo $RS[$i]["tab_name"].",".$RS[$i]["age"];
//   }
function run_sql($SQL, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    // $result = mysql_query($SQL, $conn); //執行 SQL 指令
    $result = $conn->query($SQL); //執行 SQL 指令
    // if (mysql_error($conn)) {
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL SELECT Error : " . mysql_error($conn) . "<br>";
            echo "MySQL SELECT Error : " . $conn->error . "<br>";
        }
        return $result; //失敗傳回 FALSE
    } //end of if
    else {
        //判別是否為 SELECT 指令
        if (substr_count($SQL, "SELECT") == 1) {
            //SELECT 指令
            //從紀錄集資源識別字擷取紀錄為紀錄集陣列
            // for ($i = 0; $i < mysql_num_rows($result); $i++) {
                // $RS[$i] = mysql_fetch_array($result);
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $RS[$i] = mysqli_fetch_array($result);
            } //end of for
            //若紀錄集陣列為一列 (單筆記錄), 則回傳單列紀錄 (即第一列索引 0)
            //if (sizeof($RS)==1) {$RS=$RS[0];}
            return $RS; //傳回紀錄集陣列
        } //end of else
        else {return $result;} //傳回 TRUE
    } //end of else
}

function total_sql($SQL, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    // $result = mysql_query($SQL, $conn); //執行 SQL 指令
    $result = $conn->query($SQL); //執行 SQL 指令
    // if (mysql_error($conn)) {
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL SELECT Error : " . mysql_error($conn) . "<br>";
            echo "MySQL SELECT Error : " . $conn->error . "<br>";
        }
        return $result; //失敗傳回 FALSE
    } //end of if
    else {
        //判別是否為 SELECT 指令
        if (substr_count($SQL, "SELECT") == 1) {
            //SELECT 指令
            //從紀錄集資源識別字擷取紀錄為紀錄集陣列
            // $RS[0] = mysql_fetch_row($SQL);
            $RS[0] = mysqli_fetch_row($SQL);
            //回傳單列紀錄 (即第一列索引 0)
            return $RS; //傳回紀錄集陣列
        } //end of else
        else {return $result;} //傳回 TRUE
    } //end of else
}

// 更新資料欄位
function update($table, $data_array, $field, $wvalue, $database = DATABASE)
{
    $conn = get_connection(); //取得 MySQL 資料庫連線
    if (!$conn) {return false;} //無法取得連線傳回 FALSE
    // $result = mysql_select_db($database, $conn); //開啟資料庫
    // if (!$result) {return false;} //選擇資料庫失敗傳回 FALSE
    $setstr = "";
    foreach ($data_array as $key => $value) {
        //產生欄位名稱與值陣列
        // $tmp_col[] = $key;
        // $tmp_dat[] = "'$value'";
        $setstr .= $key . " = '" . $value . "',";
    }
    // $columns = join(",", $tmp_col); //轉成字串
    // $data = join(",", $tmp_dat); //轉成字串
    $setstr = substr_replace($setstr, '', -1);
    $SQL = "UPDATE " . $table . " SET " . $setstr . " WHERE " . $field . " = '" . $wvalue . "' ";
    // $result = mysql_query($SQL, $conn); //成功傳回資源識別字, 失敗傳回 FALSE
    // if (mysql_error($conn)) {
    $result = $conn->query($SQL); //成功傳回資源識別字, 失敗傳回 FALSE
    if ($conn->error) {
        //若失敗取得資料庫伺服器錯誤敘述
        if (SHOW_ERROR) {
            // echo "MySQL UPDATE Error : " . mysql_error($conn) . "<br>";
            echo "MySQL UPDATE Error : " . $conn->error . "<br>";
        }
        return false;
    }
    return true;
}
