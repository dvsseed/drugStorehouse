<?php
//http://stackoverflow.com/questions/9361303/can-i-get-the-unicode-value-of-a-character-or-vise-versa-with-php
function unichr($o)
{
    return mb_convert_encoding('&#' . intval($o) . ';', 'UTF-8', 'HTML-ENTITIES');
}

function sanitize($str)
{
    return str_replace(array("\\", "'", "\r", "\n"), array("\\\\", "\\'", '', ''), $str);
}
//String made up of all the escaped characters:
// $str = unichr(0) . unichr(10) . unichr(13) . unichr(26) . unichr(34) . unichr(39) . unichr(92);
// echo $str . "\n";
// $sql = "SELECT '" . sanitize($str) . "'";
// echo $sql;

function cleanse($str)
{
    if (isset($str)) {
        $str = trim($str); // 清理空格
        $str = strip_tags($str); // 過濾html標籤
        // $str = htmlspecialchars($str);  // 將字符內容轉化為html實體
        // $str = mysql_real_escape_string($str);
        // $str = mysql_escape_string($str);
		$str = $dbh->real_escape_string($str);
        $str = stripslashes($str); // 把\號刪除，可用ereg_replace
        // $str = addslashes($str);
        return $str;
    }
}
