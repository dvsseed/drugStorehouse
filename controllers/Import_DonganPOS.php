<?php
function importdata($myFile)
{
    if (($filehandle = fopen($myFile, 'r')) === false) {
        die('Failed to open file for writing!');
    }

    while (true) {
        $createSQL = "insert into `sales_sa395` (";
        $theData = fgets($filehandle); // 讀取一行內容；
        if (false === $theData) {
            break; // continue is bad.
        }
        $rowChunks = explode(",", $theData); //第一行內容值

        $createSQL = $createSQL . "sale_id, seqno, item_id, tr_date, un_price, tr_qty, mea, dis_per, dis_mon, un_cost, get_point, bonus, sub_pmon, stock_old, cost_old, updid, updtime, ubc1, ubc2, ubn1, ubn2, ubd1, ubd2, cmp_code, inv_id, new_uprice, sp_no, sp_seqno, csq_id, up_dis, eos_cost";
        $createSQL = $createSQL . ") VALUES ( ";

        if (trim($theData) != "") {
            $x = 0;
            while ($x < 31) {
                if ($x == 6) {
                    $createSQL = $createSQL . "'" . iconv("big5", "UTF-8", trim($rowChunks[$x])) . "',";
                } else {
                    $createSQL = $createSQL . "'" . trim($rowChunks[$x]) . "',";
                }
                $x++;
            }
            $createSQL = substr($createSQL, 0, -1);
            $createSQL = $createSQL . " )";

            // $dbh = mysql_connect("127.0.0.1", "druguser", "0HfpaWyU50v3");
            // mysql_query("SET NAMES 'utf8'");
            // mysql_select_db("drugstorehouse");
            // mysql_query($createSQL, $dbh);
			$dbh = new mysqli('127.0.0.1', 'druguser', '0HfpaWyU50v3', 'drugstorehouse');
            $sql = "SET NAMES 'utf8'";
            $dbh->query($sql);
			$dbh->query($createSQL);
        }
    }

    fclose($filehandle);
}

importdata('/tmp/sales_list/sales.csv');
