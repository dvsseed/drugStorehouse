<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

// 自動計算並更新
switch ($id) {
    case '1':
        $sql = "UPDATE dm_inventory d
				         INNER JOIN
				         (
				           SELECT stock_code, SUM(total) AS sumAttr
				           FROM invoice_info
				           GROUP BY stock_code
				         ) i ON d.stock_code = i.stock_code
				         SET d.total = i.sumAttr";
        break;
    case '2':
        $sql = "UPDATE dm_inventory d
				         INNER JOIN
				         (
				           SELECT item_id, SUM(tr_qty) AS sumAttr
				           FROM sales_sa395
				           GROUP BY item_id
				         ) s ON d.stock_code = s.item_id
				         SET d.tr_qty = s.sumAttr";
        break;
    case '3':
        $sql = "UPDATE dm_inventory d
				         INNER JOIN
				         (
				           SELECT stock_code, SUM(safety_stock) AS sumAttr
				           FROM dm_drugs
				           GROUP BY stock_code
				         ) s ON d.stock_code = s.stock_code
				         SET d.safety_stock = s.sumAttr";
        break;
    default:
        break;
}
// @mysql_query($sql);
$conn->query($sql);
// $result = mysql_query($sql);
// if(!$result){
//     echo json_encode(array('failure' => true), mysql_errno());
// }
echo json_encode(array('success' => true));
